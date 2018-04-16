<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bmi extends Model {

	protected $fillable = [
		'height',
		'weight'
	];

	/**
	 * Get the children that owns the bmi measurement.
	 */
	public function children() {
		return $this->belongsTo( Child::class );
	}
}
