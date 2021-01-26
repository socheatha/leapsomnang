<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Medicine;
use Auth;


class MedicineRepository
{


	public function getData()
	{
		return Medicine::all();
	}


	public function getSelectDistrict($request)
	{

		$option = '<option value="">'. __('label.form.choose') .'</option>';
		$medicine = Medicine::find($request->id);
		
		foreach ($medicine->districts as $key => $district) {
			$option .= '<option value="'. $district->id .'">'. $district->name .'::'. $district->name_en .'</option>';
		}

		return $option;
	}
	
	public function create($request)
	{

		$medicine = Medicine::create([
			'name' => $request->name,
			'code' => $request->code,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		return $medicine;
	}


	public function update($request, $medicine)
	{

		return $medicine->update([
			'name' => $request->name,
			'code' => $request->code,
			'updated_by' => Auth::user()->id,
		]);

	}

	public function destroy($medicine)
	{

		$name = $medicine->name;
		if($medicine->delete()){
			return $name ;
		}

	}

}