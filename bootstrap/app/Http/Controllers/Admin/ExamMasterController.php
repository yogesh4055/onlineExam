<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class ExamMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexExam($request);
    	$data['pageTitle']        = 'Exam';
    	return view('admin/template')->with($data);  
    }
     public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getExamRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createExam($request);
        $data['pageTitle']        = 'Exam';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
        $request->validate([
            'examName'         => 'required',
            'examCode'            => 'required',
            'examPrice'         =>'required',
            'examTime'          => 'required',
            'examMark'           => 'required',
        ]);
        $result = $this->masterRepositories->storeExam($request);
        if ($result) 
        return redirect('admin/exam')->withSuccess('Exam Added successfully'); 
        else
        return redirect('admin/exam')->withError('Error occured while adding Exam'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editExam($id);
        $data['pageTitle']        = 'Exam ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
            'examName'        => 'required',
            'examCode'        => 'required',
            'examPrice'       =>'required',
            'examTime'        => 'required',
            'examMark'        => 'required',
        ]);

        $result = $this->masterRepositories->updateExam($id,$request);
        if ($result) 
        return redirect('admin/exam')->withSuccess('Exam updated successfully'); 
        else
        return redirect('admin/exam')->withError('Error occured while adding Exam'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteExam($id);
        if ($result) 
        return redirect('admin/exam')->withSuccess('Exam deleted successfully'); 
        else
        return redirect('admin/exam')->withError('Error occured while deleting Exam'); 
    }

}
