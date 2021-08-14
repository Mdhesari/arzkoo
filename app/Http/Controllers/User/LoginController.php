<?php

namespace App\Http\Controllers\User;

use App\Events\AuthenticationAttemptEvent;
use App\Http\Controllers\Controller;
use App\Models\Authentication;
use App\Models\User;
use App\Space\PasswordGenerator;
use Auth;
use Hash;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use SEOMeta;

class LoginController extends Controller
{
    public function __construct()
    {
        SEOMeta::setTitle('ورود به حساب کاربری');
    }

    public function show()
    {
        return view('user.login');
    }

    public function store(Request $request, RateLimiter $limiter, PasswordGenerator $pGenerator)
    {
        $request->validate([
            'username' => ['required', 'regex:/^[0-9]{11}$/i']
        ]);

        $username = $request->username;

        $resend = $this->setupRateLimit($limiter, $username);

        $auth = new Authentication;
        $auth->value = $username;
        $auth->secret = Hash::make($password = $pGenerator->generate());
        $auth->save();

        event(new AuthenticationAttemptEvent($auth, $password));

        return response()->json([
            'value' => $username,
            'resend' => $resend
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

    public function verify(Request $request)
    {
        $request->validate([
            'username' => ['required', 'exists:authentications,value'],
            'code' => 'required',
        ]);

        $auth = Authentication::whereValue($request->username)->latest()->active()->firstOrFail();

        if (Hash::check($request->code, $auth->secret)) {
            $this->loginUser($request->username);

            return response()->json([
                'status' => true,
                'redirect' => route('home')
            ]);
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    public function loginUser($username)
    {
        $user = User::firstOrCreate([
            'mobile' => $username,
        ]);

        request()->session()->regenerate();

        Auth::login($user, true);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('home');
    }
}
