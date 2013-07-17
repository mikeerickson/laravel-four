<?php

class Contact extends Eloquent {

	public static $rules = array (
		'fname' => 'required|min:2',
		'lname' => 'required',
		'email' => 'required|email'
	);

	public static $rules_edit = array (
		'fname' => 'required|min:2',
		'lname' => 'required',
		'email' => 'required|email'
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}

	public static function validate_edit($data) {
		return Validator::make($data, static::$rules_edit);
	}

	public static function getFieldList() {
		return ['companies.companyName' => 'Company Name', 'fname' => 'First Name', 'lname' => 'Last Name', 'email' => 'E Mail', 'phone' => 'Phone', 'status' => 'Status'];
	}

	public static function contactList($per_page = 10, $where = [], $orderField = 'lname,asc' ) {

		//return DB::table('contacts')->orderBy('lname')->paginate($per_page);
		//return Contact::with('company')->orderBy('lname')->paginate($per_page);
		$_order = 'lname';
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
			return Contact::with('company')->where($_fname,$_delim,$_value)->orderBy($_order,$_dir)->paginate($per_page);
		}
		else
			return Contact::with('company')->orderBy($_order,$_dir)->paginate($per_page);
	}

	public static function getContact($id)
	{
		return Contact::with('company')->where('id','=',$id);
	}

	public static function getCount($where = []) {
		if(sizeof($where)==3) {
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];

			return DB::table('contacts')->where($_fname,$_delim,$_value)->count();
		}
		else
			return DB::table('contacts')->count();
	}

	public function companies()
	{
		return $this->hasOne('Company','id');
	}

	public function company()
	{
		return $this->belongsTo('Company','company_id');
	}

}