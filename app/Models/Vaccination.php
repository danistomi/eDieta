<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model {

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
