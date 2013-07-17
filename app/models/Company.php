<?php

class Company extends Eloquent {
	public function contacts() {
		return $this->hasMany('Contact');
	}

	public static function getFieldList() {
		return ['companyName' => 'Company Name', 'address' => 'Address', 'city' => 'City', 'state' => 'State', 'zip' => 'Zip'];
	}

	public static function companyList($per_page = 10, $where = [], $orderField = 'companyName,asc' ) {

		$_order = 'companyName';
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
			return Company::with('contacts')->where($_fname,$_delim,$_value)->orderBy($_order,$_dir)->paginate($per_page);
		}
		else
			return Company::with('contacts')->orderBy($_order,$_dir)->paginate($per_page);
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