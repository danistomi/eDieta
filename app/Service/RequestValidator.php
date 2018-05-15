<?php

namespace App\Service;


use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class RequestValidator extends Validator {
	public function validateUniqueWith( $attribute, $value, $parameters ) {
		$whereData = [
			[ 'address', $value ],
			[ 'city', $parameters[1] ],
			[ 'zip', $parameters[2] ]
		];
		$count     = DB::table( $parameters[0] )->where( $whereData )->count();

		return $count === 0;
//		$result = DB::table( $parameters[0] )->where( function ( $query ) use ( $attribute, $value, $parameters ) {
//			$query->where( $attribute, '=', $value )
//			      ->orWhere( $parameters[1], '=', $value );
//		} )->first();
//
//		return $result ? false : true;
	}
}