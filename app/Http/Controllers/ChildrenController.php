<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$children = Child::where( 'parent_id', Auth::user()->id )->get();

		return view( 'home', compact( 'children' ) );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$child = new Child();

		$child->parent_id     = Auth::user()->id;
		$child->first_name    = $request->first_name;
		$child->last_name     = $request->last_name;
		$child->date_of_birth = $request->date_of_birth;
		$child->gender        = $request->gender;

		$child->save();

		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		$child     = Child::findOrFail( $id );
		$vacations = $child->vacations;

		return view( 'children.index', compact( 'child' ), compact( 'vacations' ) );
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

	public function childrenVacc( Request $request ) {
		$child = Child::findOrFail( $request->child_id );

		$child->vaccinations()->attach( $request->vaccination_id, [ 'done' => true, 'date' => Carbon::now() ] );

		//return $child;

		return redirect()->back();
	}
}
