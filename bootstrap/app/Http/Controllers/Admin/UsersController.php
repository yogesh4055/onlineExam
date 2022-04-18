<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Users\UsersRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class UsersController extends Controller
{
    public function __construct(UsersRepositories $UserRepo)
    {
    	$this->UsersRepositories = $UserRepo;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = $this->UsersRepositories->index($request);
            return $data;
        }
    	$data = $this->UsersRepositories->index($request);
    	$data['pageTitle']        = 'User';
    	return view('admin/template')->with($data);  
    }
    public function create(Request $request)
    {
        $data = $this->UsersRepositories->create($request);
        $data['pageTitle']        = 'User';
        return view('admin/template')->with($data);  
    }
    public function edit($id)
    {
        $data = $this->UsersRepositories->edit($id);
        $data['pageTitle']        = 'Users';
        return view('admin/template')->with($data);  
    }

}
