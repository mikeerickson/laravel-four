<?php

class Player extends Eloquent {

	public static function getFieldList() {
		return ['fname' => 'First Name', 'lname' => 'Last Name', 'position' => 'Position', 'bats' => 'Bats', 'throws' => 'Throws', 'number' => 'Number', 'class' => 'Class'];
	}

	public static function getDelimList() {
		return ['=' => 'is equal to', '<>' => 'not equal to', 'LIKE' => 'contains'];
	}

	public static function playerList($per_page = 10, $where = [] ) {

		//return DB::table('contacts')->orderBy('lname')->paginate($per_page);
		//return Contact::with('company')->orderBy('lname')->paginate($per_page);

		if(sizeof($where) == 3) {
			$_fname = $where[0];
			$_delim = $where[1];
			$_value = $where[2];
			return Player::where($_fname,$_delim,$_value)->orderBy('lname')->paginate($per_page);
		}
		else
			return DB::table('players')->orderBy('lname')->paginate($per_page);

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