<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMasterModel extends Model
{
	protected $table = 'coursemaster';
	protected $fillable = ['courseID', 'courseCode', 'courseTitle', 'shortDescription','description','imageName','seoUri','active','price'];
}