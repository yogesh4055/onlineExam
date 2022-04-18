<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicMasterModel extends Model
{
	protected $table = 'topicmaster';
	protected $fillable = ['topicID', 'topicCode', 'topicName', 'seoUri','chapterID','subjectID','standardID','status'];
}
