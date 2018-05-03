<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;

class AjaxController extends Controller {
	public function getVaccinationForm( Request $request ) {
		$success     = true;
		$vaccination = Vaccination::findOrFail( $request->vaccId );
		try {
			$returnHTML = view( 'admin.new_vaccination_form' )->with( 'ajaxVaccination', $vaccination )->render();
		} catch ( \Throwable $e ) {
			$success = false;
		}

		return response()->json( array( 'success' => true, 'html' => $returnHTML ) );
	}
}
