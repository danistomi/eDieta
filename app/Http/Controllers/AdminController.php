<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller {

	private $adminNav = array(
		'index'        => array( 'name' => 'Main', 'active' => false, 'icon' => 'home' ),
		'vaccinations' => array( 'name' => 'Vaccinations', 'active' => false, 'icon' => 'list' ),
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

	private function showIndex() {
		$nav = $this->getAdminNavForPage( 'index' );

		return view( 'admin.index', compact( 'nav' ) );
	}

	private function showVaccinations() {
		$nav          = $this->getAdminNavForPage( 'vaccinations' );
		$vaccinations = Vaccination::orderBy( 'recommended_min_age', 'asc' )->get();

		return view( 'admin.vaccinations', compact( [ 'nav', 'vaccinations' ] ) );
	}

	private function getAdminNavForPage( $page ) {
		$this->adminNav[ $page ]['active'] = true;

		return $this->adminNav;
	}
}
