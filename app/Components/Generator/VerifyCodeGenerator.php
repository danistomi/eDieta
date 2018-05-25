<?php

namespace App\Components\Generator;


class VerifyCodeGenerator {
	private function __construct() {
	}

	public static function generateCode( $length = 5 ) {
		$str        = "";
		$characters = array_merge( range( 'A', 'Z' ), range( 'a', 'z' ), range( '0', '9' ) );
		$max        = count( $characters ) - 1;
		for ( $i = 0; $i < $length; $i ++ ) {
			$rand = mt_rand( 0, $max );
			$str  .= $characters[ $rand ];
		}

		return $str;
	}
}