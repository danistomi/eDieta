<?php

namespace App\Http\Controllers\Surgery;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurgery;
use App\Models\Surgery;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}
}
