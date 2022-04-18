<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class SubCourseMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexSubCource($request);
    	$data['pageTitle']        = 'SubCource';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getSubCourseRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createSubCource($request);
        $data['pageTitle']        = 'SubCource';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
        
        $request->validate([
            'courseID'         => 'required',
            'subCourseTitle'   => 'required'
        ]);
        $result = $this->masterRepositories->storeSubCource($request);
        if ($result) 
        return redirect('admin/sub-course')->withSuccess('SubCource Added successfully'); 
        else
        return redirect('admin/sub-course')->withError('Error occured while adding SubCource'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editSubCource($id);
        $data['pageTitle']        = 'SubCource ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
            'courseID'         => 'required',
            'subCourseTitle'   => 'required'
        ]);

        $result = $this->masterRepositories->updateSubCource($id,$request);
        if ($result) 
        return redirect('admin/sub-course')->withSuccess('Sub Cource updated successfully'); 
        else
        return redirect('admin/sub-course')->withError('Error occured while adding SubCource'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteSubCource($id);
        if ($result) 
        return redirect('admin/sub-course')->withSuccess('SubCource deleted successfully'); 
        else
        return redirect('admin/sub-course')->withError('Error occured while deleting SubCource'); 
    }


}
