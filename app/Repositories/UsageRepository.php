<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Usage;
use Auth;


class UsageRepository
{


	public function getData()
	{
		return Usage::all();
	}

	public function create($request)
	{

		$usage = Usage::create([
			'name' => $request->name,
			'description' => $request->description,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		return $usage;
	}


	public function update($request, $usage)
	{

		return $usage->update([
			'name' => $request->name,
			'description' => $request->description,
			'updated_by' => Auth::user()->id,
		]);

	}

	public function destroy($usage)
	{

		$name = $usage->name;
		if($usage->delete()){
			return $name ;
		}

	}

}