<?php

class Company extends Eloquent {
	public function contacts() {
		return $this->hasMany('Contact');
	}
	
	public static function getCompanies($per_page = 10, $where = [] ) {
	
		//return DB::table('contacts')->orderBy('lname')->paginate($per_page);
		//return Contact::with('company')->orderBy('lname')->paginate($per_page);
		
		if(sizeof($where) == 3) {	
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];
			return Company::with('contacts')->where($_fname,$_delim,$_value)->orderBy('lname')->paginate($per_page);
		}
		else
			return Company::with('contacts')->orderBy('companyName')->paginate($per_page);
		
		//$contacts = Contact::with('company')->where('fname','=','trevor')->orderBy('lname')->paginate($per_page);
		//return $contacts;
	}

	public static function getCount($where = []) {
		if(sizeof($where)==3) {
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];
		
			return DB::table('companies')->where($_fname,$_delim,$_value)->count();
		}
		else
			return DB::table('companies')->count();
	}
	
}