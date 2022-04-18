<?php

namespace App\Repositories\Categories;
use App\Models\User as UserModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use App\Models\GalleryImagesModel;
use Illuminate\Support\Str;
use Auth;
use DataTables;

class CategoryRepositories
{
    public function __construct(UserModel $user,CategoriesModel $categories)
    {
        $this->UserModel           = $user;
        $this->CategoriesModel     = $categories;
    }
    public function index($slug,$id,$request)
    {

        $arrData = $this->CategoriesModel->orderBy('id','DESC');

        if (isset($slug) && $slug != false && $id != false) 
        {
            $arrData = $arrData->where('parent_id',base64_decode($id))->where('parent_slug',$slug);
        }
        else
        {
            $arrData = $arrData->where('parent_id',0);
        }        
        $arrData = $arrData->paginate(10);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/categories/index';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function store($request)
    {
        $formData = $request->all();
        $slug   = $formData['parent_slug'];
        $id     = $formData['parent_id'];
        if ($slug != '' && $id != '') 
        {
            $insertData['parent_id']               = $id;
            $insertData['parent_slug']             = $slug;
        }
        else
        {
            $insertData['parent_id']        = 0;
        }
        $insertData['name']             = $formData['name'];
        $insertData['slug']             = Str::slug($formData['name'], '-');
       
        $result = $this->CategoriesModel->create($insertData);

        if ($slug != '' && $id != '') 
        {
            $slug = Str::slug($formData['name'], '-');
            $slug = $slug.'-'.$result->id; 
            $this->CategoriesModel->where('id',$result->id)->update(['slug'=>$slug]);
        }

        return $result;
    }
    public function edit($id)
    {
        $data       = $this->CategoriesModel->where('id',$id)->first();
        return $data;
    }
    public function update($id,$request)
    {
        //$id = base64_decode($id);
        $formData = $request->all();
        $slug   = $formData['parent_slug'];
        $parent_id     = $formData['parent_id'];
        /*if ($slug != '' && $id != '') 
        {
            $updateData['parent_id']               = $id;
            $updateData['parent_slug']             = $slug;
        }
        else
        {
            $updateData['parent_id']        = 0;
        }*/
        $updateData['name']             = $formData['name'];
        $result = $this->CategoriesModel->where('id',$id)->update($updateData);
        return $result;
    }
    public function delete($id)
    {
        $data['parent_id']   =  '';
        $data['parent_slug']  = '';

        $ischild = $this->CategoriesModel->where('id',base64_decode($id))->where('parent_id','!=' ,0)->first();

        if (isset($ischild) && $ischild!= null) 
        {
            $data['parent_id']   =  $ischild->parent_id;
            $data['parent_slug'] =  $ischild->parent_slug;
        }
        else
        {
           $this->CategoriesModel->where('parent_id',base64_decode($id))->delete();
        }   
        $result = $this->CategoriesModel->where('id',base64_decode($id))->delete();
        return $data;
    }
}
