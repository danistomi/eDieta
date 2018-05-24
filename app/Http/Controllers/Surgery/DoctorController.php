<?php

namespace App\Http\Controllers\Surgery;

use App\Components\Generator\VerifyCodeGenerator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class DoctorController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {
		$notVerifiedDoctors = Auth::user()->doctors()->wherePivot( 'verified', false )->get();
		$doctors            = Auth::user()->doctors()->wherePivot( 'verified', true )->get();

		return view( 'doctors.doctors', compact( [ 'notVerifiedDoctors', 'doctors' ] ) );
	}

	public function followDoctor( Request $request ) {
		$doctor = User::findOrFail( $request->doctor_id );

		Auth::user()->doctors()->attach( $doctor, [ 'verify_code' => VerifyCodeGenerator::generateCode() ] );

		return redirect()->back();
	}

	public function verify( Request $request ) {
		$doctor = Auth::user()->doctors()->wherePivot( 'verified', false )->wherePivot( 'verify_code', $request->code )->first();
		if ( $doctor === null ) {
			return redirect()->back()->with( 'error', Lang::get( 'surgery.verify_error.code' ) );
		}

		Auth::user()->doctors()->updateExistingPivot( $doctor->id, [ 'verified' => true ] );

		return redirect()->back();
	}

	public function showPatients() {
		Auth::user()->authorizeRoles( 'doctor' );
		DB::enableQueryLog();
		$patients = Auth::user()->patients()->wherePivot( 'verified', true )->get();

//		dd(DB::getQueryLog());

		return view( 'doctors.patients.verified', compact( 'patients' ) );
	}

	public function showAwaitingVerificationPatients() {
		Auth::user()->authorizeRoles( 'doctor' );
		$patients = Auth::user()->patients()->wherePivot( 'verified', false )->get();

		return view( 'doctors.patients.awaiting_verification', compact( 'patients' ) );
	}
}
