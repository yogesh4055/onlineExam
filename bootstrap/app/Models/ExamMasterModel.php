<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMasterModel extends Model
{
	protected $table = 'exammaster';
	protected $fillable = ['examId','examName', 'examCode', 'examPrice', 'examTime','examMark','status','created_at','updated_at'];
}
