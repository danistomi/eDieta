<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Exception\ErrorException;

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
		/** @var Child $child */
		$child   = Child::findOrFail( $request->child_id );
		$vaccId  = $request->vaccination_id;
		$hasVacc = $child->vaccinations()->where( 'vaccination_id', $vaccId )->exists();

		if ( $hasVacc ) {
			foreach ( $child->vaccinations as $vaccination ) {
				if ( $vaccination->id == $vaccId ) {
					$done = $vaccination->pivot->done;
					$child->vaccinations()->updateExistingPivot( $vaccId, [ 'done' => ! $done ] );
					break;
				}
			}
		} else {
			$child->vaccinations()->attach( $vaccId, [ 'done' => true, 'date' => Carbon::now() ] );
		}

		return redirect()->back();
	}
}
