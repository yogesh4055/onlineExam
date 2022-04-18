<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideosCastsModel extends Model
{
	protected $table = 'video_cast';
	protected $fillable = ['video_id ', 'name','designation', 'image', 'created_at', 'updated_at'];
  
}
