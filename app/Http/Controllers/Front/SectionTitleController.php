<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\SectionTitleTranslation;
use Illuminate\Http\Request;
use App\Models\Front\SectionTitle;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

class SectionTitleController extends Controller
{
    public function store(Request $request, $name)
    {
        $request->validate([
            'title_en' => 'required',
            'description_en' => 'required',
        ]);

        if (SectionTitle::where('name', $name)->first()) {
            $sectionTitle = SectionTitle::where('name', $name)->first();
        }

        DB::beginTransaction();
        try {
            $update = SectionTitle::where('name', $name)->update([
                'name' => is_null($request->name) ? $sectionTitle->name : $request->name,
            ]);
            if (!empty($update)) {
                foreach (allLanguages() as $lang) {
                    SectionTitleTranslation::where('locale', $lang->prefix)->where('section_title_id', $sectionTitle->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'section_title_id' => $sectionTitle->id,
                    ], [
                        'title' => is_null($request->input('title_' . $lang->prefix)) ? $sectionTitle->translateOrDefault($lang->prefix)->title : $request->input('title_' . $lang->prefix),
                        'description' => is_null($request->input('description_' . $lang->prefix)) ? $sectionTitle->translateOrDefault($lang->prefix)->description : $request->input('description_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->back()->with('success', __('Successfully updated!'));
    }


    public function gallery()
    {
        return view('front.sections.section_title.gallery');
    }

    public function doctor()
    {
        return view('front.sections.section_title.doctor');
    }
}
