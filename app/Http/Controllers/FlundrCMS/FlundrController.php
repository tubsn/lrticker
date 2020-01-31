<?php

namespace App\Http\Controllers\FlundrCMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class FlundrController extends Controller
{

	function __construct() {
		$this->middleware('auth');
	}

    public function index() {
		return view('FlundrCMS.user.index')->with(
			['users' => User::all()]
		);
	}



}
