<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminReviewsModel extends Model
{
	protected $table = 'admin_reviews';
	protected $fillable = ['user_id', 'category_id','industry_id', 'title', 'youtube_url', 'release_date', 'director', 'producers','music_director','starring', 'story', 'image', 'views', 'status'];

   
    public function get_category_name()
    {
        return $this->hasOne(CategoriesModel::class, 'id', 'category_id')->select('id', 'name');
    }
    public function get_industry_name()
    {
        return $this->hasOne(IndustriesModel::class, 'id', 'industry_id')->select('id', 'name');
    }
}
