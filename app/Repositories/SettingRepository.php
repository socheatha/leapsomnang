<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Setting;
use Image;


class SettingRepository
{

	public function update($request)
	{
		// dd($request->all());
		$setting = Setting::find(1)->update([
			'clinic_name_kh'=> $request->clinic_name_kh,
			'clinic_name_en'=> $request->clinic_name_en,
			'sign_name_kh'=> $request->sign_name_kh,
			'sign_name_en'=> $request->sign_name_en,
			'phone'=> $request->phone,
			'address'=> $request->address,
			'description'=> $request->description,
			'echo_description'=> $request->echo_description,
			'navbar_color'=> $request->navbar_color,
			'sidebar_color'=> (($request->sidebar_color==null)? 0 : 1)
			]);

		if ($request->file('logo')) {
			$path = public_path().'/images/setting/';
			$logo = $request->file('logo');
			$img = Image::make($logo->getRealPath())->save($path.'logo.png');
		}

		return $setting;

	}

}