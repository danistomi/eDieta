<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * @property float weight
 * @property float height
 * @property mixed bmi
 * @property integer child_id
 * @property datetime created_at
 */
class Bmi extends Model {

	protected $fillable = [
		'height',
		'weight',
		'bmi'
	];

	/**
	 * Get the children that owns the bmi measurement.
	 */
	public function child() {
		return $this->belongsTo( Child::class );
	}

	public function updateBmi() {
		$this->bmi = $this->getCalculatedBmi();

	}

//	public function getBmiAttribute( $bmi ) {
//		if ( $bmi == null || $bmi == 0 ) {
//			$this->updateBmi();
//		}
//
//		return $this->getCalculatedBmi();
//	}

	public function getChildAgeAttribute() {
		$birthday = new DateTime( $this->child->date_of_birth );
		$diff     = $birthday->diff( new DateTime( $this->created_at ) );

		return (int) ( $diff->format( '%m' ) ) + 12 * $diff->format( '%y' );
	}

	private function getCalculatedBmi() {
		if ( $this->height == null ) {
			throw new InvalidArgumentException( 'Argiment height is missing' );
		}
		if ( $this->weight == null ) {
			throw new InvalidArgumentException( 'Argiment weight is missing' );
		}

		return $this->weight / ( $this->height / 100 ) / ( $this->height / 100 );
	}
}
