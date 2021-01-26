<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Patient;
use Auth;
use Hash;


class PatientRepository
{


	public function getData()
	{
		return Patient::all();
	}


	public function getDetail($request)
	{

		$patient = Patient::find($request->id);

		$detail = '';

		return response()->json([
			'detail' => $detail ,
		]);
	}


	public function create($request)
	{
		$patient = Patient::create([
			'name' => $request->name,
			'age' => $request->age,
			'gender' => $request->gender,
			'id_card' => $request->id_card,
			'phone' => $request->phone,
			'email' => $request->email,
			'full_address' => $request->full_address,
			'address_district_id' => $request->address_district_id,
			'address_province_id' => $request->address_province_id,
			'address_commune' => $request->address_commune,
			'address_village' => $request->address_village,
			'description' => $request->description,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		return $patient;
	}


	public function update($request, $patient)
	{

		return $patient->update([
			'name' => $request->name,
			'age' => $request->age,
			'gender' => $request->gender,
			'id_card' => $request->id_card,
			'phone' => $request->phone,
			'email' => $request->email,
			'full_address' => $request->full_address,
			'address_district_id' => $request->address_district_id,
			'address_province_id' => $request->address_province_id,
			'address_commune' => $request->address_commune,
			'address_village' => $request->address_village,
			'description' => $request->description,
			'updated_by' => Auth::user()->id,
		]);

	}

	public function destroy($request, $patient)
	{
    if (Hash::check($request->passwordDelete, Auth::user()->password)){
			if($patient->delete()){
				return $patient->name ;
			}
    }else{
        return false;
    }
	}

}