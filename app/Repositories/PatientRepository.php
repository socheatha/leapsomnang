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
		// find Precription + Invoice of this patient, then sort by date and return
		$P_history =
			\DB::table('prescriptions')->select(['id', 'date', 'pt_no', 'pt_name', 'pt_age', 'pt_phone', 'remark', 'created_at', 'created_at as type'])->where('patient_id', $request->id)->orderBy('id', 'DESC')
			->unionAll(\DB::table('invoices')->select(['id', 'date', 'pt_no', 'pt_name', 'pt_age', 'pt_phone', 'remark', 'created_at', 'created_at as type'])->where('patient_id', $request->id)->orderBy('id', 'DESC'))
			->get()->toarray();
		array_multisort(array_column($P_history, 'date'), SORT_DESC, $P_history);

		$patient = Patient::find($request->id);
		$patient->no = 'PT-'. str_pad($patient->id, 6, "0", STR_PAD_LEFT);
		$patient->pt_gender = (($patient->gender==1)? 'ប្រុស' : 'ស្រី');
		return response()->json([
			'patient' => $patient,
			'P_history' => json_encode($P_history)
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