<?php

namespace App\Repositories\Videos;
use App\Models\User as UserModel;
use App\Models\VideosModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use App\Models\VideosCastsModel;
use Auth;
use DataTables;

class VideosRepositories
{
    public function __construct(UserModel $user,VideosModel $Videos,CategoriesModel $categories,IndustriesModel $industries,VideosCastsModel $videos_cast)
    {
        $this->UserModel          = $user;
        $this->VideosModel        = $Videos;
        $this->CategoriesModel    = $categories;
        $this->IndustriesModel    = $industries;
        $this->VideosCastsModel   = $videos_cast;
    }
    public function index($request)
    {
        $arrData = $this->VideosModel::orderBy('id','DESC')->paginate(10);

        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/videos/index';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function create($request)
    {
        $arrCategories = $this->CategoriesModel->where('parent_slug','news')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/videos/create';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function store($request)
    {
        $formData = $request->all();
        if ($request->file('photo')) 
        {
            $name = $request->file('photo')->getClientOriginalName();
            $imageName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads/news'), $imageName);
            $insertData['photo']        = $imageName;
        }

        $insertData['title']        = $formData['title'];
        $insertData['category_id']  = $formData['category_id'];
        $insertData['industry_id']  = $formData['industry_id'];
        $insertData['status']       = $formData['status'];
        $insertData['subject']      = $formData['subject'];
        $insertData['description']  = $formData['description'];

        $result = $this->VideosModel->create($insertData);

        return $result;
    }
    public function edit($id)
    {
        $arrdata       = $this->VideosModel->where('id',base64_decode($id))->first();
        $arrCategories = $this->CategoriesModel->where('parent_slug','news')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();

        $data['arrdata']          =  $arrdata;
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/videos/edit';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function update($id,$request)
    {
        $formData = $request->all();
        if ($request->file('photo')) 
        {
            $name = $request->file('photo')->getClientOriginalName();
            $imageName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads/news'), $imageName);
            $updateData['photo']        = $imageName;
        }

        $updateData['title']        = $formData['title'];
        $updateData['category_id']  = $formData['category_id'];
        $updateData['industry_id']  = $formData['industry_id'];
        $updateData['status']       = $formData['status'];
        $updateData['subject']      = $formData['subject'];
        $updateData['description']  = $formData['description'];

        $result = $this->VideosModel->where('id',base64_decode($id))->update($updateData);

        return $result;
    }
    public function delete($id)
    {
        $result = $this->VideosModel->where('id',base64_decode($id))->delete();
       return $result;
    }
}
