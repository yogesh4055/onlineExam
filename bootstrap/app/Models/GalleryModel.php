<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
	protected $table = 'gallery';
	protected $fillable = ['user_id', 'category_id','industry_id', 'title', 'meta_keywords', 'description', 'status'];
   
    public function get_category_name()
    {
        return $this->hasOne(CategoriesModel::class, 'id', 'category_id')->select('id', 'name');
    }
    public function get_industry_name()
    {
        return $this->hasOne(IndustriesModel::class, 'id', 'industry_id')->select('id', 'name');
    }
}
