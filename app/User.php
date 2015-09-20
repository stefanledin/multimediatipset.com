<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'uid', 'username', 'first_name', 'last_name',
		'profile_picture', 'profile_picture_thumbnail', 'is_admin'
	];

    /**
     * The user has many predictions
     */
    public function predictions()
	{
		return $this->hasMany('App\Prediction');
	}

}
