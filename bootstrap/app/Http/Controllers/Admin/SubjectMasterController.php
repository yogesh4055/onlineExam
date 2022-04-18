<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class SubjectMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexSubject($request);
    	$data['pageTitle']        = 'Subject';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getSubjectRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createSubject($request);
        $data['pageTitle']        = 'subject';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {
        $request->validate([
            'subjectName'         => 'required',
            'status'              => 'required',
            'subjectCode'         =>'required',
            'standardID'         => 'required',
        ]);
        $result = $this->masterRepositories->storeSubject($request);
        if ($result) 
        return redirect('admin/subject')->withSuccess('Subject Added Successfully!'); 
        else
        return redirect('admin/subject')->withError('Error occured while adding subject'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editSubject($id);
        $data['pageTitle']        = 'subject ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
            'subjectName'  => 'required',
            'status'        => 'required',
        ]);

        $result = $this->masterRepositories->updateSubject($id,$request);
        if ($result) 
        return redirect('admin/subject')->withSuccess('Subject updated successfully'); 
        else
        return redirect('admin/subject')->withError('Error occured while adding Subject'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteSubject($id);
        if ($result) 
        return redirect('admin/subject')->withSuccess('Subject deleted successfully'); 
        else
        return redirect('admin/subject')->withError('Error occured while deleting Subject'); 
    }

     //subject






}
