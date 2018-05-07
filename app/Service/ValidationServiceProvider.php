<?php

namespace App\Service;


use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
	}

	/**
	 * Boot the service provider.
	 */
	public function boot() {
		// Need to override the default validator with our own validator
		// We can do that by using the resolver function
		$this->app->validator->resolver( function ( $translator, $data, $rules, $messages ) {
			// This class will hold all our custom validations
			return new RequestValidator( $translator, $data, $rules, $messages );
		} );
	}
}