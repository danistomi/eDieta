<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define( App\Models\User::class, function ( Faker\Generator $faker ) {
	static $password;

	return [
		'first_name' => $faker->firstName( $gender = 'male' | 'female' ),
		'last_name'  => $faker->lastName,
		'username'   => $faker->userName,
		'email'      => $faker->unique()->safeEmail,
		'password'   => $password ?: $password = bcrypt( 'secret' ),
	];
} );

$factory->define( App\Models\Child::class, function ( Faker\Generator $faker ) {
	return [
		'parent_id'     => 1,
		'first_name'    => $faker->firstName,
		'last_name'     => $faker->lastName,
		'date_of_birth' => '2017-' . rand( 1, 12 ) . '-' . rand( 1, 28 ),
		'gender'        => $faker->randomElement( [ 'male', 'female' ] )
	];
} );
