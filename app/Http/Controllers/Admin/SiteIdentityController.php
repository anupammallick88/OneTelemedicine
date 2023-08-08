<?php

namespace App\Http\Controllers\Admin;


use App\Http\Services\SettingService;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Models\Admin\Site;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SiteStoreRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Facades\Purifier;


class SiteIdentityController extends Controller
{
    public function __construct()
    {
        $this->settingRepo = new SettingService();
    }
    public function create()
    {
        return view('admin.site.create');
    }

    public function store(SiteStoreRequest $request)
    {
        $input = $request->except('image1', 'image2', 'image3');

        if ($request->has('image1')) {
            //            $name_path = explode("/", $request->image1);
            //            $name = time() . end($name_path);
            //            File::copy(public_path($request->image1), public_path(path_site_logo_image() . $name));
            //            $input['image1'] = $name;
            $input['site_logo'] = uploadFile($request->image1, path_site_logo_image());
        }

        if ($request->has('image2')) {
            //            $name_path = explode("/", $request->image2);
            //            $name = time() . end($name_path);
            //            File::copy(public_path($request->image2), public_path(path_site_favicon_image() . $name));
            //            $input['image2'] = $name;
            $input['favicon'] = uploadFile($request->image2, path_site_favicon_image());
        }

        if ($request->has('image3')) {
            //            $name_path = explode("/", $request->image3);
            //            $name = time() . end($name_path);
            //            File::copy(public_path($request->image3), public_path(path_site_favicon_image() . $name));
            //            $input['image3'] = $name;
            $input['white_logo'] = uploadFile($request->image3, path_site_while_logo_image());
        }

        Site::create($input);

        Session::flash('message', __('Successfully created'));

        Toastr::success('message', __('Successfully Created'));

        return redirect()->back()->with('success', __('Site created successfully'));
    }

    public function update(Request $request)
    {
        $response = $this->settingRepo->saveCommonSetting($request);

        if ($request->language_id) {
            Language::where('id', $request->language_id)->update(['default' => '1']);
            Language::where('id', '!=', $request->language_id)->update(['default' => '0']);
            $language = Language::where('default', '1')->first();
            if ($language) {
                $prefix = $language->prefix;
                App::setLocale($prefix);
                session()->put('locale', $prefix);
                session()->put('lang_dir', $language->direction);
            }
        }

        if ($response['success'] == true) {
            Session::flash('message', __('Successfully Updated'));
            Toastr::success('message', __('Successfully Updated'));
            return redirect()->back()->with('success', __('Site updated successfully'));
        }
        Session::flash('message', __('Something went wrong'));
        Toastr::success('message', __('Something went wrong'));
        return redirect()->back()->with('error', $response['message']);
    }
}
