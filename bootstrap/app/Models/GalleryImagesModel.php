<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImagesModel extends Model
{
	protected $table = 'gallery_images';
	protected $fillable = ['gallery_id', 'image'];
   
}
