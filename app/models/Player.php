<?php

class Player extends Eloquent {

	public static function getFieldList() {
		return ['fname' => 'First Name', 'lname' => 'Last Name', 'position' => 'Position', 'bats' => 'Bats', 'throws' => 'Throws', 'number' => 'Number', 'class' => 'Class'];
	}

	public static function playerList($per_page = 10, $where = [], $orderField = 'lname,asc') {
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
			return Player::where($_fname,$_delim,$_value)->orderBy($_order,$_dir)->paginate($per_page);
		}
		else
			return Player::orderBy($_order,$_dir)->paginate($per_page);
	}

	public static function getCount($where = []) {
		if(sizeof($where)==3) {
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];

			return DB::table('players')->where($_fname,$_delim,$_value)->count();
		}
		else
			return DB::table('players')->count();
	}

}