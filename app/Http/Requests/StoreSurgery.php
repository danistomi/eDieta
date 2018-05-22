<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSurgery extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return ! Auth::guest();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		return [
			'name'           => 'required|min:3|max:255|unique:surgeries,name',
			'zone'           => 'required|min:2|max:255',
			'region'         => 'required|min:2|max:255',
			'address'        => 'required|min:3|max:255|unique_with:surgeries,' . $this->request->get( 'city' ) . ',' . $this->request->get( 'zip' ) . '',
			'city'           => 'required|min:3|max:255',
			'zip'            => 'required|digits:5',
			'chamber'        => 'required|min:3|max:255',
			'reg_num'        => 'required|regex:/^P[0-9]{5}$/',
			'specialization' => 'required|min:3',
			'confirlm'       => 'required'
		];
	}

}
