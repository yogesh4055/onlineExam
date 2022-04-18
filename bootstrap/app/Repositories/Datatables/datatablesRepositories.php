<?php

namespace App\Repositories\Datatables;
use App\Models\User as UserModel;
use App\Models\SubjectMasterModel;
use Auth;
use DB;

class datatablesRepositories
{
    public function __construct(UserModel $user,SubjectMasterModel $SubjectMasterModel)
    {
        $this->UserModel                 = $user;
        $this->SubjectMasterModel        = $SubjectMasterModel;
    }
    public function getStandardRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "standardCode";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "standardName";

        if ($request->input('order')[0]['column'] == 3) 
        $column = "standardName";


        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('standardmaster')->select('standardmaster.*');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(standardName LIKE "%'.$keyword.'%" OR standardCode LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('standardID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal'] = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/standard/edit/'.base64_encode($row->standardID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/standard/delete/'.base64_encode($row->standardID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->standardCode;
               $final_array[$i][1] = $row->standardName;
               $final_array[$i][2] = $status;
               $final_array[$i][3] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getSubjectRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "subjectCode";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "subjectName";


        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('subjectmaster')->select('subjectmaster.*', 'standardmaster.standardName','subjectmaster.subjectID')
                                              ->join('standardmaster','subjectmaster.standardID','=','standardmaster.standardID');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(subjectName LIKE "%'.$keyword.'%" OR subjectCode LIKE "%'.$keyword.'%" OR standardmaster.standardName LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('subjectID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal'] = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/subject/edit/'.base64_encode($row->subjectID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/subject/delete/'.base64_encode($row->subjectID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->subjectCode;
               $final_array[$i][1] = $row->subjectName;
               $final_array[$i][2] = $row->standardName;
               $final_array[$i][3] = $status;
               $final_array[$i][4] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getChapterRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "subjectCode";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "subjectName";


        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('chaptermaster')->select('chaptermaster.*', 'standardmaster.standardName', 'subjectmaster.subjectName')
                                               ->join('standardmaster', 'chaptermaster.standardID', '=', 'standardmaster.standardID')
                                               ->join('subjectmaster', 'chaptermaster.subjectID', '=', 'subjectmaster.subjectID');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(chapterName LIKE "%'.$keyword.'%" OR chapterCode LIKE "%'.$keyword.'%" OR standardmaster.standardName LIKE "%'.$keyword.'%" OR subjectmaster.subjectName LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('subjectID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/chapter/edit/'.base64_encode($row->chapterID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/chapter/delete/'.base64_encode($row->chapterID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->chapterCode;
               $final_array[$i][1] = $row->chapterName;
               $final_array[$i][2] = $row->standardName;
               $final_array[$i][3] = $row->subjectName;
               $final_array[$i][4] = $status;
               $final_array[$i][5] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getTopicRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "topicCode";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "topicName";

        if ($request->input('order')[0]['column'] == 3) 
        $column = "standardmaster.standardName";

        if ($request->input('order')[0]['column'] == 4) 
        $column = "subjectmaster.subjectName";

         if ($request->input('order')[0]['column'] == 5) 
        $column = "chaptermaster.chapterName";



        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('topicmaster')->select('topicmaster.topicID','topicmaster.topicCode','topicmaster.topicName','topicmaster.seoUri', 'standardmaster.standardName', 'subjectmaster.subjectName', 'chaptermaster.chapterName','topicmaster.status')
                    ->join('standardmaster', 'topicmaster.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'topicmaster.subjectID', '=', 'subjectmaster.subjectID')
                    ->join('chaptermaster', 'topicmaster.chapterID', '=', 'chaptermaster.chapterID');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(topicmaster.topicName LIKE "%'.$keyword.'%" OR chapterCode LIKE "%'.$keyword.'%" OR standardmaster.standardName LIKE "%'.$keyword.'%" OR subjectmaster.subjectName LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('topicID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/topic/edit/'.base64_encode($row->topicID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/topic/delete/'.base64_encode($row->topicID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->topicCode;
               $final_array[$i][1] = $row->topicName;
               $final_array[$i][2] = $row->chapterName;
               $final_array[$i][3] = $row->standardName;
               $final_array[$i][4] = $row->subjectName;
               $final_array[$i][5] = $status;
               $final_array[$i][6] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getQuestionRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "question";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "option_type";

        if ($request->input('order')[0]['column'] == 3) 
        $column = "standardmaster.standardName";

        if ($request->input('order')[0]['column'] == 4) 
        $column = "subjectmaster.subjectName";

        if ($request->input('order')[0]['column'] == 5) 
        $column = "chaptermaster.chapterName";

        if ($request->input('order')[0]['column'] == 6) 
        $column = "topicmaster.topicName";



        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('questionmaster')->select('questionmaster.questionID',
                                                      'questionmaster.questionCode',
                                                      'questionmaster.question',
                                                      'topicmaster.topicName',
                                                      'questionmaster.option_type', 
                                                      'standardmaster.standardName', 
                                                      'subjectmaster.subjectName', 
                                                      'chaptermaster.chapterName',
                                                      'questionmaster.status')
                    ->join('standardmaster', 'questionmaster.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'questionmaster.subjectID', '=', 'subjectmaster.subjectID')
                    ->join('chaptermaster', 'questionmaster.chapterID', '=', 'chaptermaster.chapterID')
                    ->join('topicmaster', 'questionmaster.topicID', '=', 'topicmaster.topicID');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(questionmaster.question LIKE "%'.$keyword.'%" OR questionCode LIKE "%'.$keyword.'%" OR standardmaster.standardName LIKE "%'.$keyword.'%" OR subjectmaster.subjectName LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('questionID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/question/edit/'.base64_encode($row->questionID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/question/delete/'.base64_encode($row->questionID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->questionCode;
               $final_array[$i][1] = strip_tags($row->question);
               $final_array[$i][2] = ($row->option_type == 1)?'With Options':'No Options';
               $final_array[$i][3] = $row->standardName;
               $final_array[$i][4] = $row->subjectName;
               $final_array[$i][5] = $row->chapterName;
               $final_array[$i][6] = $row->topicName;
               $final_array[$i][7] = $status;
               $final_array[$i][8] = $build_view_action;
               $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getExamRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "examName";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "examPrice";

        if ($request->input('order')[0]['column'] == 3) 
        $column = "examTime";

        if ($request->input('order')[0]['column'] == 4) 
        $column = "examMark";



        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('exammaster')->select('exammaster.*');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(examCode LIKE "%'.$keyword.'%" OR examName LIKE "%'.$keyword.'%" OR examPrice LIKE "%'.$keyword.'%" OR examTime LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('examId','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/exam/edit/'.base64_encode($row->examId).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/exam/delete/'.base64_encode($row->examId).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->examCode;
               $final_array[$i][1] = $row->examName;
               $final_array[$i][2] = $row->examPrice;
               $final_array[$i][3] = $row->examTime;
               $final_array[$i][4] = $row->examMark;
               $final_array[$i][5] = $status;
               $final_array[$i][6] = $build_view_action;
               $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getExamQuestionRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "examName";

       if ($request->input('order')[0]['column'] == 2) 
        $column = "standardmaster.standardName";

        if ($request->input('order')[0]['column'] == 3) 
        $column = "subjectmaster.subjectName";

        if ($request->input('order')[0]['column'] == 4) 
        $column = "chaptermaster.chapterName";

        if ($request->input('order')[0]['column'] == 5) 
        $column = "topicmaster.topicName";


        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('masterexamquestion')->select('masterexamquestion.examQuestionId','exammaster.examName','exammaster.examCode','topicmaster.topicName', 'standardmaster.standardName', 'subjectmaster.subjectName', 'chaptermaster.chapterName','masterexamquestion.status')
                    ->join('exammaster', 'masterexamquestion.examId', '=', 'exammaster.examId')
                    ->join('standardmaster', 'masterexamquestion.standardID', '=', 'standardmaster.standardID')
                    ->join('subjectmaster', 'masterexamquestion.subjectID', '=', 'subjectmaster.subjectID')
                    ->join('chaptermaster', 'masterexamquestion.chapterID', '=', 'chaptermaster.chapterID')
                    ->join('topicmaster', 'masterexamquestion.topicID', '=', 'topicmaster.topicID');


        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(examQuestionId LIKE "%'.$keyword.'%" OR examName LIKE "%'.$keyword.'%" OR exammaster.examCode LIKE "%'.$keyword.'%" OR topicmaster.topicName LIKE "%'.$keyword.'%" OR standardmaster.standardName LIKE "%'.$keyword.'%" OR subjectmaster.subjectName LIKE "%'.$keyword.'%" OR chaptermaster.chapterName LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('examQuestionId','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/exam-question/edit/'.base64_encode($row->examQuestionId).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/exam-question/delete/'.base64_encode($row->examQuestionId).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';

               $final_array[$i][0] = $row->examCode;
               $final_array[$i][1] = $row->examName;
               $final_array[$i][2] = $row->standardName;
               $final_array[$i][3] = $row->subjectName;
               $final_array[$i][4] = $row->chapterName;
               $final_array[$i][5] = $row->topicName;
               $final_array[$i][6] = $status;
               $final_array[$i][7] = $build_view_action;
               $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getCourseRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "courseCode";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "courseTitle";

        if ($request->input('order')[0]['column'] == 3) 
        $column = "price";


        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('coursemaster')->select('coursemaster.*');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(courseCode LIKE "%'.$keyword.'%" OR  courseTitle LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('courseID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal'] = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/course/edit/'.base64_encode($row->courseID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/course/delete/'.base64_encode($row->courseID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

                if($row->status == 1)
                $status = '<span class="badge alert-success">Active</span>';
                else
                $status =  '<span class="badge alert-danger">In-Active</span>';


               $final_array[$i][0] = $key+ 1;
               $final_array[$i][1] = $row->courseCode;
               $final_array[$i][2] = $row->courseTitle;
               $final_array[$i][3] = $row->price;
               $final_array[$i][4] = $status;
               $final_array[$i][5] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }
    public function getSubCourseRecords($request)
    {
        $arrData  =  $final_array=[]; 
        $column = '';

        $keyword = $request->input('search')['value'];  


        if ($request->input('order')[0]['column'] == 1) 
        $column = "subCourseTitle";

        if ($request->input('order')[0]['column'] == 2) 
        $column = "coursemaster.courseTitle";


        $order = strtoupper($request->input('order')[0]['dir']);           

        $obj_data =  DB::table('subcoursemaster')->select('subcoursemaster.*', 'coursemaster.courseTitle')
                                              ->join('coursemaster','coursemaster.courseID','=','subcoursemaster.courseID');

        if (isset($keyword) && $keyword!= '') 
        $obj_data = $obj_data->whereRaw('(subCourseTitle LIKE "%'.$keyword.'%" OR coursemaster.courseTitle LIKE "%'.$keyword.'%")');  

        $count = $obj_data->get()->count();
        if($order =='ASC' && $column=='')
        {
          $obj_data  = $obj_data->orderBy('subCourseID','DESC')->limit($request->input('length'))->offset($request->input('start'));
        }
        if( $order !='' && $column!='' )
        {
          $obj_data = $obj_data->orderBy($column,$order)->limit($request->input('length'))->offset($request->input('start'));
        }

        $arrData = $obj_data->get();
        $resp['recordsTotal'] = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn='' ; 
        
        if(count($arrData)>0)
        {
            $i=0;
            foreach($arrData as $key => $row)
            {
                $build_view_action ='<div class="d-flex align-items-center gap-3 fs-6">'; 

                $build_view_action .= '<a href="'.url('/').'/admin/sub-course/edit/'.base64_encode($row->subCourseID).'" class="text-warning" title="Update Password" aria-label="Update"><ion-icon name="pencil-sharp"></ion-icon></a>'; 
                
                $build_view_action .= '&nbsp;<a href="'.url('/').'/admin/sub-course/delete/'.base64_encode($row->subCourseID).'" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>';

                $build_view_action .= '</div>';

              

               $final_array[$i][0] = $key+1;
               $final_array[$i][1] = $row->subCourseTitle;
               $final_array[$i][2] = $row->courseTitle;
               $final_array[$i][3] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    }

}
