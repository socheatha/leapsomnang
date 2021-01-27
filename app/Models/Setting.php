<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Setting extends BaseModel
{


	protected $table = 'setting';

	protected $fillable = [
		'logo',
		'clinic_name_kh',
		'clinic_name_en',
		'phone',
		'address',
		'navbar_color',
		'sidebar_color'
	];




}
