<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class ExamQuestionMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexExamQuestion($request);
    	$data['pageTitle']        = 'Exam Question';
    	return view('admin/template')->with($data);  
    }
     public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getExamQuestionRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createExamQuestion($request);
        $data['pageTitle']        = 'Exam Question';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
        /*$request->validate([
                'exam'                => 'required',
                'totalQuestion'       => 'required',
                'markPerQuestion'     => 'required',
                'negativeMarking'     => 'required',
                'standard'            => 'required',
                'subject'             => 'required',
                'chapter'             => 'required',
                'topic'               => 'required',
                'checked_questionIds' => 'required|array|min:totalQuestion',
                ]);*/
        

        $result = $this->masterRepositories->storeExamQuestion($request);
        if ($result) 
        return redirect('admin/exam-question')->withSuccess('Exam Question Added successfully'); 
        else
        return redirect('admin/exam-question')->withError('Error occured while adding Exam Question'); 
    }
    public function storeValidate(Request $request)
    { 
        $arrRules = [];
        $arrRules = [
                    'exam'                => 'required',
                    'totalQuestion'       => 'required',
                    'markPerQuestion'     => 'required',
                    'negativeMarking'     => 'required',
                    'standard'            => 'required',
                    'subject'             => 'required',
                    'chapter'             => 'required',
                    'topic'               => 'required'
                    ];
        if ($request->questionSelection == 'Manual') 
           $arrRules['checked_questionIds'] = 'required';

        $request->validate($arrRules);

        if (isset($request->checked_questionIds) && count($request->checked_questionIds) < $request->totalQuestion)
        {
            $json_arr['status'] = 'error';
            $json_arr['errors']['checked_questionIds'][0] = 'Please select minimum '.$request->totalQuestion.' questions';

            return response()->json($json_arr, 422);
        }
        $json_arr['status'] = 'success';
        return response()->json($json_arr);
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editExamQuestion($id);
       
        $data['pageTitle']        = 'Exam Question';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
                'exam'              => 'required',
                'totalQuestion'     => 'required',
                'markPerQuestion'   => 'required',
                'negativeMarking'   => 'required',
                'standard'          => 'required',
                'subject'           => 'required',
                'chapter'           => 'required',
                'topic'             => 'required',
        ]);

        $result = $this->masterRepositories->updateExamQuestion($id,$request);
        if ($result) 
        return redirect('admin/exam-question')->withSuccess('Exam Question updated successfully'); 
        else
        return redirect('admin/exam-question')->withError('Error occured while adding Exam Question'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteExamQuestion($id);
        if ($result) 
        return redirect('admin/exam-question')->withSuccess('Exam Question deleted successfully'); 
        else
        return redirect('admin/exam-question')->withError('Error occured while deleting Exam Question'); 
    }

}
