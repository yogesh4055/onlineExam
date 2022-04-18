<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionMasterModel extends Model
{
	protected $table = 'masterexamquestion';
	protected $fillable = ['examQuestionId', 'examId', 'totalQuestion', 'markPerQuestion','negativeMarking','questionSelection','standardID','subjectID','chapterID','topicID','questionType','questionIds','status'];
}
