<?php

namespace App\Http\Controllers\Front;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserprofileUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class UserProfileController extends Controller
{
    public function update(User $user, UserprofileUpdateRequest $request)
    {

       $input = Purifier::clean($request->except('image'));

        if (!empty($request->image)) {
            $old_img = '';
            $file = User::where('id', $user->id)->first();
            $old_img = isset($file) ? $file->image : '';

            $input['image'] = fileUpload($request['image'], path_user_image(), $old_img); // upload file
        }

        session()->flash('success', __('Successfully updated'));

        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);

        $user->update($input);

        return redirect()->back();
    }
}
