<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Vaccination;
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
	public function index() {
		//$request->user()->authorizeRoles('admin');

		$children = $this->getChildren();
		if ( $children->isEmpty() ) {
			return view( 'home.noChild' );
		}
		$selectedChildId = $children[0]->id;

		return $this->vaccination( $selectedChildId );
	}

	public function vaccination( $childId ) {
		$children = $this->getChildren();
		if ( count( $children ) == 0 ) {
			echo "<h1>asd</h1>";
		}
		$vaccinations  = Vaccination::where( 'recommended', true )->orderBy( 'recommended_min_age' )->get();
		$selectedChild = null;
		foreach ( $children as $child ) {
			if ( $child->id == $childId ) {
				$selectedChild = $child;
			}
		}
		$section = 'vaccination';

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
