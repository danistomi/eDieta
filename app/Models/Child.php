<?php

namespace App\Models;

use Carbon\Carbon;
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
		$dt = Carbon::parse( $this->date_of_birth );

		return Carbon::createFromDate( $dt->year, $dt->month, $dt->day )->age;
	}
}
