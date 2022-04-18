<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class CourseMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexCourse($request);
    	$data['pageTitle']        = 'Course';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getCourseRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createCourse($request);
        $data['pageTitle']        = 'Course';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
        $request->validate([
            'courseCode'   => 'required',
            'courseTitle'  => 'required',
            'price'         =>'required',
            'shortDescription'=> 'required',
            'description'  => 'required',
            
        ]);
        $result = $this->masterRepositories->storeCourse($request);
        if ($result) 
        return redirect('admin/course')->withSuccess('Course Added successfully'); 
        else
        return redirect('admin/course')->withError('Error occured while adding Course'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editCourse($id);
        $data['pageTitle']        = 'Course ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
             'courseCode'   => 'required',
            'courseTitle'  => 'required',
            'price'         =>'required',
            'shortDescription'=> 'required',
            'description'  => 'required',
            
        ]);

        $result = $this->masterRepositories->updateCourse($id,$request);
        if ($result) 
        return redirect('admin/course')->withSuccess('Course updated successfully'); 
        else
        return redirect('admin/course')->withError('Error occured while adding Course'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteCourse($id);
        if ($result) 
        return redirect('admin/course')->withSuccess('Course deleted successfully'); 
        else
        return redirect('admin/course')->withError('Error occured while deleting Course'); 
    }


}
