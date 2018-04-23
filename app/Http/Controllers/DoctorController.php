<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurgery;
use App\Models\Surgery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function newDoctor() {
		return view( 'ambulance.newAmbulanceForm' );
	}

	public function createAmbulance( StoreSurgery $request ) {
		if ( Surgery::where( 'doctor_id', Auth::user()->id )->exists() ) {
			return redirect()->back()->with( 'error', 'Zou already added request' );
		}
		$surgery = new Surgery();

		$surgery->doctor_id = Auth::user()->id;
		$surgery->name      = $request->name;
		$surgery->address   = $request->address;
		$surgery->city      = $request->city;
		$surgery->zip       = $request->zip;

		$surgery->save();

		return redirect()->back()->with( 'message', 'OK' );
	}
}
