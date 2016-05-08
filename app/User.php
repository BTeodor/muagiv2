<?php

namespace App;

use App\Presenters\UserPresenter;
use App\Services\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use App\Services\Auth\TwoFactor\Contracts\Authenticatable as TwoFactorAuthenticatableContract;
use App\Services\Logging\UserActivity\Activity;
use App\Support\Authorization\AuthorizationUserTrait;
use App\Support\Enum\UserStatus;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;

class User extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract,
TwoFactorAuthenticatableContract {
	use TwoFactorAuthenticatable, CanResetPassword, Presentable, AuthorizationUserTrait;

	protected $presenter = UserPresenter::class;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $dates = ['last_login', 'birthday'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'username', 'first_name', 'last_name', 'phone', 'avatar',
		'address', 'country_id', 'birthday', 'last_login', 'confirmation_token', 'status',
		'group_id', 'remember_token',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Always encrypt password when it is updated.
	 *
	 * @param $value
	 * @return string
	 */
	public function setPasswordAttribute($value) {
		$this->attributes['password'] = bcrypt($value);
	}

	public function setBirthdayAttribute($value) {
		$this->attributes['birthday'] = trim($value) ?: null;
	}

	public function gravatar() {
		$hash = hash('md5', strtolower(trim($this->attributes['email'])));

		return sprintf("//www.gravatar.com/avatar/%s", $hash);
	}

	public function isUnconfirmed() {
		return $this->status == UserStatus::UNCONFIRMED;
	}

	public function isActive() {
		return $this->status == UserStatus::ACTIVE;
	}

	public function isBanned() {
		return $this->status == UserStatus::BANNED;
	}

	public function socialNetworks() {
		return $this->hasOne(UserSocialNetworks::class, 'user_id');
	}

	public function country() {
		return $this->belongsTo(Country::class, 'country_id');
	}

	public function activities() {
		return $this->hasMany(Activity::class, 'user_id');
	}

	public function favorite(){
		return $this->belongsToMany('App\Products', 'favorite', 'user_id', 'product_id')->withTimestamps()->withPivot('product_id');
	}

	public function watch_recent(){
		return $this->belongsToMany('App\Products', 'watch_recent', 'user_id', 'product_id')->withTimestamps()->withPivot('product_id');
	}

	public function role(){
		return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withPivot('role_id');
	}

	public function channel(){
		return $this->hasOne('App\Channels');
	}
}
