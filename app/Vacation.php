<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model {

	public function child() {
		return $this->belongsTo( Child::class );
	}
}
