<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public static function getUsers($per_page = 5) {
# 		return DB::table('users')->where('username','LIKE','%erickson%')->order_by('username')->paginate($per_page);
		return DB::table('users')->orderBy('id')->paginate($per_page);
	}

	public static function getCount($where = []) {
		if(sizeof($where)==3) {
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];
		
			return DB::table('users')->where($_fname,$_delim,$_value)->count();
		}
		else
			return DB::table('users')->count();
	}
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}