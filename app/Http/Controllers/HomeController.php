<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	private $defaultSection = 'vaccination';

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
		if ( $children->isEmpty() ) {
			return view( 'home.noChild' );
		}
		$selectedChildId = $children[0]->id;

//		$section         = $this->defaultSection;

		return $this->vaccination( $selectedChildId );
//
//		return view( 'home.home', compact( [
//			'children',
//			'selectedChildId',
//			'section'
//		] ) );
	}

	public function vaccination( $childId ) {
		$children        = $this->getChildren();
		if ( count( $children ) == 0 ) {
			echo "<h1>asd</h1>";
		}
		$vaccinations  = Vaccination::where( 'child_id', $childId );
		$selectedChild = $children[0];
		$section       = 'vaccination';

		return view( 'home.vaccination', compact( [
			'children',
			'selectedChild',
			'section',
			'vaccinations'
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
