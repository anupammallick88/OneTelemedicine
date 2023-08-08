<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Front\Contact;
use App\DataTables\ContactDatatable;
use App\Http\Controllers\Controller;
use App\Models\Models\Admin\Site;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Mews\Purifier\Facades\Purifier;

class ContactController extends Controller
{

    public function index(ContactDatatable $dataTable)
    {
        $contact = Contact::all();
        return $dataTable->render('admin.contact.index', compact('contact'));
    }

    public function delete($id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        $image_path = path_contact_image().$contact->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $contact->delete();
        session()->flash('success', __('Successfully delete'));
        Toastr::success('success', __('Successfully delete'), ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    // Front part;

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'massage' => 'required',
            'image' => 'mimes:png,jpg,pdf,txt,doc,docx',
        ]);

        $contact = new Contact();
        $contact->name = Purifier::clean($request->name);
        $contact->email = Purifier::clean($request->email);
        $contact->massage = Purifier::clean($request->massage);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = time() . '-' . 'contact-image' . '.' . $extension;
            $file->move(path_contact_image(), $fileName);
            $contact->image = $fileName;
        }

        $contact->save();

        session()->flash('success', __('Message Sent Successfully'));
        return redirect('/');
    }

    public function contactImageUpdate(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        if (!empty($request->image)) {
            $img = fileUpload($request['image'], path_contact_image()); // upload file
         }

        $update = Site::whereId(1)->update([
            'contact_image' => $img,
        ]);

        if($update) {
            session()->flash('success', __('Successfully Updated'));
            Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        session()->flash('error', __('Something were wrong!'));
        Toastr::success('error', __('Something were wrong!'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
