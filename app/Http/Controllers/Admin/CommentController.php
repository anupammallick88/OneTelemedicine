<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Comment;
use App\DataTables\CommentDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class CommentController extends Controller
{
    public function index(CommentDatatable $dataTable)
    {
        $comment = Comment::with('user', 'post')->get();
        return $dataTable->render('admin.comment.index', compact('comment'));
    }

    public function approved($id)
    {
        $comment = Comment::where('id', $id)->firstOrFail();
        $comment->status = 1;
        $comment->save();

        session()->flash('success', __('Successfully approved'));
        Toastr::success('success', __('Successfully approved'), ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function unapproved($id)
    {
        $comment = Comment::where('id', $id)->firstOrFail();

        $comment->status = 0;
        $comment->save();

        session()->flash('success', __('Successfully unapproved'));
        Toastr::success('success', __('Successfully unapproved'), ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $comment = Comment::where('id', $id)->firstOrFail();
        $comment->delete();
        session()->flash('success', __('Successfully delete'));
        Toastr::success('success', __('Successfully delete'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    // From Front Page;
    public function store(Request $request)
    {
        $request->validate([
            'massage' => 'required'
        ]);

        $comment = new Comment();
        $comment->p_id = $request->p_id;
        $comment->user_id = Auth::user()->id;
        $comment->massage = Purifier::clean($request->massage);
        $comment->save();

        session()->flash('success', __('Comment Sent Successfully'));
        return redirect()->back();
    }





}
