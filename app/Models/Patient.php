<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;


class Patient extends BaseModel
{
	protected $table = 'patients';

	protected $fillable = [
    'name',
    'id_card',
    'email',
    'phone',
    'gender',
    'age',
    'age_type',
    'description',
    'full_address',
    'address_village',
    'address_commune',
    'address_district_id',
    'address_province_id',
    'address_code',
    'created_by',
    'updated_by',
	];

  public function isInUse()
  {
	$total = count($this->prescriptions) + count($this->labors) + count($this->invoices) + count($this->echoes);
  	return (($total>0)? true : false);
  }

  public function prescriptions()
  {
  	return $this->hasMany(Prescription::class, 'patient_id');
  }
  public function labors()
  {
  	return $this->hasMany(Labor::class, 'patient_id');
  }
  public function invoices()
  {
  	return $this->hasMany(Invoice::class, 'patient_id');
  }
  public function echoes()
  {
  	return $this->hasMany(Echoes::class, 'patient_id');
  }



  public function province()
  {
  	return $this->belongsTo(Province::class, 'address_province_id');
  }

  public function district()
  {
  	return $this->belongsTo(District::class, 'address_district_id');
  }
  
  public function full_address()
  {
  	return $this->belongsTo(FourLevelAddress::class, 'address_code', '_code');
  }
}
