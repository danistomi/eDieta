<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\UserSettings;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'guest' );
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 *
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator( array $data ) {
		return Validator::make( $data, [
			'username' => 'required|max:255|unique:users',
			'email'    => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		] );
	}

	protected function registered( Request $request, $user ) {
		$this->guard()->logout();

		return redirect( '/login' )->with( 'status', 'We sent you an activation code. Check your email and click on the link to verify.' );
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 *
	 * @return User
	 */
	protected function create( array $data ) {
		$user = User::create( [
			'username' => $data['username'],
			'email'    => $data['email'],
			'password' => bcrypt( $data['password'] ),
		] );

		$settings = new UserSettings();
		if ( Config::get( 'app.default_locale' ) == '' ) {
			$settings->site_language = Session::has( 'applocale' ) ? Session::get( 'applocale' ) : Config::get( 'app.fallback_locale' );
		} else {
			$settings->site_language = Config::get( 'app.locale' );
		}

		$user->roles()->attach( Role::where( 'name', 'user' )->first() );
		$user->settings()->save( $settings );

		$verifyUser = VerifyUser::create( [
			'user_id' => $user->id,
			'token'   => str_random( 40 ),
		] );

		Mail::to( $user->email )->send( new VerifyMail( $user ) );

		return $user;
	}

	public function verifyUser( $token ) {
		$verifyUser = VerifyUser::where( 'token', $token )->first();
		if ( isset( $verifyUser ) ) {
			$user = $verifyUser->user;
			if ( ! $user->verified ) {
				$verifyUser->user->verified = true;
				$verifyUser->user->save();
				$status = Lang::get( 'auth.verified_mail' );
			} else {
				$status = Lang::get( 'auth.already_verified_mail' );
			}
		} else {
			return redirect( '/login' )->with( 'warning', Lang::get( 'auth.error_identify_mail' ) );
		}

		return redirect( '/login' )->with( 'status', $status );
	}
}
