<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Blade::directive( 'date', function ( $expression ) {
			return "($expression)->format('d.m.Y')";
		} );

		Paginator::defaultView( 'vendor.pagination.bootstrap-4' );
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
		$this->app->bind( 'path.public', function () {
			return base_path() . '/web';
		} );
	}
}
