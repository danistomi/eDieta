<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	private $defaultSection = 'vacation';

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
		$children        = $this->getChildren();
		$selectedChildId = $children[0]->id;
		$section         = $this->defaultSection;

		return view( 'home.home', compact( [
			'children',
			'selectedChildId',
			'section'
		] ) );
	}

	public function vacation( $childId ) {
		$children        = $this->getChildren();
		$selectedChildId = $childId;
		$section         = 'vacation';

		return view( 'home.vacation', compact( [
			'children',
			'selectedChildId',
			'section'
		] ) );
	}

	public function bmi( $childId ) {

	}

	/**
	 * @return Child[]
	 */
	private function getChildren() {
		return Child::where( 'parent_id', Auth::user()->id )->get();
	}
}
