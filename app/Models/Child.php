<?php

namespace App\Models;

use App\components\AgeConverter;
use DateTime;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string first_name
 * @property string last_name
 * @property int parent_id
 * @property string date_of_birth
 * @property string gender
 * @property Vaccination vaccinations
 */
class Child extends Model {

	protected $fillable = [
		'parent_id',
		'first_name',
		'last_name',
		'date_of_birth',
		'gender'
	];

	/**
	 * Get the vacations for the child.
	 */
	public function vaccinations() {
		return $this->belongsToMany( Vaccination::class )
		            ->withPivot( 'done', 'date' )
		            ->withTimestamps();
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
