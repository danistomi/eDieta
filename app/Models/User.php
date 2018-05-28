<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'lase_name',
		'username',
		'email',
		'password'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function verifyUser() {
		return $this->hasOne( VerifyUser::class );
	}

	public function roles() {
		return $this->belongsToMany( Role::class );
	}

	public function children() {
		return $this->hasMany( Child::class, 'parent_id' );
	}

	public function settings() {
		return $this->hasOne( UserSettings::class );
	}

	/**
	 * If user has role 'doctor' can access workplace (surgery)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function workplace() {
		$this->authorizeRoles( 'doctor' );

		return $this->hasOne( Surgery::class, 'doctor_id' );
	}

	public function doctors() {
		return $this->belongsToMany( User::class, 'doctor_patient', 'user_id', 'doctor_id' )->withTimestamps();
	}

	public function patients() {
		$this->authorizeRoles( 'doctor' );

		return $this->belongsToMany( User::class, 'doctor_patient', 'doctor_id', 'user_id' )
		            ->withTimestamps()
		            ->withPivot( 'verify_code' );
	}


	public function getFullNameAttribute() {
		return $this->first_name . ' ' . $this->last_name;
	}

	/**
	 * @param string|array $roles
	 *
	 * @return bool
	 */
	public function authorizeRoles( $roles ) {
		if ( is_array( $roles ) ) {
			return $this->hasAnyRole( $roles ) || abort( 401, 'This action is unauthorized' );
		}

		return $this->hasRole( $roles ) || abort( 401, 'This action is unauthorized.' );
	}

	/**
	 * Check multiple roles
	 *
	 * @param array $roles
	 *
	 * @return bool
	 */
	public function hasAnyRole( $roles ) {
		return null !== $this->roles()->whereIn( 'name', $roles )->first();
	}

	/**
	 * Check one role
	 *
	 * @param string $role
	 *
	 * @return bool
	 */
	public function hasRole( $role ) {
		return null !== $this->roles()->where( 'name', $role )->first();
	}

	public function hasChild( $childId ) {
		return null !== $this->children()->find( $childId );
	}

	public function hasDoctor( $doctorId ) {
//		dd($this->doctors()->where( 'id', $doctorId )->wherePivot( 'verified', true )->first());
		return null !== $this->doctors()->where( 'id', $doctorId )->first();
	}
}
