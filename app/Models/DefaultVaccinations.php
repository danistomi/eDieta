<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property integer recommended_min_age
 * @property integer recommended_max_age
 * @property string type
 * @property string immunization
 * @property boolean recommended
 * @property boolean recurrent
 */
class DefaultVaccinations extends Model {
	protected $fillable = [
		'name',
		'recommended_min_age',
		'recommended_max_age',
		'type',
		'immunization',
		'recommended',
		'recurrent',
	];

	public function getAgeAttribute() {
		if ( $this->recommended_max_age < $this->recommended_min_age ) {
			return $this->recommended_min_age;
		}

		return $this->recommended_min_age . ' - ' . $this->recommended_max_age;
	}

	public function setRecommendedMinAgeRange( $attr ) {
		if ( $attr === 'ages' ) {
			$this->attributes['recommended_min_age'] *= 12;
		}
	}

	public function setRecommendedMaxAgeRange( $attr ) {
		if ( $attr === 'ages' ) {
			$this->attributes['recommended_max_age'] *= 12;
		}
	}
}
