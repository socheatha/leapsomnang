<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Medicine extends BaseModel
{


	protected $table = 'medicines';

	protected $fillable = [
		'name', 'code', 'description', 'created_by', 'updated_by',
	];




}
