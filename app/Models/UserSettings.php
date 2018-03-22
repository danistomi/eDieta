<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model {

	protected $fillable = [
		'site_language'
	];

	public function user() {
		return $this->belongsTo( User::class );
	}
}