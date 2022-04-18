<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model
{
	protected $table    = 'categories';
	protected $fillable = ['name', 'slug', 'parent_id', 'parent_slug'];
}
