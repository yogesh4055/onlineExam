<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class TopicMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexTopic($request);
    	$data['pageTitle']        = 'Topic';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getTopicRecords($request);
        return $data;
    }
    
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createTopic($request);
        $data['pageTitle']        = 'Topic';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
        $request->validate([
            'topicCode'         => 'required',
            'status'            => 'required',
            'topicName'         =>'required',
            'standard'          => 'required',
            'subject'           => 'required',
            'chapter'           => 'required',
        ]);
        $result = $this->masterRepositories->storeTopic($request);
        if ($result) 
        return redirect('admin/topic')->withSuccess('Topic Added successfully'); 
        else
        return redirect('admin/topic')->withError('Error occured while adding Topic'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editTopic($id);
        $data['pageTitle']        = 'Topic ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
            'topicCode'         => 'required',
            'status'            => 'required',
            'topicName'         =>'required',
            'standard'          => 'required',
            'subject'           => 'required',
            'chapter'           => 'required',
        ]);

        $result = $this->masterRepositories->updateTopic($id,$request);
        if ($result) 
        return redirect('admin/topic')->withSuccess('Topic updated successfully'); 
        else
        return redirect('admin/topic')->withError('Error occured while adding Topic'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteTopic($id);
        if ($result) 
        return redirect('admin/topic')->withSuccess('Topic deleted successfully'); 
        else
        return redirect('admin/topic')->withError('Error occured while deleting Topic'); 
    }


}
