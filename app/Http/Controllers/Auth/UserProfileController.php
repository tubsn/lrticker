<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ticker;
use App\Models\Post;

class UserProfileController extends Controller
{

	function __construct() {

		$this->middleware('auth');

	}

	public function index() {

		$user = auth()->user();
		$user->tickercount = Ticker::where('author_id', $user->id)->count();
		$user->postcount = Post::where('author_id', $user->id)->count();

		return view('user.profile')->with('user', $user);
	}

	public function edit() {
		return view('user.edit')->with(
			['user' => auth()->user()]
		);
	}

    public function update(Request $request) {

		$currentUserID = auth()->user()->id;
		$user = User::find($currentUserID);
		$rules = [];

		if ($user->username != $request->username) {
			$rules['username'] = 'required|unique:users';
		}

		if ($user->email != $request->email) {
			$rules['email'] = 'required|unique:users';
		}

		$request->validate($rules);

		if ($request->filled('password')) {
			$request->validate(['password' => 'min:5']);
			$request->merge([
				'password' => Hash::make($request->password)
			]);
			$user->update($request->all());
		}
		else {
			$user->update($request->except('password'));
		}

		return redirect('/profil');

    }


	public function add_thumbnail(Request $request) {

		$currentUserID = auth()->user()->id;
		$user = User::find($currentUserID);

		$user->thumbnail = $request->thumbnail;
		$user->save();

		//echo $request->thumbnail;
		//dd($request);

	}



}