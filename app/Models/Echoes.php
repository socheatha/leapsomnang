<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Echoes extends Model
{
	protected $table = 'echoes';
	
	protected $fillable = [
		'date',
		'pt_no',
		'pt_age',
		'pt_name',
		'pt_gender',
		'pt_phone',
		'image',
		'description',
		'echo_default_description_id',
		'created_by',
		'updated_by',
	];

  public function echo_default_description()
  {
  	return $this->belongsTo(EchoDefaultDescription::class, 'echo_default_description_id');
	}

}
