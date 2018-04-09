<?php

namespace App\Models;

use App\components\AgeConverter;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string first_name
 * @property string last_name
 * @property  int parent_id
 * @property string date_of_birth
 * @property string gender
 */
class Child extends Model {

	/**
	 * Get the vacations for the child.
	 */
	public function vacations() {
		return $this->hasMany( Vaccination::class );
	}

	/**
	 * @return string Returns with the full name
	 */
	public function getFullNameAttribute() {
		return "{$this->first_name} {$this->last_name}";
	}

	public function getAgeAttribute() {
		$birthday = new DateTime( $this->date_of_birth );
		$diff     = $birthday->diff( new DateTime() );
		$months   = $diff->format( '%m' ) + 12 * $diff->format( '%y' );

		return AgeConverter::MonthsToFriendlyAge( $months );
//		$dt = Carbon::parse( $this->date_of_birth );
//
//		return Carbon::createFromDate( $dt->year, $dt->month, $dt->day )->age;

		//return AgeConverter::
	}
}
