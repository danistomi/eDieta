<?php

namespace App\Models;

use App\Components\AgeConverter;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property int recommended_min_age
 * @property int recommended_max_age
 * @property string type
 * @property string immunization
 * @property bool recommended
 * @property bool recurrent
 * @property int id
 */
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
			return AgeConverter::MonthsToFriendlyAge( $this->recommended_min_age );
		}

		return [
			AgeConverter::MonthsToFriendlyAge( $this->recommended_min_age ),
			AgeConverter::MonthsToFriendlyAge( $this->recommended_max_age )
		];
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

	public function getStatus( Child $child ) {
		$childAge = $child->getAgeAttribute();
		$childAge = $childAge[1] == 'months' ? $childAge[0] : $childAge[0] * 12;

		foreach ( $child->vaccinations as $vaccination ) {
			if ( $vaccination->id == $this->id && $vaccination->pivot->done ) {
				return 'success';
			}
		}

		if ( $this->recommended_max_age != null ) {
			$max = $this->recommended_max_age;
			if ( $childAge > $max ) {
				return 'danger';
			}
		} else {
			if ( $childAge > $this->recommended_min_age ) {
				return 'danger';
			}
		}

		if ( $childAge >= $this->recommended_min_age - 1 ) {
			return 'warning';
		}

		return 'default';
	}

}
