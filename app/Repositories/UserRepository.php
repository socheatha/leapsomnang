<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use Hash;
use Auth;
use Image;


class UserRepository
{


	public function getData()
	{

		$users = User::orderBy('first_name','asc')->get();
		return $users;

	}

	public function create($request)
	{
		$user = User::create([
													'first_name' => $request->first_name,
													'last_name' => $request->last_name,
													'gender' => $request->gender,
													'status' => (($request->status==null)? 0 : 1),
													'phone' => $request->phone,
													'language' => $request->language,
													'position' => $request->position,
													'email' => $request->email,
													'password' => Hash::make($request->password),
												]);
		$user->assignRole('User');
		return $user;
	}

	public function update($request, $user)
	{
		return $user->update([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'gender' => $request->gender,
			'status' => (($request->status==null)? 0 : 1),
			'phone' => $request->phone,
			'language' => $request->language,
			'position' => $request->position,
		]);

	}


	public function updateImage($request, $user, $path)
	{
		if ($request->file('image')) {
			$image = $request->file('image');
			$user_image = (($user->image!='default_user.png')? $user->image : time() .'_'. $user->id .'.png');
			$img = Image::make($image->getRealPath())->save($path.$user_image);
			// crop image
			// $img->crop(100, 100, 25, 25);
			return $user->update(['image'=>$user_image]);
		}
	}


	public function destroy($request, $user)
	{
    if (Hash::check($request->passwordDelete, Auth::user()->password)){
			if($user->delete()){
				return $user->first_name .' '. $user->last_name ;
			}
    }else{
        return false;
    }
	}

	public function updatePassword($request, $user)
	{
		return $user->update(['password' => Hash::make($request->password)]);
	}

	public function checkPassword($request)
	{
    if (Hash::check($request->password_confirm, Auth::user()->password)){
        return true;
    }else{
        return false;
    }

	}

}