<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string description
 * @property string name
 */
class Role extends Model {
	public function users() {
		return $this->belongsToMany( User::class );
	}
}
