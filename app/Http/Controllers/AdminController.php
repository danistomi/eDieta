<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBmiFile;
use App\Mail\VaccinationNotification;
use App\Models\Surgery;
use App\Models\User;
use App\Models\Vaccination;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AdminController extends Controller {

	private $adminNav = array(
		'index'        => array( 'name' => 'main', 'active' => false, 'icon' => 'home' ),
		'vaccinations' => array( 'name' => 'vaccinations', 'active' => false, 'icon' => 'list' ),
		'bmis'         => array( 'name' => 'bmis', 'active' => false, 'icon' => 'heart' ),
		'doctors'      => array( 'name' => 'doctors', 'active' => false, 'icon' => 'users' ),
	);

	public function __construct() {
		$this->middleware( 'auth' );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		Auth::user()->authorizeRoles( 'admin' );

		//Mail::to( User::where( 'id', 1 )->get()->first()->email )->send( new VaccinationNotification() );

		//return User::where( 'id', 1 )->get()->first();


		return $this->show( 'index' );
	}

	/**
	 * Display the specified sub page.
	 *
	 * @param  string $page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $page ) {
		Auth::user()->authorizeRoles( 'admin' );

		if ( ! View::exists( 'admin.' . $page ) ) {
			abort( 404, 'Page not found' );
		}

		$functionName = 'show' . ucfirst( $page );

		return $this->$functionName();
	}

	private function showIndex() {
		$nav = $this->getAdminNavForPage( 'index' );

		return view( 'admin.index', compact( 'nav' ) );
	}

	private function showVaccinations() {
		$nav          = $this->getAdminNavForPage( 'vaccinations' );
		$vaccinations = Vaccination::orderBy( 'recommended_min_age', 'asc' )->get();

		return view( 'admin.vaccinations', compact( [ 'nav', 'vaccinations' ] ) );
	}

	private function showDoctors() {
		$nav = $this->getAdminNavForPage( 'doctors' );

		$doctors = User::whereHas( 'roles', function ( $q ) {
			$q->where( 'name', 'doctor' );
		} )->get();

		$unverifiedSurgeries = Surgery::where( 'verified', false )->get();
		$surgeries           = Surgery::where( 'verified', true )->get();

		return view( 'admin.doctors', compact( [ 'nav', 'doctors', 'unverifiedSurgeries', 'surgeries' ] ) );
	}

	private function showBmis() {
		$nav   = $this->getAdminNavForPage( 'bmis' );
		$files = DB::table( 'bmi_files' )->orderBy( 'created_at', 'desc' )->get();
		//Storage::allFiles( 'bmiData' );
//		dd( strpos( 'female', Storage::url( $files[1] ) ) !== false );

		return view( 'admin.bmis', compact( [ 'nav', 'files' ] ) );

	}

	private function getAdminNavForPage( $page ) {
		$this->adminNav[ $page ]['active'] = true;

		return $this->adminNav;
	}
}
