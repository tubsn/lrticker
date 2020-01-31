<?php

namespace App\Http\Controllers\FlundrCMS;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

	function __construct() {
		$this->middleware('auth');
	}

    public function index() {
		return view('Adminarea.index')->with(
			['users' => User::all()]
		);
    }

    public function create() {
        return view('FlundrCMS/user/create');
    }

    public function store(Request $request) {

		$request->validate([
			'username' => ['required', 'unique:users', 'min:3'],
			'password' => ['required', 'min:3'],
			'email' => ['nullable','email']
		]);

		$request->merge([
			'password' => Hash::make($request->password)
		]);

		User::create($request->all());
		return redirect('/admin');
    }

    public function show(User $user) {
		return $user;
    }

    public function edit(User $user) {
		return view('FlundrCMS/user/edit')->with(['user' => $user]);
    }

    public function update(Request $request, User $user) {
		$request->validate([
			'username' => 'required',
			'email' => ['nullable','email']
		]);

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

		return redirect('/admin');
    }

    public function destroy(User $user) {

		$id = $user->id;
		$user->delete();
		//return redirect('/admin');

		return [
			'message' => 'User ' . $id  . 'deleted',
			'success' => true
		];


    }
}
