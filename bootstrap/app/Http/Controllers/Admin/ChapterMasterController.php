<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class ChapterMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    //Standard
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexChapter($request);
    	$data['pageTitle']        = 'Chapter';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getChapterRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createChapter($request);
        $data['pageTitle']        = 'Chapter';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {   
        $request->validate([
            'chapterName'         => 'required',
            'status'              => 'required',
            'chapterCode'         => 'required',
            'standardID'          => 'required',
            'subjectID'           => 'required'
        ]);
        $result = $this->masterRepositories->storeChapter($request);
        if ($result) 
        return redirect('admin/chapter')->withSuccess('Chapter Added successfully'); 
        else
        return redirect('admin/chapter')->withError('Error occured while adding Chapter'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editChapter($id);
        $data['pageTitle']        = 'Chapter ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
            'chapterName'   => 'required',
            'standardID'    => 'required',
            'subjectID'     => 'required',
            'status'        => 'required',
        ]);

        $result = $this->masterRepositories->updateChapter($id,$request);
        if ($result) 
        return redirect('admin/chapter')->withSuccess('Chapter updated successfully'); 
        else
        return redirect('admin/chapter')->withError('Error occured while adding Chapter'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteChapter($id);
        if ($result) 
        return redirect('admin/chapter')->withSuccess('Chapter deleted successfully'); 
        else
        return redirect('admin/chapter')->withError('Error occured while deleting Chapter'); 
    }

     //Chapter






}
