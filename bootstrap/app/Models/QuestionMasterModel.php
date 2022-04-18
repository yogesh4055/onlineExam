<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionMasterModel extends Model
{
	protected $table = 'questionmaster';
	protected $fillable = ['questionID', 'questionCode', 'question', 'answerA','answerA','answerC','answerD','correctAnswer','answerHint','seoUri','standardID','subjectID','chapterID','topicID','status','option_type'];
}
