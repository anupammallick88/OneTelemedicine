<?php

namespace App\Http\Services;

use App\Models\Setting;
use App\Models\SettingTranslation;
use Illuminate\Support\Facades\DB;

class SettingService
{
    public function saveCommonSetting($request)
    {
        $response = ['success' => false, 'message' => __('Invalid request')];
        DB::beginTransaction();
        try {
            if (isset($request->title)) {
                $setting = Setting::where('slug', 'title')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->title]);
                }
            }
            if (isset($request->address)) {
                $setting = Setting::where('slug', 'address')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->address]);
                }
            }
            if (isset($request->helpline_1)) {
                $setting = Setting::where('slug', 'helpline_1')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->helpline_1]);
                }
            }
            if (isset($request->helpline_2)) {
                $setting = Setting::where('slug', 'helpline_2')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->helpline_2]);
                }
            }
            if (isset($request->helpline_email_1)) {
                $setting = Setting::where('slug', 'helpline_email_1')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->helpline_email_1]);
                }
            }
            if (isset($request->helpline_email_2)) {
                $setting = Setting::where('slug', 'helpline_email_2')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->helpline_email_2]);
                }
            }
            if (isset($request->footer_copyright)) {
                $setting = Setting::where('slug', 'footer_copyright')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => $request->footer_copyright]);
                }
            }
            if (isset($request->site_logo)) {
                $setting = Setting::where('slug', 'site_logo')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => uploadFile($request->site_logo, SITE_LOGO)]);
                }
            }
            if (isset($request->favicon)) {
                $setting = Setting::where('slug', 'favicon')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => uploadFile($request->favicon, FAVICON)]);
                }
            }
            if (isset($request->white_logo)) {
                $setting = Setting::where('slug', 'white_logo')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => uploadFile($request->white_logo, WHITE_LOGO)]);
                }
            }
            if (isset($request->preloader)) {
                $setting = Setting::where('slug', 'preloader')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => uploadFile($request->preloader, PRELOADER_IMG)]);
                }
            }
            if (isset($request->banner)) {
                $setting = Setting::where('slug', 'banner')->first();
                foreach (allLanguages() as $lang) {
                    SettingTranslation::where('setting_id', $setting->id)->where('locale', $lang->prefix)->update(['value' => uploadFile($request->banner, PAGE_BANNER)]);
                }
            }
            $response = [
                'success' => true,
                'message' => __('General setting updated successfully')
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return $response;
        }
        DB::commit();
        return $response;
    }
}
