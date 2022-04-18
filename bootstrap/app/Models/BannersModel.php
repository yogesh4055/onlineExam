<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannersModel extends Model
{
	protected $table    = 'banners';
	protected $fillable = ['category_id', 'img','description', 'title', 'social_link', 'social_name', 'social_icon', 'create_by', 'status','image'];

	 public function get_category_name()
    {
        return $this->hasOne(CategoriesModel::class, 'id', 'category_id')->select('id', 'name');
    }

}
