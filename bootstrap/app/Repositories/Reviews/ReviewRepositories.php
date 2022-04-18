<?php

namespace App\Repositories\Reviews;
use App\Models\User as UserModel;
use App\Models\AdminReviewsModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use App\Models\GalleryImagesModel;
use Auth;
use DataTables;

class ReviewRepositories
{
    public function __construct(UserModel $user,AdminReviewsModel $admin_reviews,CategoriesModel $categories,IndustriesModel $industries)
    {
        $this->UserModel           = $user;
        $this->AdminReviewsModel   = $admin_reviews;
        $this->CategoriesModel     = $categories;
        $this->IndustriesModel     = $industries;
    }
    public function index($request)
    {
        $arrData = $this->AdminReviewsModel->with('get_category_name','get_industry_name')->orderBy('id','DESC')->paginate(10);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/reviews/index';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function create($request)
    {
        $arrCategories = $this->CategoriesModel->where('parent_slug','video')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/reviews/create';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function store($request)
    {
        $formData = $request->all();
        $insertData['user_id']         = Auth::id();
        $insertData['title']           = $formData['title'];
        $insertData['category_id']     = $formData['category_id'];
        $insertData['industry_id']     = $formData['industry_id'];
        $insertData['release_date']    = $formData['release_date'];
        $insertData['director']        = $formData['director'];
        $insertData['producers']       = $formData['producers'];
        $insertData['music_director']  = $formData['music_director'];
        $insertData['starring']        = $formData['starring'];
        $insertData['story']           = $formData['story'];

        $result = $this->AdminReviewsModel->create($insertData);
        if ($result) 
        {
            if ($request->file('image')) 
            {
                $destinationPath = public_path('uploads/reviews/'.$result->id);
                $name = $request->file('image')->getClientOriginalName();
                $imageName  = 'review_'.$result->id.'.'.$request->image->extension();  
                $request->file('image')->move($destinationPath, $imageName);;
                $imageData['image']       =  $imageName;
                $this->AdminReviewsModel->where('id',$result->id)->update($imageData);
            }
        }
        return $result;
    }
    public function edit($id)
    {
        $arrdata       = $this->AdminReviewsModel->where('id',base64_decode($id))->first();
        $arrCategories = $this->CategoriesModel->where('parent_slug','video')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();

        $data['arrdata']          =  $arrdata;
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/reviews/edit';
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
        $data['middleContent']    = 'admin/reviews/view';
        $data['pageTitle']        = 'News';
        return $data;
    }
    public function update($id,$request)
    {
        $id = base64_decode($id);
        $formData = $request->all();
        $updateData['title']           = $formData['title'];
        $updateData['category_id']     = $formData['category_id'];
        $updateData['industry_id']     = $formData['industry_id'];
        $updateData['release_date']    = $formData['release_date'];
        $updateData['director']        = $formData['director'];
        $updateData['producers']       = $formData['producers'];
        $updateData['music_director']  = $formData['music_director'];
        $updateData['starring']        = $formData['starring'];
        $updateData['story']           = $formData['story'];
        if ($request->file('image')) 
        {
            $destinationPath = public_path('uploads/reviews/'.$id);
            $name = $request->file('image')->getClientOriginalName();
            $imageName  = 'review_'.$id.'.'.$request->image->extension();  
            $request->file('image')->move($destinationPath, $imageName);
            $updateData['image']       =  $imageName;
        }
        $result = $this->AdminReviewsModel->where('id',$id)->update($updateData);

        return $result;
    }
    public function delete($id)
    {
        $result = $this->AdminReviewsModel->where('id',base64_decode($id))->delete();
       return $result;
    }
}
