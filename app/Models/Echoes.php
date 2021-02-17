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
		'pt_village',
		'pt_commune',
		'pt_district_id',
		'pt_province_id',
		'pt_diagnosis',
		'image',
		'description',
		'patient_id',
		'echo_default_description_id',
		'created_by',
		'updated_by',
	];

  public function echo_default_description()
  {
  	return $this->belongsTo(EchoDefaultDescription::class, 'echo_default_description_id');
	}

  public function patient()
  {
  	return $this->belongsTo(Patient::class, 'patient_id');
	}

  public function province()
  {
  	return $this->belongsTo(Province::class, 'pt_province_id');
  }

  public function district()
  {
  	return $this->belongsTo(District::class, 'pt_district_id');
  }
	
}
