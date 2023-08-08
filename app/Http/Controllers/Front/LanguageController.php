<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $language = Language::where('prefix', $request->lang)->first();
        if (!empty($language)) {
            App::setLocale($request->lang);
            session()->put('locale', $request->lang);
            session()->put('lang_dir', $language->direction);
            return redirect()->back()->with('success', __('main.Language_change_successfully'));
        }
        return redirect()->back()->with('dismiss', 'No language found!');
    }
}
