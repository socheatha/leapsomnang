<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repositories\SettingRepository;
use Auth;

class SettingController extends Controller
{

	public function index()
	{
		return view('setting.index');
	}

	public function update(SettingRequest $request)
	{

		if ($this->settings->update($request)){

			// Redirect
			return redirect()->route('setting.index')
				->with('success', __('alert.crud.success.update', ['name' => Auth::user()->module()]) . $request->name);
		}
	}


}
