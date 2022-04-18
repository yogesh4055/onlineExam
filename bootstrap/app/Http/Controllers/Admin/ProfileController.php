<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
use Session;

class ProfileController extends Controller
{
    public function __construct(UserModel $user)
    {
    	$this->UserModel =  $user;
    }
    public function index(Request $request)
    {       
        $data['user']             =  Auth::user();
        $data['middleContent']    =  'admin/edit_profile';
        $data['pageTitle']        =  'Edit Account';
        return view('admin/template')->with($data);  
    }
    public function update(Request $request)
    {  	
        $userData = Auth::user();
    	$request->validate([
            'full_name'     => 'required',
            'mobile'    => 'required',
            //'password' => 'required',
        ]);
        if ($request->file('profile_image')) 
        {
            $destinationPath = public_path('uploads/user_profile/'.$userData->id);
            $name = $request->file('profile_image')->getClientOriginalName();
            $imageName  = 'user_profile_'.$userData->id.'.'.$request->profile_image->extension();  
            $request->file('profile_image')->move($destinationPath, $imageName);;
            $updateData['photo']       =  $imageName;
        }

        
        $updateData['full_name']    = $request->full_name;
        $updateData['mobile']       = $request->mobile;
        $updateData['address']      = $request->address;
        $updateData['city']         = $request->city;
        $updateData['country']      = $request->country;
        $updateData['state']        = $request->state;
        $this->UserModel->where('id',Auth::id())->update($updateData);
        return redirect('admin/edit_profile')->withSuccess('Profile updated successfully'); 

    }
}
