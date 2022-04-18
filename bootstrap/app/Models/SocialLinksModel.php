<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinksModel extends Model
{
	protected $table = 'social_links';
	protected $fillable = ['title','input_name','placeholder','created_at', 'updated_at'];



   
}
