<?php

namespace Modules\Admin\Http\Controllers;

use App\Settings\GeneralSetting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\AdminSettingRequest;
use Storage;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(GeneralSetting $setting)
    {
        $site_name = $setting->site_name;
        $site_description = $setting->site_description;
        $site_favicon = $setting->site_favicon ? Storage::url($setting->site_favicon) : null;
        $site_logo = $setting->site_logo ? Storage::url($setting->site_logo) : null;

        $page_title = __(' General Setting ');

        return view('admin::general_setting.edit', compact('site_name', 'site_description', 'site_logo', 'site_favicon', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(AdminSettingRequest $request, GeneralSetting $setting)
    {
        if ($file = $request->file('site_favicon')) {

            $setting->site_favicon = $file->store(config('admin.path.general_setting') . '/favicon');
        }

        if ($file = $request->file('site_logo')) {

            $setting->site_logo = $file->store(config('admin.path.general_setting') . '/logo');
        }

        $setting->site_name = $request->input('site_name');
        $setting->site_description = $request->input('site_description');
        $setting->save();

        return back()->with('success', __(' Successfully updated setting. '));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
