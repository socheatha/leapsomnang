<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
	
	protected $fillable = [
		'name', 'description',
	];

  public function users()
  {
  	return $this->hasMany('App\Models\User', 'role_id');
  }
  
  public static function getSelectData()
  {

      $collection = parent::where('id','>', 1)->get();

      $items = [];
      foreach ($collection as $model) {
        $items[$model->name] = $model->name;
      }
      return $items;
  }


}
