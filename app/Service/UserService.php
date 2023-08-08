<?php

namespace App\Service;

use App\DataTables\UsersDataTable;
use App\Repository\UserRepository;

class UserService
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $get = $this->user->get();
        return $this->format($get);
    }


    public function show($id)
    {
        $user = $this->user->findById($id);
        return $this->format($user);
    }

    public function update($request, $id)
    {
        $input = $request->except('image');
        if (!empty($request->image)) {
            $old_img = '';
            $old_img = isset($user) ? $user->image : '';
            $input['image'] = fileUpload($request['image'], path_user_image(), $old_img); // upload file
        }

        $user = $this->user->findById($id);
        $user->update($input);
        return $this->format($user);
    }

    public function delete($id)
    {
        $user = $this->user->findById($id)->delete();
        return $this->format($user);
    }


    public function format($get)
    {
        $data = ['success' => false, 'message' => __('Something went wrong'), 'data' => []];
        if ($get) {
            $data['success'] = true;
            $data['data'] = $get;
            $data['message'] = __('Successfully fetched all data');
            return $data;
        }
        return $data;
    }
}
