<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Faq;
use App\Models\Admin\FaqTranslation;
use Illuminate\Http\Request;
use App\DataTables\FaqDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

class FaqController extends Controller
{
    public function index(FaqDatatable $dataTable)
    {
        return $dataTable->render('front.faq.index');
    }

    public function create(Request $request)
    {
        return view('front.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_en' => 'required',
            'answer_en' => 'required',
            'type' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $create = Faq::create([
                'type' => $request->type,
            ]);
            if (!empty($create)) {
                foreach (allLanguages() as $lang) {
                    FaqTranslation::create([
                        'locale' => $lang->prefix,
                        'faq_id' => $create->id,
                        'question' => is_null($request->input('question_' . $lang->prefix)) ? $request->input('question_en') : $request->input('question_' . $lang->prefix),
                        'answer' => is_null($request->input('answer_' . $lang->prefix)) ? $request->input('answer_en') : $request->input('answer_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->route('faq.index')->with('success', __('FAQ added successfully!'));
    }

    public function edit($id)
    {
        $faq = Faq::where('id', $id)->firstOrFail();
        return view('front.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::where('id', $id)->firstOrFail();
        DB::beginTransaction();
        try {
            $update = Faq::where('id', $id)->update([
                'type' => is_null($request->type) ? $faq->type : $request->type,
            ]);
            if (!empty($update)) {
                foreach (allLanguages() as $lang) {
                    FaqTranslation::where('locale', $lang->prefix)->where('faq_id', $faq->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'faq_id' => $faq->id,
                    ], [
                        'question' => is_null($request->input('question_' . $lang->prefix)) ? $faq->translateOrDefault($lang->prefix)->question : $request->input('question_' . $lang->prefix),
                        'answer' => is_null($request->input('answer_' . $lang->prefix)) ? $faq->translateOrDefault($lang->prefix)->answer : $request->input('answer_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('faq.index');
    }

    public function delete($id)
    {
        $faq = Faq::where('id', $id)->firstOrFail();
        $faq->delete();

        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('faq.index');
    }
}
