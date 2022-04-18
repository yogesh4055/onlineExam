<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Master\MasterRepositories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Auth;
class CommanMasterController extends Controller
{
    public function __construct(MasterRepositories $masterRepositories)
    {
    	$this->masterRepositories = $masterRepositories;
    }
    //Standard
    public function getSubject(Request $request)
    {
    	$data = $this->masterRepositories->getSubject($request);
        return response()->json($data);
    }

     public function getChapter(Request $request)
    {
        $data = $this->masterRepositories->getChapter($request);
        return response()->json($data);
    }

    public function getTopic(Request $request)
    {
        $data = $this->masterRepositories->getTopic($request);
        return response()->json($data);
    }
    public function getQuestion(Request $request)
    {
        $data = $this->masterRepositories->getQuestion($request);
        return response()->json($data);
    }

   
}
