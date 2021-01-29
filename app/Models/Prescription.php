<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrescriptionDetail;

class Prescription extends Model
{
	protected $fillable = [
		'date',
		'code',
		'pt_no',
		'pt_age',
		'pt_name',
		'pt_gender',
		'pt_phone',
		'remark',
		'patient_id',
		'created_by',
		'updated_by',
	];

	protected $table = 'prescriptions';
	
	public function prescription_details(){
		return $this->hasMany(PrescriptionDetail::class,'prescription_id')->orderBy('index',
		'asc');
	}

	public function prescription_detail_sub_total(){
		$prescriptions = $this->hasMany(PrescriptionDetail::class,'prescription_id')->get();
		$total = 0;
		foreach ($prescriptions as $key => $prescription) {
			$total += ($prescription->amount * $prescription->qty);
		}

		return $total;
	}

	public function prescription_discount_total(){
		$prescriptions = $this->hasMany(PrescriptionDetail::class,'prescription_id')->get();
		$total = 0;
		foreach ($prescriptions as $key => $prescription) {
			$total += ($prescription->amount * $prescription->qty) * $prescription->discount;
		}

		return $total;
	}

	public function prescription_detail_grand_total(){
		$prescriptions = $this->hasMany(PrescriptionDetail::class,'prescription_id')->get();
		$total = 0;
		foreach ($prescriptions as $key => $prescription) {
			$total += ($prescription->amount * $prescription->qty) - ($prescription->amount * $prescription->discount);
		}

		return $total;
	}

}
