<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Setting extends BaseModel
{


	protected $table = 'setting';

	protected $fillable = [
		'clinic_name', 'logo', 'theme',
	];




}
