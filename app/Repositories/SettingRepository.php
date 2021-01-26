<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Setting;


class SettingRepository
{

	public function update($request)
	{
		if ($request->file('logo')) {
			$logo = $request->file('logo');
			$user_logo = 'logo.png';
			$path = public_path().'/images/setting/';
			$img = Image::make($logo->getRealPath())->save($path.$user_logo);
			// crop logo
			// $img->crop(100, 100, 25, 25);
			$user->update(['logo'=>$user_image]);
		}

		return Setting::find(1)->update([

    ]);

	}

}