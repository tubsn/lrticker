<?php

namespace App\Http\Controllers\FlundrCMS;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index() {
		return view('Adminarea.index')->with(
			['users' => User::all()]
		);
    }

    public function create() {
        return view('flundrcms/user/create');
    }

    public function store(Request $request) {

		$request->validate([
			'username' => ['required', 'unique:users', 'min:3'],
			'password' => ['required', 'min:3'],
			'email' => ['nullable','email']
		]);

		User::create($request->all());
		return redirect('/admin');
    }

    public function show(User $user) {
		return $user;
    }

    public function edit(User $user) {
		return view('flundrcms/user/edit')->with(['user' => $user]);
    }

    public function update(Request $request, User $user) {

		$request->validate([
			'username' => 'required',
			'email' => ['nullable','email']
		]);

		$user->update($request->all());
		return redirect('/admin');
    }

    public function destroy(User $user) {
        $user->delete();
		return redirect('/admin');
    }
}
