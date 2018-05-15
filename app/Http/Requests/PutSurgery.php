<?php

namespace App\Http\Requests;

use App\Models\Surgery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PutSurgery extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		$surgery = Surgery::where( 'id', ( $this->segment( 2 ) ) );

		return ( ! Auth::guest() ) && Auth::user()->hasrole( 'doctor' ) && $surgery->exists();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name'    => 'required|min:3|max:255|unique:surgeries,name,' . $this->segment( 2 ),
			'zone'    => 'required|min:2|max:255',
			'address' => 'required|min:3|max:255',
			'city'    => 'required|min:3|max:255',
			'zip'     => 'required|digits:5'
		];
	}
}
