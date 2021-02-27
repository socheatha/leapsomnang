<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class LaborCategory extends BaseModel
{


	protected $table = 'labor_categories';

	protected $fillable = [
		'name', 'description', 'created_by', 'updated_by',
	];




}
