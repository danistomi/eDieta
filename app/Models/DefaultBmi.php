<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefaultBmi extends Model {

	protected $fillable = [ 'age', 'bmi', 'gender', 'percentile' ];

}
