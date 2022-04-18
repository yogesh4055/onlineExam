<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Repositories\Datatables\datatablesRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class StandardMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories,datatablesRepositories $datatablesRepositories)
    {
        $this->masterRepositories     = $masterRepositories;
    	$this->datatablesRepositories = $datatablesRepositories;
    }
    public function index(Request $request)
    {
    	$data = $this->masterRepositories->indexStandard($request);
    	$data['pageTitle']        = 'Standard';
    	return view('admin/template')->with($data);  
    }
    public function getRecords(Request $request)
    {
        $data = $this->datatablesRepositories->getStandardRecords($request);
        return $data;
    }
    public function create(Request $request)
    {
        $data = $this->masterRepositories->createStandard($request);
        $data['pageTitle']        = 'Standard';
        return view('admin/template')->with($data);  
    }
    public function store(Request $request)
    {
        $request->validate([
            'standardName'  => 'required',
            'standardCode'  => 'required',
            'status'        => 'required',
        ]);
        $result = $this->masterRepositories->storeStandard($request);
        if ($result) 
        return redirect('admin/standard')->withSuccess('Standard Added successfully'); 
        else
        return redirect('admin/standard')->withError('Error occured while adding Standard'); 
    }
    public function edit($id)
    {
        $data = $this->masterRepositories->editStandard($id);
        $data['pageTitle']        = 'Standard ';
        return view('admin/template')->with($data);  
    }
    public function update($id,Request $request)
    {
       $request->validate([
            'standardName'  => 'required',
            'standardCode'  => 'required',
            'status'        => 'required',
        ]);

        $result = $this->masterRepositories->updateStandard($id,$request);
        if ($result) 
        return redirect('admin/standard')->withSuccess('Standard updated successfully'); 
        else
        return redirect('admin/standard')->withError('Error occured while adding Standard'); 
    }
    public function delete($id)
    {
        $result = $this->masterRepositories->deleteStandard($id);
        if ($result) 
        return redirect('admin/standard')->withSuccess('Standard deleted successfully'); 
        else
        return redirect('admin/standard')->withError('Error occured while deleting Standard'); 
    }
}
