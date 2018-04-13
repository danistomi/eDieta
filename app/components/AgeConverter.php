<?php

namespace App\components;

class AgeConverter {
	/**
	 * @param $years int
	 *
	 * @return float|int
	 */
	public static function YearsToMoths( $years ) {
		return $years * 12;
	}

	/**
	 * @param $months int
	 *
	 * @return int
	 */
	public static function MonthsToYears( $months ) {
		return (int) ( $months / 12 );
	}

	/**
	 * @param $months
	 *
	 * @return array[int|float, string]
	 */
	public static function MonthsToFriendlyAge( $months ) {
		if ( $months < 12 ) {
			return [ $months, 'months' ];
		}
		if ( $months == 18 || $months == 30 || $months == 42 ) {
			return [ $months / 12, 'years' ];
		}

		return [ AgeConverter::MonthsToYears( $months ), 'years' ];
	}
}