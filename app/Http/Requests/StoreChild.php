<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreChild extends FormRequest {
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
			'first_name'    => 'required|min:3|max:255',
			'last_name'     => 'required|min:3|max:255',
			'date_of_birth' => 'required|date',
			'gender'        => 'required|in:male,female'
		];
	}
}
