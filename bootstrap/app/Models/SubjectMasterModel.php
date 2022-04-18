<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectMasterModel extends Model
{
	protected $table = 'subjectmaster';
	protected $fillable = ['subjectID', 'standardID', 'subjectCode', 'subjectName','seoUri','description','status'];

	/* public function get_category_name()
    {
        return $this->hasOne(CategoriesModel::class, 'id', 'category_id')->select('id', 'name');
    }
    public function get_industry_name()
    {
        return $this->hasOne(IndustriesModel::class, 'id', 'industry_id')->select('id', 'name');
    }*/

   
}
