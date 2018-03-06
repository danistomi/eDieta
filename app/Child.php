<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * @property mixed first_name
 * @property mixed last_name
 */
class Child extends Model {

	/**
	 * Get the vacations for the child.
	 */
	public function vacations() {
		return $this->hasMany( Vacation::class );
	}

	/**
	 * @return string Returns with the full name
	 */
	public function getFullNameAttribute() {
		return "{$this->first_name} {$this->last_name}";
	}

	public function getAgeAttribute() {
		$dt = Carbon::parse( $this->date_of_birth );

		return Carbon::createFromDate( $dt->year, $dt->month, $dt->day )->age;
	}
}
