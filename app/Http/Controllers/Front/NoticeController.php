<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\Notice;
use App\Models\Front\NoticeTranslation;
use Illuminate\Http\Request;
use App\DataTables\NoticeDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

class NoticeController extends Controller
{
    public function index(NoticeDatatable $dataTable)
    {
        return $dataTable->render('front.sections.notice.index');
    }

    public function create()
    {
        return view('front.sections.notice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'status' => 'required',
        ]);

        $notice = new Notice();
        $notice->icon = $request->icon;
        $notice->title = Purifier::clean($request->title);
        $notice->description = Purifier::clean($request->description);
        $notice->button_text = Purifier::clean($request->button_text);
        $notice->button_url = Purifier::clean($request->button_url);
        $notice->status = Purifier::clean($request->status);
        $notice->save();

        session()->flash('success', __('Successfully created'));

        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('notice.index');
    }

    public function edit($id)
    {
        $notice = Notice::where('id', $id)->firstOrFail();
        return view('front.sections.notice.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $notice = Notice::where('id', $id)->firstOrFail();

        DB::beginTransaction();
        try {
            $update = Notice::where('id', $id)->update([
                'icon' => is_null($request->icon) ? $notice->icon : $request->icon,
                'status' => is_null($request->status) ? $notice->status : $request->status,
                'button_url' => is_null($request->button_url) ? $notice->button_url : $request->button_url,
            ]);
            if (!empty($update)) {
                foreach (allLanguages() as $lang) {
                    NoticeTranslation::where('locale', $lang->prefix)->where('notice_id', $notice->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'notice_id' => $notice->id,
                    ], [
                        'title' => is_null($request->input('title_' . $lang->prefix)) ? $notice->translateOrDefault($lang->prefix)->title : $request->input('title_' . $lang->prefix),
                        'button_text' => is_null($request->input('button_text_' . $lang->prefix)) ? $notice->translateOrDefault($lang->prefix)->button_text : $request->input('button_text_' . $lang->prefix),
                        'description' => is_null($request->input('description_' . $lang->prefix)) ? $notice->translateOrDefault($lang->prefix)->description : $request->input('description_' . $lang->prefix),
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
        return redirect()->route('notice.index');
    }

    public function delete($id)
    {
        $notice = Notice::where('id', $id)->firstOrFail();
        $notice->delete();
        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('notice.index');
    }
}
