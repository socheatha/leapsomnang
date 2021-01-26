<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineRequest;
use App\Repositories\MedicineRepository;
use Auth;

class MedicineController extends Controller
{

	protected $medicines;

	public function __construct(MedicineRepository $repository)
	{
		$this->medicines = $repository;
	}

	public function index()
	{
		$this->data = [
				'medicines' => $this->medicines->getData(),
		];

		return view('medicine.index', $this->data);
	}

	public function getSelectDistrict(Request $request)
	{
		return $this->medicines->getSelectDistrict($request);
	}


	public function create()
	{
		return view('medicine.create');
	}

	public function store(MedicineRequest $request)
	{
		if ($this->medicines->create($request)){

			// Redirect
			return redirect()->route('medicine.create')
				->with('success', __('alert.crud.success.create', ['name' => Auth::user()->module()]) . $request->name);
		}
	}

	public function edit(Medicine $medicine)
	{
		$this->data = [
				'medicine' => $medicine,
		];
		
		return view('medicine.edit', $this->data);
	}



	public function update(MedicineRequest $request, Medicine $medicine)
	{

		if ($this->medicines->update($request, $medicine)){

			// Redirect
			return redirect()->route('medicine.index')
				->with('success', __('alert.crud.success.update', ['name' => Auth::user()->module()]) . $request->name);
		}
	}



	public function destroy(Medicine $medicine)
	{
		// Redirect
		return redirect()->route('medicine.index')
			->with('success', __('alert.crud.success.delete', ['name' => Auth::user()->module()]) . $this->medicines->destroy($medicine));
	}
}
