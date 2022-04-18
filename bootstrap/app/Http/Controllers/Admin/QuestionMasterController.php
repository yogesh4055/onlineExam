<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class QuestionMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexQuestion($request);
    	$data['pageTitle']        = 'Question';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getQuestionRecords($request);
        return $data;
    }
    
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createQuestion($request);
        $data['pageTitle']        = 'Question';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
         $arr_rules = [];

        
        if (empty($request["question"])) $arr_rules["question"] = "required";
        if (empty($request["answerA"])) $arr_rules[""] = "required";
        if($request['option_type'] == 1){
            if (empty($request["answerB"])) $arr_rules["answerB"] = "required";
            if (empty($request["answerC"])) $arr_rules["answerC"] = "required";
            if (empty($request["answerD"])) $arr_rules["answerD"] = "required";
            if (empty($request["correctAnswer"])) $arr_rules["correctAnswer"] = "required";
        }
        
        if (empty($request["standard"])) $arr_rules["standard"] = "required";
        if (empty($request["subject"])) $arr_rules["subject"] = "required";
        if (empty($request["chapter"])) $arr_rules["chapter"] = "required";
        if (empty($request["topic"])) $arr_rules["topic"] = "required";
        if (empty($request["questionCode"])) $arr_rules["questionCode"] = "required";



        $customMessages = [
                    "question.required" => "Please Insert Question ",
                    "answerA.required" => "Please Insert Answer A ",
                    "answerB.required" => "Please Insert Answer B",
                    "answerC.required" => "Please Insert Answer C",
                    "answerD.required" => "Please Insert Answer D",
                    "correctAnswer.required" => "Please Select Correct Answer",
                    "standard.required" => "Please Select standard",
                    "subject.required" => "Please Select Subject",
                    "chapter.required" => "Please Select Chapter",
                    "topic.required" => "Please Select topic",
                    "questionCode.required" => "Please Insert Question Code",

        ];



        $this->validate($request, $arr_rules, $customMessages);

   
        $result = $this->masterRepositories->storeQuestion($request);
        if ($result) 
        return redirect('admin/question')->withSuccess('Question Added successfully'); 
        else
        return redirect('admin/question')->withError('Error occured while adding Question'); 
    }
    public function edit($id)
    {   

        $data = $this->masterRepositories->editQuestion($id);
        $data['pageTitle']        = 'Question ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {   
          $arr_rules = [];

        
        if (empty($request["question"])) $arr_rules["question"] = "required";
        if (empty($request["answerA"])) $arr_rules[""] = "required";
        if($request['option_type'] == 1){
            if (empty($request["answerB"])) $arr_rules["answerB"] = "required";
            if (empty($request["answerC"])) $arr_rules["answerC"] = "required";
            if (empty($request["answerD"])) $arr_rules["answerD"] = "required";
            if (empty($request["correctAnswer"])) $arr_rules["correctAnswer"] = "required";
        }
        
        if (empty($request["standard"])) $arr_rules["standard"] = "required";
        if (empty($request["subject"])) $arr_rules["subject"] = "required";
        if (empty($request["chapter"])) $arr_rules["chapter"] = "required";
        if (empty($request["topic"])) $arr_rules["topic"] = "required";
        if (empty($request["questionCode"])) $arr_rules["questionCode"] = "required";



        $customMessages = [
                    "question.required" => "Please Insert Question ",
                    "answerA.required" => "Please Insert Answer A ",
                    "answerB.required" => "Please Insert Answer B",
                    "answerC.required" => "Please Insert Answer C",
                    "answerD.required" => "Please Insert Answer D",
                    "correctAnswer.required" => "Please Select Correct Answer",
                    "standard.required" => "Please Select standard",
                    "subject.required" => "Please Select Subject",
                    "chapter.required" => "Please Select Chapter",
                    "topic.required" => "Please Select topic",
                    "questionCode.required" => "Please Insert Question Code",

        ];



        $this->validate($request, $arr_rules, $customMessages);


/*
       $request->validate([
            'topicCode'         => 'required',
            'status'            => 'required',
            'topicName'         =>'required',
            'standard'          => 'required',
            'subject'           => 'required',
            'chapter'           => 'required',
        ]);*/

        $result = $this->masterRepositories->updateQuestion($id,$request);
        if ($result) 
        return redirect('admin/question')->withSuccess('Question updated successfully'); 
        else
        return redirect('admin/question')->withError('Error occured while adding Question'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteQuestion($id);
        if ($result) 
        return redirect('admin/question')->withSuccess('Question deleted successfully'); 
        else
        return redirect('admin/question')->withError('Error occured while deleting Question'); 
    }


}
