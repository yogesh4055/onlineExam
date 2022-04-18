<?php

namespace App\Repositories\Banners;
use App\Models\User as UserModel;
use App\Models\BannersModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use App\Models\VideosCastsModel;
use Auth;
use DataTables;

class BannersRepositories
{
    public function __construct(UserModel $user,BannersModel $Videos,CategoriesModel $categories)
    {
        $this->UserModel          = $user;
        $this->BannersModel        = $Videos;
        $this->CategoriesModel    = $categories;
    }
    public function index($request)
    {
        $arrData = $this->BannersModel::with('get_category_name')->orderBy('id','DESC')->paginate(10);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/banners/index';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function create($request)
    {
        $arrCategories = $this->CategoriesModel->where('parent_id',0)->get()->toArray();
        $data['arrCategories']    =  $arrCategories;
        $data['middleContent']    = 'admin/banners/create';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function store($request)
    {
        $formData = $request->all();
        if ($request->file('image')) 
        {
            $name = $request->file('image')->getClientOriginalName();
            $imageName = time().'.'.$request->file('image')->extension();  
            $request->image->move(public_path('uploads/banners'), $imageName);
            $insertData['image']        = $imageName;
        }

        $insertData['title']        = $formData['title'];
        $insertData['category_id']  = $formData['category_id'];
        $insertData['social_link']  = $formData['social_link'];
        $insertData['social_name']  = $formData['social_name'];
        $insertData['social_icon']  = $formData['social_icon'];
        $insertData['description']  = $formData['description'];
        $insertData['status']       = $formData['status'];
        $result = $this->BannersModel->create($insertData);

        return $result;
    }
    public function edit($id)
    {
        $arrdata       = $this->BannersModel->where('id',base64_decode($id))->first();
        $arrCategories = $this->CategoriesModel->where('parent_id',0)->get()->toArray();
        $data['arrdata']          =  $arrdata;
        $data['arrCategories']    =  $arrCategories;
        $data['middleContent']    = 'admin/banners/edit';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function update($id,$request)
    {
        $formData = $request->all();
        if ($request->file('image')) 
        {
            $name = $request->file('image')->getClientOriginalName();
            $imageName = time().'.'.$request->file('image')->extension();  
            $request->image->move(public_path('uploads/banners'), $imageName);
            $updateData['image']        = $imageName;
        }

        $updateData['title']        = $formData['title'];
        $updateData['category_id']  = $formData['category_id'];
        $updateData['social_link']  = $formData['social_link'];
        $updateData['social_name']  = $formData['social_name'];
        $updateData['social_icon']  = $formData['social_icon'];
        $updateData['description']  = $formData['description'];
        $updateData['status']       = $formData['status'];

        $result = $this->BannersModel->where('id',base64_decode($id))->update($updateData);

        return $result;
    }
    public function delete($id)
    {
        $result = $this->BannersModel->where('id',base64_decode($id))->delete();
       return $result;
    }
}
