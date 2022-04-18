<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StandardMasterController;
use App\Http\Controllers\Admin\SubjectMasterController;
use App\Http\Controllers\Admin\ChapterMasterController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\TopicMasterController;
use App\Http\Controllers\Admin\CommanMasterController;
use App\Http\Controllers\Admin\QuestionMasterController;
use App\Http\Controllers\Admin\ExamMasterController;
use App\Http\Controllers\Admin\ExamQuestionMasterController;
use App\Http\Controllers\Admin\CourseMasterController;
use App\Http\Controllers\Admin\SubCourseMasterController;

use App\Http\Controllers\Front\AuthController as FrontAuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'guest'], function () 
{
	Route::group(['prefix'=>'admin'], function () 
	{
		Route::get('', [AuthController::class, 'index']);
		Route::post('/login',    [AuthController::class, 'login'])->name('login');
		Route::get('/dashboard', [DashboardController::class, 'index']);
	});
});

Route::group(['middleware' => 'auth.basic'], function () 
{
	Route::group(['prefix'=>'admin'], function () 
	{	
		Route::get('/logout',    [AuthController::class, 'logout'])->name('logout'); 
		Route::get('/dashboard',   		[DashboardController::class, 'index']);
		Route::get('/edit_profile',   	[ProfileController::class, 'index']);
		Route::post('/update_profile',  [ProfileController::class, 'update']);

		Route::group(['prefix'=>'standard'], function () 
        {
			Route::get('',        		[StandardMasterController::class, 'index'])->name('standard.index');
        	Route::post('get_records',  [StandardMasterController::class, 'getRecords']);
			Route::get('/create', 		[StandardMasterController::class, 'create']);
			Route::post('/store', 		[StandardMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[StandardMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[StandardMasterController::class, 'edit']);
			Route::post('/update/{id}',	[StandardMasterController::class, 'update']);
		});


		Route::group(['prefix'=>'subject'], function () 
        {
			Route::get('',        		[SubjectMasterController::class, 'index']);
			Route::post('get_records',  [SubjectMasterController::class, 'getRecords']);
			Route::get('/create', 		[SubjectMasterController::class, 'create']);
			Route::post('/store', 		[SubjectMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[SubjectMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[SubjectMasterController::class, 'edit']);
			Route::post('/update/{id}',	[SubjectMasterController::class, 'update']);
		});

		Route::group(['prefix'=>'chapter'], function () 
        {
			Route::get('',        		[ChapterMasterController::class, 'index']);
			Route::post('get_records',  [ChapterMasterController::class, 'getRecords']);
			Route::get('/create', 		[ChapterMasterController::class, 'create']);
			Route::post('/store', 		[ChapterMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[ChapterMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[ChapterMasterController::class, 'edit']);
			Route::post('/update/{id}',	[ChapterMasterController::class, 'update']);
		});


		Route::group(['prefix'=>'topic'], function () 
        {
			Route::get('',        		[TopicMasterController::class, 'index']);
			Route::post('get_records',  [TopicMasterController::class, 'getRecords']);
			Route::get('/create', 		[TopicMasterController::class, 'create']);
			Route::post('/store', 		[TopicMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[TopicMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[TopicMasterController::class, 'edit']);
			Route::post('/update/{id}',	[TopicMasterController::class, 'update']);

		});

		Route::group(['prefix'=>'question'], function () 
        {
			Route::get('',        		[QuestionMasterController::class, 'index']);
			Route::post('get_records',  [QuestionMasterController::class, 'getRecords']);
			Route::get('/create', 		[QuestionMasterController::class, 'create']);
			Route::post('/store', 		[QuestionMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[QuestionMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[QuestionMasterController::class, 'edit']);
			Route::post('/update/{id}',	[QuestionMasterController::class, 'update']);

		});


		Route::group(['prefix'=>'exam'], function () 
        {
			Route::get('',        		[ExamMasterController::class, 'index']);
			Route::post('get_records',  [ExamMasterController::class, 'getRecords']);
			Route::get('/create', 		[ExamMasterController::class, 'create']);
			Route::post('/store', 		[ExamMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[ExamMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[ExamMasterController::class, 'edit']);
			Route::post('/update/{id}',	[ExamMasterController::class, 'update']);

		});

		Route::group(['prefix'=>'exam-question'], function () 
        {
			Route::get('',        		[ExamQuestionMasterController::class, 'index']);
			Route::post('get_records',  [ExamQuestionMasterController::class, 'getRecords']);
			Route::get('/create', 		[ExamQuestionMasterController::class, 'create']);
			Route::post('/store', 		[ExamQuestionMasterController::class, 'store']);
			Route::post('/validate',    [ExamQuestionMasterController::class, 'storeValidate']);
			Route::get('/delete/{id}', 	[ExamQuestionMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[ExamQuestionMasterController::class, 'edit']);
			Route::post('/update/{id}',	[ExamQuestionMasterController::class, 'update']);

		});

		Route::group(['prefix'=>'course'], function () 
        {
			Route::get('',        		[CourseMasterController::class, 'index']);
			Route::post('get_records',  [CourseMasterController::class, 'getRecords']);
			Route::get('/create', 		[CourseMasterController::class, 'create']);
			Route::post('/store', 		[CourseMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[CourseMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[CourseMasterController::class, 'edit']);
			Route::post('/update/{id}',	[CourseMasterController::class, 'update']);

		});

		Route::group(['prefix'=>'sub-course'], function () 
        {
			Route::get('',        		[SubCourseMasterController::class, 'index']);
			Route::post('get_records',  [SubCourseMasterController::class, 'getRecords']);
			Route::get('/create', 		[SubCourseMasterController::class, 'create']);
			Route::post('/store', 		[SubCourseMasterController::class, 'store']);
			Route::get('/delete/{id}', 	[SubCourseMasterController::class, 'delete']);
			Route::get('/edit/{id}',   	[SubCourseMasterController::class, 'edit']);
			Route::post('/update/{id}',	[SubCourseMasterController::class, 'update']);

		});





		Route::post('/getSubject',   	[CommanMasterController::class, 'getSubject']);
		Route::post('/getChapter',   	[CommanMasterController::class, 'getChapter']);
		Route::post('/getTopic',   		[CommanMasterController::class, 'getTopic']);
		Route::post('/getQuestion',   		[CommanMasterController::class, 'getQuestion']);
		

		Route::group(['prefix'=>'users'], function () 
        {
			Route::get('',        				[UsersController::class, 'index']);
		});

	});
	
});


Route::get('/', function () 
{ 
	$data['middleContent']    = 'front/home';
	$data['pageTitle']        = 'Online Exam - Home';
	return view('front/template')->with($data);  
});

Route::get('sign-up', [FrontAuthController::class, 'signUp']);
Route::get('sign-in', [FrontAuthController::class, 'signIn']);
