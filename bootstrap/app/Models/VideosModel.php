<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideosModel extends Model
{
	protected $table = 'videos';
	protected $fillable = ['user_id ', 'category_id','industry_id', 'title', 'youtube_ur', 'description', 'status', 'visibility', 'created_at', 'updated_at'];



   
}
