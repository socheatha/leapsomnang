<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\LaborService;
use Auth;


class LaborServiceRepository
{


	public function getData()
	{
		return LaborService::orderBy('name', 'asc')->get();
	}

	public function reloadSelectLaborService()
	{
		$labor_services = LaborService::orderBy('name', 'asc')->get();
		$options = '<option value="">'. __('label.form.choose') .'</option>';
		foreach ($labor_services as $key => $labor_service) {
			$options .= '<option value="'. $labor_service->id .'">'. $labor_service->name .'</option>';
		}
		return $options;

	}
	

	public function getDetail($request)
	{
		$labor_service = LaborService::find($request->id);
		return response()->json([
			'labor_service' => $labor_service ,
		]);
	}

	public function create($request)
	{

		$labor_service = LaborService::create([
			'name' => $request->name,
			'unit' => $request->unit,
			'reference' => $request->reference,
			'description' => $request->description,
			'category_id' => $request->category_id,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		return $labor_service;
	}


	public function update($request, $labor_service)
	{

		return $labor_service->update([
			'name' => $request->name,
			'unit' => $request->unit,
			'reference' => $request->reference,
			'description' => $request->description,
			'category_id' => $request->category_id,
			'updated_by' => Auth::user()->id,
		]);

	}

	public function destroy($labor_service)
	{

		$name = $labor_service->name;
		if($labor_service->delete()){
			return $name ;
		}

	}

}