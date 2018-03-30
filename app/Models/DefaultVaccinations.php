<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property integer recommended_min_month
 * @property integer recommended_max_month
 * @property string type
 * @property string immunization
 * @property boolean recommended
 * @property boolean recurrent
 */
class DefaultVaccinations extends Model {
	protected $fillable = [
		'name',
		'recommended_min_month',
		'recommended_max_month',
		'type',
		'immunization',
		'recommended',
		'recurrent',
	];

	public function getAgeAttribute() {
		return $this->recommended_min_month . ' - ' . $this->recommended_max_month;
	}

//	public function setRecommendedAttribute( $attr ) {
//		$this->recommended = ( $attr != '' ) ? true : false;
//	}
//
//	public function setRecurrentAttribute( $attr ) {
//		$this->recurrent = ( $attr != '' ) ? true : false;
//	}
}
