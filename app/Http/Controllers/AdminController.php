<?php

namespace App\Http\Controllers;

use App\Models\DefaultVaccinations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

	private $nav = array(
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
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $page ) {
		if ( ! \Illuminate\Support\Facades\View::exists( 'admin.' . $page ) ) {
			abort( 404, 'Page not found' );
		}

		$functionName = 'show' . ucfirst( $page );

		return $this->$functionName();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}

	private function showIndex() {
		$nav = $this->getNavForPage( 'index' );

		return view( 'admin.index', compact( 'nav' ) );
	}

	private function showVaccinations() {
		$nav          = $this->getNavForPage( 'vaccinations' );
		$vaccinations = DefaultVaccinations::orderBy( 'recommended_min_month', 'asc' )->get();

		return view( 'admin.vaccinations', compact( [ 'nav', 'vaccinations' ] ) );
	}

	private function getNavForPage( $page ) {
		$this->nav[ $page ]['active'] = true;

		return $this->nav;
	}
}
