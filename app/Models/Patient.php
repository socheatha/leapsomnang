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
    'description',
    'full_address',
    'address_village',
    'address_commune',
    'address_district_id',
    'address_province_id',
    'created_by',
    'updated_by',
	];

  public function province()
  {
  	return $this->belongsTo(Province::class, 'address_province_id');
  }

  public function district()
  {
  	return $this->belongsTo(District::class, 'address_district_id');
  }
  
}
