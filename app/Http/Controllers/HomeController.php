<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\DefaultBmi;
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
		$selectedChildId = $children->first()->id;

		return $this->vaccination( $selectedChildId );
	}

	public function vaccination( $childId ) {
		$children = $this->getChildren();
		if ( count( $children ) == 0 ) {
			echo "<h1>asd</h1>";
		}


		$selectedChild = $children->where( 'id', $childId );
		if ( $selectedChild->isEmpty() ) {
			return abort( 404 );
		}
		$selectedChild = $selectedChild->first();
		$section       = 'vaccination';

		$vaccinations = Vaccination::where( 'recommended', true )->orderBy( 'recommended_min_age' )->get();

		return view( 'home.vaccination', compact( [
			'children',
			'selectedChild',
			'section',
			'vaccinations'
		] ) );
	}

	public function bmi( $childId ) {
		$children = $this->getChildren();
		if ( count( $children ) == 0 ) {
			echo "<h1>asd</h1>";
		}

		/** @var Child $selectedChild */
		$selectedChild = $children->where( 'id', $childId );
		if ( $selectedChild->isEmpty() ) {
			return abort( 404 );
		}
		$selectedChild = $selectedChild->first();
		$section       = 'bmi';
		$bmis          = Child::find( $childId )->bmis()->orderBy( 'created_at', 'ASC' )->get();
		$defaultBmis   = DefaultBmi::where( 'age', '<=', $selectedChild->ageInMonths() );
		$bmiChartData  = array();
		foreach ( $bmis as $bmi ) {
			array_push( $bmiChartData, [ 'age' => $bmi->childAge, 'bmi' => $bmi->bmi ] );
		}

		$bmis = Child::find( $childId )->bmis()->orderBy( 'created_at', 'DESC' )->paginate( 10 );

		return view( 'home.bmi', compact( [
			'children',
			'selectedChild',
			'section',
			'bmis',
			'bmiChartData'
		] ) );
	}

	/**
	 * @return Child[]
	 */
	private function getChildren() {
		return Child::where( 'parent_id', Auth::user()->id )->get();
	}
}
