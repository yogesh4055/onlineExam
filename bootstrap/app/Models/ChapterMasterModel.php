<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterMasterModel extends Model
{
	protected $table = 'chaptermaster';
	protected $fillable = ['chapterID', 'chapterCode', 'chapterName', 'seoUri','standardID','subjectID','status','description'];
}
