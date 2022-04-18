<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustriesModel extends Model
{
	protected $table = 'industries';
	protected $fillable = ['name', 'order','created_at', 'updated_at'];



   
}
