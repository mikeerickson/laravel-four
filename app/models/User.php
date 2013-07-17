<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public static $category = [
			''         => 'Select Category',
			'parent'   => 'Parent',
			'student'  => 'Student',
			'dog'      => 'Dog',
			'relative' => 'Relative',
			'brother'  => 'Brother',
			'sister'   => 'Sister'
		];

	public static function getCategoryList() {
		return self::$category;
	}

	public static function getFieldList() {
		return ['username' => 'User Name', 'email' => 'E Mail', 'category' => 'Category', 'active' => 'Status' ];
	}

	public static function userList($per_page = 10, $where = [], $orderField = 'username,asc') {
		$_order = 'username';
		$_dir = 'ASC';
		if(strlen($orderField)>1) {
			$result = explode(',', $orderField);
			if(sizeof($result)>=1) {
				$_order = $result[0];
				if(sizeof($result)>=2)
					$_dir = $result[1];
			}
		}

		if(sizeof($where) == 3) {
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];
			return User::where($_fname,$_delim,$_value)->orderBy($_order,$_dir)->paginate($per_page);
		}
		else
			return User::orderBy($_order,$_dir)->paginate($per_page);
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