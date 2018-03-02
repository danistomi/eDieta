<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'auth' );
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request ) {
		//$request->user()->authorizeRoles('admin');
		//$children = Child::all();
		$children = Child::where( 'parent_id', Auth::user()->id )->get();

		return view( 'home', compact( 'children' ) );
	}
}
