<?php

namespace App\Repositories\Gallery;
use App\Models\User as UserModel;
use App\Models\GalleryModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use App\Models\GalleryImagesModel;
use Auth;
use DataTables;

class GalleryRepositories
{
    public function __construct(UserModel $user,GalleryModel $gallery,CategoriesModel $categories,IndustriesModel $industries,GalleryImagesModel $gallery_image)
    {
        $this->UserModel           = $user;
        $this->GalleryModel        = $gallery;
        $this->CategoriesModel     = $categories;
        $this->IndustriesModel     = $industries;
        $this->GalleryImagesModel  = $gallery_image;
    }
    public function index($request)
    {
        $arrData = $this->GalleryModel->with('get_category_name','get_industry_name')->orderBy('id','DESC')->paginate(10);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/gallery/index';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function create($request)
    {
        $arrCategories = $this->CategoriesModel->where('parent_slug','gallery')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/gallery/create';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function store($request)
    {
        $formData = $request->all();
        $insertData['user_id']           = Auth::id();
        $insertData['title']             = $formData['title'];
        $insertData['category_id']       = $formData['category_id'];
        $insertData['industry_id']       = $formData['industry_id'];
        $insertData['meta_keywords']     = $formData['meta_keywords'];
        $insertData['description']       = $formData['description'];

        $result = $this->GalleryModel->create($insertData);
        if ($result) 
        {
            if ($request->file('files')) 
            {
                $arrFiles = $request->file('files');
                foreach ($arrFiles as $key => $photo) 
                {
                    $destinationPath = public_path('uploads/gallery/'.$result->id);
                    $name       = $photo->getClientOriginalName();
                    $imageName  = 'gallery_image_'.$key.$result->id.'.'.$photo->extension();  
                    $photo->move($destinationPath, $imageName);

                    $imageData['gallery_id']  =  $result->id;
                    $imageData['image']       =  $imageName;
                    $this->GalleryImagesModel->create($imageData);
                }
            }
        }
        return $result;
    }
    public function edit($id)
    {
        $arrdata       = $this->GalleryModel->where('id',base64_decode($id))->first();
        $arrCategories = $this->CategoriesModel->where('parent_slug','gallery')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();
        $arrImages     = $this->GalleryImagesModel->where('gallery_id',base64_decode($id))->get()->toArray();

        $data['arrdata']          =  $arrdata;
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/gallery/edit';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function view($id)
    {
        $arrImages     = $this->GalleryImagesModel->where('gallery_id',base64_decode($id))->get();
        foreach ($arrImages as $key => $value) 
        {
            $arrImages[$key]['imagePath'] = url('/').'/uploads/gallery/'.$value->gallery_id.'/'.$value->image;
        }
        $data['arrImages']        =  $arrImages;
        $data['middleContent']    = 'admin/gallery/view';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function update($id,$request)
    {
        $id = base64_decode($id);
        $formData = $request->all();
        if ($request->file('files')) 
        {
            $arrFiles = $request->file('files');
            foreach ($arrFiles as $key => $photo) 
            {
                $destinationPath = public_path('uploads/gallery/'.$id);
                $name       = $photo->getClientOriginalName();
                $imageName  = 'gallery_image_'.$key.$id.'.'.$photo->extension();  
                $photo->move($destinationPath, $imageName);

                $imageData['gallery_id']  =  $id;
                $imageData['image']       =  $imageName;
                $this->GalleryImagesModel->create($imageData);
            }
        }
        $updateData['title']             = $formData['title'];
        $updateData['category_id']       = $formData['category_id'];
        $updateData['industry_id']       = $formData['industry_id'];
        $updateData['meta_keywords']     = $formData['meta_keywords'];
        $updateData['description']       = $formData['description'];

        $result = $this->GalleryModel->where('id',base64_decode($id))->update($updateData);

        return $result;
    }
    public function delete($id)
    {
        $result = $this->GalleryModel->where('id',base64_decode($id))->delete();
       return $result;
    }
}
