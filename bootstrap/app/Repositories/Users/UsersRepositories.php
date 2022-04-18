<?php

namespace App\Repositories\Users;
use App\Models\User as UserModel;
use Auth;
use DataTables;

class UsersRepositories
{
    public function __construct(UserModel $users)
    {
        $this->UserModel        = $users;
    }
    public function index($request)
    {
        $arrData = $this->UserModel->orderBy('id','DESC')->paginate(10);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/users/index';
        $data['pageTitle']        = 'Users';
        return $data;
    }
    public function delete($id)
    {
        $result = $this->NewsModel->where('id',base64_decode($id))->delete();
       return $result;
    }
}
