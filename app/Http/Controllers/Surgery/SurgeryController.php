<?php

namespace App\Http\Controllers\Surgery;

use App\Http\Requests\StoreSurgery;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Surgery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

		$surgery->save();

		return redirect()->back()->with( 'message', 'OK' );
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
		$surgery = Surgery::findOrFail( $id );
		$surgery->delete();

		return redirect()->back();
	}

}
