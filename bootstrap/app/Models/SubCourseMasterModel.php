<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCourseMasterModel extends Model
{
	protected $table = 'subcoursemaster';
	protected $fillable = ['subCourseID', 'courseID', 'subCourseTitle', 'examIds','description'];
}