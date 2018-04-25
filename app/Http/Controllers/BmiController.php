<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBmi;
use App\Models\Bmi;
use Illuminate\Http\Request;

class BmiController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function store( StoreBmi $request ) {
		$bmi         = new Bmi();
		$bmi->weight = $request->weight;
		$bmi->height = $request->height;
		$bmi->updateBmi();
		$bmi->child_id = $request->child;

		$bmi->save();

		return redirect()->back();

	}

	public function update( Request $request, $id ) {
		return redirect()->back();
	}

	public function destroy( $id ) {

		return redirect()->back();
	}
}
