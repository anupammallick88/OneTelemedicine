<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Page;
use Illuminate\Http\Request;
use App\DataTables\PageDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(PageDatatable $dataTable)
    {
        return $dataTable->render('admin.page.index');
    }
    public function create()
    {
        return view('admin.page.create');
    }

    public function edit($id)
    {
        $page = Page::where('id', $id)->firstOrFail();
        return view('admin.page.edit', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'label' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        Page::create([
            'label' => $request->label,
            'title' => $request->title,
            'tags' => $request->tags,
            'url' => Str::slug($request->title),
            'description' => $request->description
        ]);

        session()->flash('success', __('Successfully Created'));
        Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('page.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'label' => 'required',
            'title' => 'required',
        ]);
        Page::find($id)->update([
            'label' => $request->label,
            'title' => $request->title,
            'tags' => $request->tags,
            'url' => Str::slug($request->title),
            'description' => $request->description
        ]);

        session()->flash('success', __('Successfully updated'));
        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('page.index');
    }

    public function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        session()->flash('success', __('Successfully Deleted'));
        Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('page.index');
    }
}
