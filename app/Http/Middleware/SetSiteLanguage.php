<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


class SetSiteLanguage {
	public function handle( $request, Closure $next ) {
		if ( Auth::guest() ) {
			if ( Session::has( 'applocale' ) and array_key_exists( Session::get( 'applocale' ), Config::get( 'languages' ) ) ) {
				App::setLocale( Session::get( 'applocale' ) );
			} else {
				// This is optional as Laravel will automatically set the fallback language if there is none specified
				App::setLocale( Config::get( 'app.fallback_locale' ) );
			}
		} else {
			App::setLocale( Auth::user()->settings->site_language );
		}

		return $next( $request );
	}
}
