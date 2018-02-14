<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model {
	public function getFullNameAttribute() {
		return "{$this->first_name} {$this->last_name}";
	}
}
