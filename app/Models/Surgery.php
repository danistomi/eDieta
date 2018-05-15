<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer doctor_id
 * @property string name
 * @property string address
 * @property string city
 * @property integer zip
 * @property mixed zone
 * @property array properties
 */
class Surgery extends Model {

	protected $casts = [
		'properties' => 'array'
	];

	public function doctor() {
		return $this->hasOne( User::class, 'id', 'doctor_id' );
	}

	public function patients() {
		return $this->belongsToMany( User::class, 'patient_surgery', 'user_id', 'surgery_id' );
	}
}
