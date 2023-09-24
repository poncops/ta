<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
	use ImageUploadTrait;

    public function index()
	{
		// $provinces = [1,2,3,4,5];
		// $cities = [1,2,3,4,5];
		$user = auth()->user();
		$provinces = $this->getProvinces();
		$cities = [];
		if ($user->province_id) {
			$cities = $this->getCities($user->province_id);
		}

		return view('frontend.users.profile', compact('provinces', 'cities','user'));
	}
	
	public function update(Request $request){		
        $user = auth()->user();
		$user2 = User::where('id', $user->id)->firstOrFail();

		$image = $user2->foto;
		if ($request->hasFile('foto')) {
            if ($user2->foto != null && File::exists('storage/images/users/'. $user2->foto)) {
                unlink('storage/images/users/'. $user2->foto);
            }

            $image = $this->uploadImg("user", $request->foto, 'users');
        }

        // $user->update($request->validated());
		$user2->username = $request->username;
		$user2->first_name = $request->first_name;
		$user2->last_name = $request->last_name;
		$user2->email = $request->email;
		$user2->phone = $request->phone;
		$user2->address1 = $request->address1;
		$user2->address2 = $request->address2;
		$user2->province_id = $request->province_id;
		$user2->city_id = $request->city_id;
		$user2->postcode = $request->postcode;
		$user2->foto = $image;
		$user2->save();

		return redirect()->route('profile.index')->with(['message' => 'success updated']);
	}
}
