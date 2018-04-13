<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function store( Request $request ) {
		Auth::user()->authorizeRoles( 'admin' );

		$vaccination                      = new Vaccination();
		$vaccination->name                = $request->v_name;
		$vaccination->recommended_min_age = (int) $request->min_age;
		$vaccination->setRecommendedMinAgeRange( $request->min_age_range );
		$vaccination->recommended_max_age = (int) $request->max_age;
		$vaccination->setRecommendedMaxAgeRange( $request->max_age_range );
		$vaccination->type         = $request->type;
		$vaccination->immunization = $request->immunization;
		$vaccination->recommended  = $request->has( 'recommended' );
		$vaccination->recurrent    = $request->has( 'recurrent' );

		$vaccination->save();

		return redirect()->back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		$vaccination = Vaccination::findOrFail( $id );
		$vaccination->delete();

		return redirect()->back();
	}
}
