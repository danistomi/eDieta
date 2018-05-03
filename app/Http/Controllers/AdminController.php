<?php

namespace App\Http\Controllers;

use App\Mail\VaccinationNotification;
use App\Models\User;
use App\Models\Vaccination;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
		if ( ! View::exists( 'admin.' . $page ) ) {
			abort( 404, 'Page not found' );
		}

		$functionName = 'show' . ucfirst( $page );

		return $this->$functionName();
	}

	public function storeBmiFile( Request $request ) {
		//Storage::disk( 'local' )->put( 'file.txt', 'Contents' );
		$file = $request->file( 'bmiData' );
		$file->storeAs(
			'bmiData', $file->getClientOriginalName()
		);

		return redirect()->back();
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

		return view( 'admin.doctors', compact( [ 'nav', 'doctors' ] ) );
	}

	private function showBmis() {
		$nav   = $this->getAdminNavForPage( 'bmis' );
		$files = Storage::files( 'bmiData' );

		return view( 'admin.bmis', compact( [ 'nav', 'files' ] ) );

	}

	private function getAdminNavForPage( $page ) {
		$this->adminNav[ $page ]['active'] = true;

		return $this->adminNav;
	}
}
