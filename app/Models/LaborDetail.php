<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Labor;
use App\Models\Service;

class LaborDetail extends Model
{
	protected $fillable = [
		'name', 'amount', 'description', 'index', 'labor_id', 'service_id', 'created_by', 'updated_by',
	];

	protected $table = 'labor_details';
	
	public function service(){
		return $this->belongsTo(Service::class,'service_id');
	}
	
	public function labor(){
		return $this->belongsTo(Labor::class,'labor_id');
	}
}
