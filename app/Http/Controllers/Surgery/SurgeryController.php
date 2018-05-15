<?php

namespace App\Http\Controllers\Surgery;

use App\DataObject\SurgeryProperties;
use App\Http\Requests\PutSurgery;
use App\Http\Requests\StoreSurgery;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Surgery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SurgeryController extends Controller {

	public function __construct() {
		$this->middleware( 'auth', [ 'except' => 'show' ] );
	}

	public function newSurgery() {

		return view( 'surgery.newSurgeryForm' );
	}

	public function show( $id ) {
		$surgery = Surgery::findOrFail( $id );

		$doctor = $surgery->doctor->workplace;

		return view( 'surgery.surgery', compact( [ 'surgery' ] ) );
	}

	public function store( StoreSurgery $request ) {
		if ( Surgery::where( 'doctor_id', Auth::user()->id )->exists() ) {
			//TODO uzenet szlovakositasa
			return redirect()->back()->with( 'error', 'You already added request' );
		}
		$surgery = new Surgery();

		$surgery->doctor_id = Auth::user()->id;
		$surgery->name      = $request->name;
		$surgery->zone      = $request->zone;
		$surgery->address   = $request->address;
		$surgery->city      = $request->city;
		$surgery->zip       = $request->zip;


		$prop                = new SurgeryProperties();
		$surgery->properties = $prop;

		$surgery->save();

		return redirect()->back()->with( 'message', 'OK' );
	}

	public function edit( $id ) {
		$surgery = Surgery::findOrFail( $id );

		$surgery->save();

		return view( 'surgery.surgeryEditor', compact( 'surgery' ) );
	}

	public function update( PutSurgery $request, $id ) {

		$properties = $this->requestToProperties( $request );

		DB::table( 'surgeries' )->where( 'id', $id )
		  ->update(
			  [
				  'properties' => $properties->getJson(),
				  'zone'       => $request->zone,
			  ]
		  );

		return $this->show( $id );

	}

	public function verify( $id ) {
		Auth::user()->authorizeRoles( [ 'admin' ] );
		$surgery = Surgery::findOrFail( $id );

		$role_doctor = Role::where( 'name', 'doctor' )->first();
		$surgery->doctor->roles()->attach( $role_doctor );

		$surgery->verified = true;
		$surgery->save();

		return redirect()->back();
	}

	public function find( Request $request ) {

	}

	public function destroy( $id ) {
		Auth::user()->authorizeRoles( [ 'admin' ] );
		$surgery = Surgery::findOrFail( $id );

		$role_doctor = Role::where( 'name', 'doctor' )->first();
		$surgery->doctor->roles()->detach( $role_doctor );
		$surgery->delete();

		return redirect()->back();
	}

	private function requestToProperties( Request $request ) {
		$properties = new SurgeryProperties();

		$properties->doctorName = $request->display_name;

		foreach ( $properties->ordinationHours as $day => $hours ) {
			$fromField                                   = $day . '_from';
			$toField                                     = $day . '_to';
			$properties->ordinationHours[ $day ]['from'] = $request->$fromField;
			$properties->ordinationHours[ $day ]['to']   = $request->$toField;
		}


		return $properties;
	}

}
