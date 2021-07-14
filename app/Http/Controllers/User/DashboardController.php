<?php

namespace App\Http\Controllers\User;

use App\Events\AuthenticationAttemptEvent;
use App\Http\Controllers\Controller;
use App\Models\Authentication;
use App\Space\PasswordGenerator;
use Exception;
use Hash;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mockery\Generator\StringManipulation\Pass\Pass;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'image' => ['required', 'mimes:png,jpg', 'max:10000'],
        ]);

        $path = $request->image->store('users/' . auth()->id() . '/avatars');

        $request->user()->update([
            'image' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'تصویر شما با موفقیت بروزرسانی شد.');
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
        ]);

        $request->user()->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard')->with('success', 'نام شما با موفقیت بروزرسانی شد.');
    }

    public function updatePassword(Request $request)
    {
        $validation = [
            'password' => ['required', 'min:8', 'confirmed'],
        ];

        $user = $request->user();

        if ($hasCurrentPassword = !empty($user->password)) {
            $validation['current_password'] = ['required'];
        }

        $request->validate($validation);

        if ($hasCurrentPassword && !Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => __('auth.failed')
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return redirect()->route('dashboard')->with('success', 'رمز عبور با موفقیت بروزرسانی شد.');
    }

    public function updateMobile(Request $request, RateLimiter $limiter, PasswordGenerator $pGenerator)
    {
        $request->validate([
            'mobile' => ['required', 'regex:/^[0-9]{11}$/i', 'unique:users,mobile'],
        ]);

        $password = $request->password;

        if (empty($password) || !Hash::check($password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'mobile' => __('auth.failed')
            ]);
        }

        $username = $request->mobile;

        $resend = $this->setupRateLimit($limiter, $username);

        $auth = new Authentication();
        $auth->value = $username;
        $auth->secret = Hash::make($password = $pGenerator->generate());
        $auth->save();

        event(new AuthenticationAttemptEvent($auth, $password));

        return redirect()->route('dashboard.confirm-mobile')->with([
            'resend' => $resend,
            'mobile' => $username
        ]);
    }

    private function setupRateLimit($limiter, $username)
    {
        $key = make_mobile_limiter_key($username);

        $resend = get_available_in_rate_limiter($limiter, $key);

        if ($limiter->tooManyAttempts($key, config('session.otp_max_attempts'))) {
            throw ValidationException::withMessages([
                'username' => __('auth.throttle', [
                    'seconds' => get_available_in_rate_limiter($limiter, $key)
                ])
            ]);
        }

        $limiter->hit($key, 120);

        return $resend;
    }

    public function updateMobileConfirmView()
    {
        abort_if(!$mobile = session('mobile'), 403);

        $resend = session('resend');

        return view('user.dashboard.confrim-mobile', compact('mobile', 'resend'));
    }

    public function updateMobileConfirm(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
    }
}
