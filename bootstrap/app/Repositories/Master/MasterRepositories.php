<?php

namespace App\Repositories\Master;
use App\Models\User as UserModel;
use App\Models\StandardMaster;
use App\Models\SubjectMasterModel;
use App\Models\ChapterMasterModel;
use App\Models\TopicMasterModel;
use App\Models\QuestionMasterModel;
use App\Models\ExamMasterModel;
use App\Models\ExamQuestionMasterModel;
use App\Models\CourseMasterModel;
use App\Models\SubCourseMasterModel;

use Auth;
use DataTables;

class MasterRepositories
{
    public function __construct(UserModel $user,
            StandardMaster $standardMaster,
            SubjectMasterModel $subjectMaster,
            ChapterMasterModel $chapterMaster,
            TopicMasterModel $topicMaster,
            QuestionMasterModel $questionMaster,
            ExamMasterModel $examMaster,
            ExamQuestionMasterModel $examQuestionMaster,
            CourseMasterModel $courseMaster,
            SubCourseMasterModel $subcourseMaster
            )
    {
        $this->UserModel        = $user;
        $this->standardMaster   = $standardMaster;
        $this->subjectMaster    = $subjectMaster;
        $this->chapterMaster    = $chapterMaster;
        $this->topicMaster      = $topicMaster;
        $this->questionMaster   = $questionMaster;
        $this->examMaster       = $examMaster;
        $this->examQuestionMaster = $examQuestionMaster;
        $this->courseMaster = $courseMaster;
        $this->SubCourseMaster = $subcourseMaster;
        $this->perPage = 10;
    }
    public function indexStandard($request)
    {
        $arrData = $this->standardMaster->orderBy('standardID','DESC')->paginate($this->perPage);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/standard/index';
        $data['pageTitle']        = 'Standard';
        return $data;
    }
    public function createStandard($request)
    {
        $data['middleContent']    = 'admin/standard/create';
        $data['pageTitle']        = 'Standard';
        return $data;
    }
    public function storeStandard($request)
    {
        $formData = $request->all();

        $insertData['standardName']     = $formData['standardName'];
        $insertData['status']           = $formData['status'];
        $insertData['description']      = $formData['description'];
        $insertData['standardCode']     = $formData['standardCode'];

        $result = $this->standardMaster->create($insertData);
        return $result;
    }
    public function editStandard($id)
    {
        $arrdata       = $this->standardMaster->where('standardID',base64_decode($id))->first();
       
        $data['arrdata']          =  $arrdata;
        $data['middleContent']    = 'admin/standard/edit';
        $data['pageTitle']        = 'Standard';
        return $data;
    }
    public function updateStandard($id,$request)
    {
        $formData = $request->all();
        $updateData['standardName']     = $formData['standardName'];
        $updateData['status']           = $formData['status'];
        $updateData['description']      = $formData['description'];
        $updateData['standardCode']     = $formData['standardCode'];
        $result = $this->standardMaster->where('standardID',base64_decode($id))->update($updateData);
        return $result;
    }
    public function deleteStandard($id)
    {
        $result = $this->standardMaster->where('standardID',base64_decode($id))->delete();
       return $result;
    }

    //Subject


    public function indexSubject($request)
    {
        $arrData = $this->subjectMaster->orderBy('subjectID','DESC')->select('subjectmaster.*', 'standardmaster.standardName','subjectmaster.subjectID')
                    ->join('standardmaster', 'subjectmaster.standardID', '=', 'standardmaster.standardID')->paginate($this->perPage);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/subject/index';
        $data['pageTitle']        = 'Subject';
        return $data;
    }

    public function createSubject($request)
    {   
        $arrStandard            = $this->standardMaster->where('status','1')->get()->toArray();
        $data['arrStandard']    =  $arrStandard;
        $data['middleContent']  = 'admin/subject/create';
        $data['pageTitle']      = 'subject';
        return $data;
    }

    public function storeSubject($request)
    {
        $formData = $request->all();
        $insertData['subjectCode'] = $formData['subjectCode'];
        $insertData['subjectName'] = $formData['subjectName'];
        $insertData['standardID']  = $formData['standardID'];
        $insertData['status']      = $formData['status'];
        $insertData['seoUri']      = $formData['seoUri'];
        $insertData['description'] = $formData['description'];
        $result = $this->subjectMaster->create($insertData);
        return $result;
    }


    public function editSubject($id)
    {  
        $arrdata        = $this->subjectMaster->where('subjectID',base64_decode($id))->first();
        $arrStandard    = $this->standardMaster->where('status','1')->get()->toArray();
        $data['arrdata']          =  $arrdata;
         $data['arrStandard']    =  $arrStandard;
        $data['middleContent']    = 'admin/subject/edit';
        $data['pageTitle']        = 'subject';
        return $data;
    }


     public function updateSubject($id,$request)
    {
        $formData = $request->all();
        $updateData['subjectCode']     = $formData['subjectCode'];
        $updateData['subjectName']     = $formData['subjectName'];
        $updateData['standardID']      = $formData['standardID'];
        $updateData['status']          = $formData['status'];
        $updateData['seoUri']          = $formData['seoUri'];
        $updateData['description']     = $formData['description'];
        $result = $this->subjectMaster->where('subjectID',base64_decode($id))->update($updateData);
        return $result;
    }

    public function deleteSubject($id)
    {
       $result = $this->subjectMaster->where('subjectID',base64_decode($id))->delete();
       return $result;
    }

    //indexChapter

     public function indexChapter($request)
    {
        $arrData = $this->chapterMaster->orderBy('subjectID','DESC')
                    ->select('chaptermaster.*', 'standardmaster.standardName', 'subjectmaster.subjectName')
                    ->join('standardmaster', 'chaptermaster.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'chaptermaster.subjectID', '=', 'subjectmaster.subjectID')
                    ->paginate($this->perPage);

        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/chapter/index';
        $data['pageTitle']        = 'Subject';
        return $data;
    }

    public function createChapter($request)
    {   
        $arrSubject           = $this->subjectMaster->where('status','1')->get()->toArray();
        $arrStandard            = $this->standardMaster->where('status','1')->get()->toArray();

        $data['arrStandard']    =  $arrStandard;
        $data['arrSubject']     =  $arrSubject;
        $data['middleContent']    = 'admin/chapter/create';
        $data['pageTitle']        = 'chapter';
        return $data;
    }

    public function editChapter($id)
    {  
        $arrdata        = $this->chapterMaster->where('chapterID',base64_decode($id))->first();
        $arrStandard    = $this->standardMaster->where('status','1')->get()->toArray();
        $arrSubject     = $this->subjectMaster->where('status','1')->where('standardID',$arrdata->standardID)->get()->toArray();

        $data['arrdata']            =  $arrdata;
        $data['arrStandard']        =  $arrStandard;
        $data['arrSubject']         =  $arrSubject;
        $data['middleContent']    = 'admin/chapter/edit';
        $data['pageTitle']        = 'chapter';
        return $data;
    }


     public function updateChapter($id,$request)
    {
        $formData = $request->all();
        $updateData['chapterCode'] = $formData['chapterCode'];
        $updateData['chapterName'] = $formData['chapterName'];
        $updateData['standardID']  = $formData['standardID'];
        $updateData['subjectID']      = $formData['subjectID'];
        $updateData['status']      = $formData['status'];
        $updateData['seoUri']       = $formData['seoUri'];
        $updateData['description']      = $formData['description'];
        $result = $this->chapterMaster->where('chapterID',base64_decode($id))->update($updateData);
        return $result;
    }

    
     public function storeChapter($request)
    {
        $formData = $request->all();
        $insertData['chapterCode'] = $formData['chapterCode'];
        $insertData['chapterName'] = $formData['chapterName'];
        $insertData['standardID']  = $formData['standardID'];
        $insertData['subjectID']      = $formData['subjectID'];
        $insertData['seoUri']      = $formData['seoUri'];
        $insertData['status']      = $formData['status'];
        $insertData['description']      = $formData['description'];
        $result = $this->chapterMaster->create($insertData);
        return $result;
    }

    public function deleteChapter($id)
    {
       $result = $this->chapterMaster->where('chapterID',base64_decode($id))->delete();
       return $result;
    }

//Chapter end 

   public function indexTopic($request)
    {
        $arrData = $this->topicMaster->orderBy('topicID','DESC')
                    ->select('topicmaster.topicID','topicmaster.topicCode','topicmaster.topicName','topicmaster.seoUri', 'standardmaster.standardName', 'subjectmaster.subjectName', 'chaptermaster.chapterName','topicmaster.status')
                    ->join('standardmaster', 'topicmaster.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'topicmaster.subjectID', '=', 'subjectmaster.subjectID')
                    ->join('chaptermaster', 'topicmaster.chapterID', '=', 'chaptermaster.chapterID')
                    ->paginate($this->perPage);
     
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/topic/index';
        $data['pageTitle']        = 'Topic';
        return $data;
    }

    public function createTopic($request)
    {   
        $arrtopic           = $this->topicMaster->where('status','1')->get()->toArray();

        $arrStandard          = $this->standardMaster->where('status','1')->get()->toArray();
        $data['arrStandard']    =  $arrStandard;
        $data['arrtopic']       =  $arrtopic;
        $data['middleContent']    = 'admin/topic/create';
        $data['pageTitle']        = 'Topic';
        return $data;
    }

    public function storeTopic($request)
    {
        $formData = $request->all();
        $insertData['standardID']   = $formData['standard'];
        $insertData['subjectID']    = $formData['subject'];
        $insertData['chapterID']    = $formData['chapter'];
        $insertData['topicCode']    = $formData['topicCode'];
        $insertData['topicName']    = $formData['topicName'];
        $insertData['status']       = $formData['status'];
        $result = $this->topicMaster->create($insertData);
        return $result;
    }

       public function editTopic($id)
    {  
        $arrdata                = $this->topicMaster->where('topicID',base64_decode($id))->first();
        $arrStandard          = $this->standardMaster->where('status','1')->get()->toArray();
        $data['arrdata']        =  $arrdata;
        $data['arrStandard']    =  $arrStandard;
        $data['middleContent']  = 'admin/topic/edit';
        $data['pageTitle']      = 'Topic';
        return $data;
    }


     public function updateTopic($id,$request)
    {
        $formData = $request->all();
        $updateData['standardID']   = $formData['standard'];
        $updateData['subjectID']    = $formData['subject'];
        $updateData['chapterID']    = $formData['chapter'];
        $updateData['topicCode']    = $formData['topicCode'];
        $updateData['topicName']    = $formData['topicName'];
        $updateData['status']       = $formData['status'];
        $result = $this->topicMaster->where('topicID',base64_decode($id))->update($updateData);
        return $result;
    }

    public function deleteTopic($id)
    {
       $result = $this->topicMaster->where('topicID',base64_decode($id))->delete();
       return $result;
    } 

    //end topic 

    public function indexQuestion($request)
    {
        $arrData = $this->questionMaster
                    ->select('questionmaster.questionID','questionmaster.questionCode','questionmaster.question','topicmaster.topicName','questionmaster.option_type', 'standardmaster.standardName', 'subjectmaster.subjectName', 'chaptermaster.chapterName','questionmaster.status')

                    ->join('standardmaster', 'questionmaster.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'questionmaster.subjectID', '=', 'subjectmaster.subjectID')
                    ->join('chaptermaster', 'questionmaster.chapterID', '=', 'chaptermaster.chapterID')
                    ->join('topicmaster', 'questionmaster.topicID', '=', 'topicmaster.topicID')
                    ->orderBy('questionmaster.questionID','DESC')
                    ->paginate($this->perPage);
     
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/question/index';
        $data['pageTitle']        = 'Question';
        return $data;
    }
    

    //Question


     public function createQuestion($request)
    {   
        $arrtopic               = $this->topicMaster->where('status','1')->get()->toArray();
        $arrStandard            = $this->standardMaster->where('status','1')->get()->toArray();
     
        $data['arrStandard']    =  $arrStandard;
        $data['arrtopic']       =  $arrtopic;
        $data['middleContent']  = 'admin/question/create';
        $data['pageTitle']       = 'Question';
        return $data;
    }

    


      public function storeQuestion($request)
    {   
       
        $formData = $request->all();
         

        $insertData['standardID']   = $formData['standard'];
        $insertData['subjectID']    = $formData['subject'];
        $insertData['chapterID']    = $formData['chapter'];
        $insertData['topicID']    = $formData['topic'];
        $insertData['questionCode']    = $formData['questionCode'];
        $insertData['question']       = $formData['question'];
        $insertData['answerA']       = $formData['answerA'];
        $insertData['answerB']       = $formData['answerB'];
        $insertData['answerC']       = $formData['answerC'];
        $insertData['answerD']       = $formData['answerD'];
        $insertData['answerHint']       = $formData['answerHint'];
        $insertData['status']       = $formData['status'];
        if($formData['option_type'] == 2)
             $insertData['correctAnswer']       = 'A';
         else
             $insertData['correctAnswer']       = $formData['correctAnswer'];


        $result = $this->questionMaster->create($insertData);
        return $result;
    }


    public function editQuestion($id)
    {  
        $arrdata                = $this->questionMaster->where('questionID',base64_decode($id))->first();
        $arrStandard            = $this->standardMaster->where('status','1')->get()->toArray();
        $data['arrdata']        =  $arrdata;
        $data['arrStandard']    =  $arrStandard;
        $data['middleContent']  = 'admin/question/edit';
        $data['pageTitle']      = 'Question';
        return $data;
    }


     public function updateQuestion($id,$request)
    {
        $formData = $request->all();
        $updateData['standardID']   = $formData['standard'];
        $updateData['subjectID']    = $formData['subject'];
        $updateData['chapterID']    = $formData['chapter'];
        $updateData['topicID']      = $formData['topic'];
        $updateData['questionCode'] = $formData['questionCode'];
        $updateData['question']     = $formData['question'];
        $updateData['answerA']       = $formData['answerA'];
        $updateData['answerB']       = $formData['answerB'];
        $updateData['answerC']       = $formData['answerC'];
        $updateData['answerD']       = $formData['answerD'];
        $updateData['answerHint']       = $formData['answerHint'];
        $updateData['status']       = $formData['status'];
        if($formData['option_type'] == 2)
             $updateData['correctAnswer']       = 'A';
         else
             $updateData['correctAnswer']       = $formData['correctAnswer'];
        $result = $this->questionMaster->where('questionID',base64_decode($id))->update($updateData);
        return $result;
    }

    public function deleteQuestion($id)
    {
       $result = $this->questionMaster->where('questionID',base64_decode($id))->delete();
       return $result;
    } 


    // exam 


    public function indexExam($request)
    {
        $arrData = $this->examMaster->orderBy('examId','DESC')->paginate($this->perPage);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/exam/index';
        $data['pageTitle']        = 'Exam';
        return $data;
    }
    public function createExam($request)
    {
        $data['middleContent']    = 'admin/exam/create';
        $data['pageTitle']        = 'Exam';
        return $data;
    }
    public function storeExam($request)
    {
        $formData = $request->all();
        $insertData['examName']     = isset($formData['examName']) ? $formData['examName'] : '';
        $insertData['examCode']     = isset($formData['examCode']) ? $formData['examCode'] : '';
        $insertData['examPrice']    = isset($formData['examPrice']) ? $formData['examPrice'] : '';
        $insertData['examTime']     = isset($formData['examTime']) ? $formData['examTime'] : '';
        $insertData['examMark']     = isset($formData['examMark']) ? $formData['examMark'] : '';
        $insertData['status']       = isset($formData['status']) ? $formData['status'] : '';

        $result = $this->examMaster->create($insertData);
        return $result;
    }
    public function editExam($id)
    {
        $arrdata       = $this->examMaster->where('examId',base64_decode($id))->first();
        $data['arrdata']          =  $arrdata;
        $data['middleContent']    = 'admin/exam/edit';
        $data['pageTitle']        = 'Exam';
        return $data;
    }
    public function updateExam($id,$request)
    {
        $formData = $request->all();
        $updateData['examName']     = isset($formData['examName']) ? $formData['examName'] : '';
        $updateData['examCode']     = isset($formData['examCode']) ? $formData['examCode'] : '';
        $updateData['examPrice']    = isset($formData['examPrice']) ? $formData['examPrice'] : '';
        $updateData['examTime']     = isset($formData['examTime']) ? $formData['examTime'] : '';
        $updateData['examMark']     = isset($formData['examMark']) ? $formData['examMark'] : '';
        $updateData['status']       = isset($formData['status']) ? $formData['status'] : '';
        $result = $this->examMaster->where('examId',base64_decode($id))->update($updateData);
        return $result;
    }
    
    public function deleteExam($id)
    {
        $result = $this->examMaster->where('examId',base64_decode($id))->delete();
       return $result;
    }




    public function indexExamQuestion($request)
    {
        $arrData = $this->examQuestionMaster
                    ->select('masterexamquestion.examQuestionId','exammaster.examName','exammaster.examCode','topicmaster.topicName', 'standardmaster.standardName', 'subjectmaster.subjectName', 'chaptermaster.chapterName','masterexamquestion.status')
                    ->join('exammaster', 'masterexamquestion.examId', '=', 'exammaster.examId')
                    ->join('standardmaster', 'masterexamquestion.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'masterexamquestion.subjectID', '=', 'subjectmaster.subjectID')
                    ->join('chaptermaster', 'masterexamquestion.chapterID', '=', 'chaptermaster.chapterID')
                    ->join('topicmaster', 'masterexamquestion.topicID', '=', 'topicmaster.topicID')
                    ->orderBy('masterexamquestion.examQuestionId','DESC')
                    ->paginate($this->perPage);
     
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/examQuestion/index';
        $data['pageTitle']        = 'Exam Question';
        return $data;
    }



     public function createExamQuestion($request)
    {   
        $arrexam               = $this->examMaster->where('status','1')->get()->toArray();
        $arrStandard            = $this->standardMaster->where('status','1')->get()->toArray();
        $data['arrStandard']    =  $arrStandard;
        $data['arrexam']       =  $arrexam;
        $data['middleContent']  = 'admin/examQuestion/create';
        $data['pageTitle']       = 'Question';
        return $data;
    }


     public function storeExamQuestion($request)
    {
        $formData = $request->all();
       
        $insertData['examId']     = isset($formData['exam']) ? $formData['exam'] : '';
        $insertData['totalQuestion']     = isset($formData['totalQuestion']) ? $formData['totalQuestion'] : '';
        $insertData['markPerQuestion']    = isset($formData['markPerQuestion']) ? $formData['markPerQuestion'] : '';
        $insertData['negativeMarking']     = isset($formData['negativeMarking']) ? $formData['negativeMarking'] : '';
        $insertData['questionSelection']     = isset($formData['questionSelection']) ? $formData['questionSelection'] : '';
        $insertData['standardID']       = isset($formData['standard']) ? $formData['standard'] : '';
        $insertData['subjectID']       = isset($formData['subject']) ? $formData['subject'] : '';
        $insertData['chapterID']       = isset($formData['chapter']) ? $formData['chapter'] : '';
        $insertData['topicID']       = isset($formData['topic']) ? $formData['topic'] : '';
        $insertData['status']       = isset($formData['status']) ? $formData['status'] : '';
        $insertData['questionType']       = isset($formData['questionType']) ? $formData['questionType'] : '';

        if (isset($formData['checked_questionIds'])) 
        {
            $insertData['questionIds']  = implode(',', $formData['checked_questionIds']);
        }
        
        $result = $this->examQuestionMaster->create($insertData);
        return $result;
    }


    public function editExamQuestion($id)
    {  
        $arrQuestion = $arrQuestionId = [];
        $arrdata  = $this->examQuestionMaster->where('examQuestionId',base64_decode($id))->first();

        if (isset($arrdata->questionIds) && $arrdata->questionIds !='') 
        {
            $arrQuestionId = explode(',',  $arrdata->questionIds);
            $arrQuestion         = $this->questionMaster->where('status','1')
                                                        ->where('topicID',$arrdata->topicID)
                                                        ->whereIn('questionID',$arrQuestionId)
                                                        ->get();
        }
       
        $arrdata['arrQuestion'] = $arrQuestion;
        $arrdata['arrQuestionId'] = $arrQuestionId;
        $arrStandard            = $this->standardMaster->where('status','1')->get()->toArray();
        $arrexam                = $this->examMaster->where('status','1')->get()->toArray();
        $data['arrdata']        =  $arrdata;
        $data['arrStandard']    =  $arrStandard;
        $data['arrexam']        =  $arrexam;
        $data['middleContent']  = 'admin/examQuestion/edit';
        $data['pageTitle']      = 'Exam Question';
        return $data;
    }


      public function updateExamQuestion($id,$request)
    {
        $formData = $request->all();
        $updateData['examId']     = isset($formData['exam']) ? $formData['exam'] : '';
        $updateData['totalQuestion']     = isset($formData['totalQuestion']) ? $formData['totalQuestion'] : '';
        $updateData['markPerQuestion']    = isset($formData['markPerQuestion']) ? $formData['markPerQuestion'] : '';
        $updateData['negativeMarking']     = isset($formData['negativeMarking']) ? $formData['negativeMarking'] : '';
        $updateData['questionSelection']     = isset($formData['questionSelection']) ? $formData['questionSelection'] : '';
        $updateData['standardID']       = isset($formData['standard']) ? $formData['standard'] : '';
        $updateData['subjectID']       = isset($formData['subject']) ? $formData['subject'] : '';
        $updateData['chapterID']       = isset($formData['chapter']) ? $formData['chapter'] : '';
        $updateData['topicID']       = isset($formData['topic']) ? $formData['topic'] : '';
        $updateData['status']       = isset($formData['status']) ? $formData['status'] : '';
        $updateData['questionType']       = isset($formData['questionType']) ? $formData['questionType'] : '';

        if (isset($formData['checked_questionIds'])) 
        {
            $insertData['questionIds']  = implode(',', $formData['checked_questionIds']);
        }
        
        $result = $this->examQuestionMaster->where('examQuestionId',base64_decode($id))->update($updateData);
        return $result;
    }
   
    public function deleteExamQuestion($id)
    {
        $result = $this->examQuestionMaster->where('examQuestionId',base64_decode($id))->delete();
       return $result;
    }


    

     public function indexCourse($request)
    {
        $arrData = $this->courseMaster->orderBy('courseID','DESC')->paginate($this->perPage);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/course/index';
        $data['pageTitle']        = 'Course';
        return $data;
    }

    public function createCourse($request)
    {   
        $data['middleContent']    = 'admin/course/create';
        $data['pageTitle']        = 'Course';
        return $data;
    }

     public function storeCourse($request)
    {
        $formData = $request->all();
        $insertData['courseCode']   = $formData['courseCode'];
        $insertData['courseTitle']    = $formData['courseTitle'];
        $insertData['price']    = $formData['price'];
        $insertData['shortDescription']    = $formData['shortDescription'];
        $insertData['description']    = $formData['description'];
        $insertData['status']       = $formData['status'];
        $result = $this->courseMaster->create($insertData);
        return $result;
    }

         public function editCourse($id)
    {  
        $arrdata                = $this->courseMaster->where('courseID',base64_decode($id))->first();
        $data['arrdata']        =  $arrdata;
        $data['middleContent']  = 'admin/course/edit';
        $data['pageTitle']      = 'Course';
        return $data;
    }


     public function updateCourse($id,$request)
    {
        $formData = $request->all();
        $updateData['courseCode']   = $formData['courseCode'];
        $updateData['courseTitle']    = $formData['courseTitle'];
        $updateData['price']    = $formData['price'];
        $updateData['shortDescription']    = $formData['shortDescription'];
        $updateData['description']    = $formData['description'];
        $updateData['status']       = $formData['status'];
        
        $result = $this->courseMaster->where('courseID',base64_decode($id))->update($updateData);
        return $result;
    }

     public function deleteCourse($id)
    {
       $result = $this->courseMaster->where('courseID',base64_decode($id))->delete();
       return $result;
    } 

    public function indexSubCource($request)
    {
        $arrData = $this->SubCourseMaster->orderBy('subCourseID','DESC')->paginate($this->perPage);
        $data['arrdata']          = $arrData;
        $data['middleContent']    = 'admin/subcourse/index';
        $data['pageTitle']        = 'Course';
        return $data;
    }
     public function createSubCource($request)
    {   
        $arrCourseData   = $this->courseMaster->orderBy('courseID','DESC')->get();
        $arrExamData     = $this->examMaster->orderBy('examId','DESC')->paginate($this->perPage);

        $data['arrCourseData']        = $arrCourseData;
        $data['arrExamData']          = $arrExamData;
        $data['middleContent']        = 'admin/subcourse/create';
        $data['pageTitle']            = 'Course';
        return $data;
    }

     public function storeSubCource($request)
    {
        $formData = $request->all();
        $insertData['courseID']        = $formData['courseID'];
        $insertData['subCourseTitle']  = $formData['subCourseTitle'];
        if (isset($formData['checked_examIds'])) 
        {
            $insertData['examIds']  = implode(',', $formData['checked_examIds']);
        }

        $result = $this->SubCourseMaster->create($insertData);
        return $result;
    }

    public function editSubCource($id)
    {  
        $arrdata         = $this->SubCourseMaster->where('subCourseID',base64_decode($id))->first();
        if(isset( $arrdata->examIds) &&  $arrdata->examIds != '')
        $arrdata->arrExamids = explode(',', $arrdata->examIds);

        $arrCourseData   = $this->courseMaster->orderBy('courseID','DESC')->get();
        $arrExamData     = $this->examMaster->orderBy('examId','DESC')->paginate($this->perPage);

        $data['arrCourseData']        = $arrCourseData;
        $data['arrExamData']          = $arrExamData;
        $data['arrdata']        =  $arrdata;
        $data['middleContent']  = 'admin/subcourse/edit';
        $data['pageTitle']      = 'Course';
        return $data;
    }


     public function updateSubCource($id,$request)
    {
        $formData = $request->all();
        $updateData['courseID']        = $formData['courseID'];
        $updateData['subCourseTitle']  = $formData['subCourseTitle'];
        if (isset($formData['checked_examIds'])) 
        {
            $updateData['examIds']  = implode(',', $formData['checked_examIds']);
        }
        $result = $this->SubCourseMaster->where('subCourseID',base64_decode($id))->update($updateData);
        return $result;
    }
    public function deleteSubCource($id)
    {
       $result = $this->SubCourseMaster->where('subCourseID',base64_decode($id))->delete();
       return $result;
    } 


    // Comman
    public function getSubject($request)
    {   
      
      $standardID = $request->standard;
      $arrSubject          = $this->subjectMaster->where('status','1')->where('standardID',$standardID)->get()->toArray();
       return $arrSubject;
    }

    public function getChapter($request)
    {   
      $subjectID = $request->subject;
      $arrChapter         = $this->chapterMaster->where('status','1')->where('subjectID',$subjectID)->get()->toArray();
       return $arrChapter;
    }

    public function getTopic($request)
    {   
      $chapterID = $request->chapterID;
      $arrChapter         = $this->topicMaster->where('status','1')->where('chapterID',$chapterID)->get()->toArray();
       return $arrChapter;
    }

    public function getQuestion($request)
    {   
        $html = '';
        $topicId = $request->topicId;
        $arrQuestion         = $this->questionMaster->where('status','1')->where('topicId',$topicId)->get();
        if (isset($arrQuestion) && !empty($arrQuestion)) 
        {
            foreach ($arrQuestion as $key => $value) 
            {
                $html .= '<tr>';
                $html .= '<td><input type="checkbox" name="checked_questionIds[]" class="checked_examIds" value="'.$value->questionID.'"/></td>';
                $html .= '<td>'.$value->questionCode.'</td><td>'.strip_tags($value->question).'</td>';
                $html .= '</tr>';
            }
        }
        return $html;
    }

    
    
}
