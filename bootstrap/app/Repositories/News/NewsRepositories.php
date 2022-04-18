<?php

namespace App\Repositories\News;
use App\Models\User as UserModel;
use App\Models\NewsModel;
use App\Models\CategoriesModel;
use App\Models\IndustriesModel;
use Auth;
use DataTables;

class NewsRepositories
{
    public function __construct(UserModel $user,NewsModel $news,CategoriesModel $categories,IndustriesModel $industries)
    {
        $this->UserModel        = $user;
        $this->NewsModel        = $news;
        $this->CategoriesModel  = $categories;
        $this->IndustriesModel  = $industries;
    }
    public function index($request)
    {
        $arrData = $this->NewsModel->with('get_category_name','get_industry_name')->orderBy('id','DESC')->paginate(10);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/news/index';
        $data['pageTitle']        = 'News';
        return $data;
        /*if ($request->ajax()) 
        {
            
            $data = $this->NewsModel::orderBy('id','DESC')->get();
            $arrdata =  Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $view_href =  env('BASE_URL').'admin/news/edit/'.base64_encode($row->id);
                                $build_view_action = '<a class="" href="'.$view_href.'" title="View"><i class="lni lni-pencil-alt"></i></a>';
                                $edit_href =  env('BASE_URL').'admin/news/delete/'.base64_encode($row->id);
                                $build_view_action .= '<a class="" href="'.$view_href.'" title="View"><i class="lni lni-trash"></i></a>';
                                return $build_view_action;
                            });

            $arrdata = $arrdata->editColumn('created_at', function($row){
                            return date('d-M-Y h:i A',strtotime($row->created_at));
                        }) ;

            $arrdata = $arrdata->addColumn('industry_name', function($row){
                            $industry_name = getIndustryName($row->industry_id);
                            return $industry_name ;
                        });              

            $arrdata = $arrdata->rawColumns(['action','industry_name']);
            $arrdata = $arrdata->make(true);
            return $arrdata;

        }
        else
        {
            $data['middleContent']    = 'admin/news/index';
            $data['pageTitle']        = 'News';
            return $data;
        }*/
    }
    public function create($request)
    {
        $arrCategories = $this->CategoriesModel->where('parent_slug','news')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/news/create';
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

        $result = $this->NewsModel->create($insertData);

        return $result;
    }
    public function edit($id)
    {
        $arrdata       = $this->NewsModel->where('id',base64_decode($id))->first();
        $arrCategories = $this->CategoriesModel->where('parent_slug','news')->get()->toArray();
        $arrIndustries = $this->IndustriesModel->get()->toArray();

        $data['arrdata']          =  $arrdata;
        $data['arrCategories']    =  $arrCategories;
        $data['arrIndustries']    =  $arrIndustries;
        $data['middleContent']    = 'admin/news/edit';
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

        $result = $this->NewsModel->where('id',base64_decode($id))->update($updateData);

        return $result;
    }
    public function delete($id)
    {
        $result = $this->NewsModel->where('id',base64_decode($id))->delete();
       return $result;
    }
}
