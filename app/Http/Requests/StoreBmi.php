<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class StoreBmi extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return $this->user()->hasChild( Input::get( 'child' ) );
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'height' => 'required|numeric|between:40,250',
			'weight' => 'required|numeric|between:2,150',
		];
	}

	public function forbiddenResponse() {
		abort( 403 );
	}
}
