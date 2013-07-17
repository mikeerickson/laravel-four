<?php

class PlayersController extends BaseController {

	public $perPage = 20;
	public $where   = [];


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// $user = User::where('username', '=', 'mike erickson')->first();
		// Auth::login($user);

		// get any query form values (sort order coming from column headers)
		$field = Input::get('queryField');
		$delim = Input::get('queryDelim');
		$value = Input::get('queryValue');
		$order = Input::get('queryOrder');

		$tempDelim = $delim;

		if(is_null(Input::get('page'))) {
			Session::set('queryParams','');
		}
		$queryParams = Session::get('queryParams');

		if(($field == '') && ($delim == '') && ($value == '') && ($order == '')) {
			$field = Helpers::getQueryParamValue($queryParams,'queryField');
			$delim = Helpers::getQueryParamValue($queryParams,'queryDelim');
			$value = Helpers::getQueryParamValue($queryParams,'queryValue');
			$order = Helpers::getQueryParamValue($queryParams,'queryOrder');
		}

		// default sort order (overridden until we have all working)
		$queryOrder = 'lname,asc';

		// cache these variables, used the pass data along to view so the query objects are prefilled if necessary
		$queryField = $field;
		$queryDelim = $delim;
		$queryValue = $value;
		$queryOrder = $order;

		if((!$field == '') && (!$value == '')) {
			if($delim == '#') $delim = '<>';
			if($delim == 'equals') $delim = '=';
			if($delim == '') $delim = '=';
			if($delim == 'LIKE') $value = '%'.$value.'%';
			if($delim == 'begins') { $value = $value.'%'; $delim = 'LIKE'; }
			$this->where = [$field,$delim,$value];
		}

		$value = str_replace('%', '', $value);
		if($tempDelim=='') $tempDelim = 'equals';
		$queryParam = 'queryField='.$field.'&queryDelim='.$tempDelim.'&queryValue='.$value.'&queryOrder='.$order;
		Session::set('queryParams',$queryParam);

		$players = Player::playerList($this->perPage,$this->where,$queryOrder);
		if( count($players) == 0 ) {
			Session::set('queryParams','');
			//return Redirect::to(URL::route('contacts.index').'?page=1');
		}

		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = Player::getCount($this->where);
		$pageCount  = count($players);
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);

		$data = [
					'title'      => 'Players',
					'players'    => $players,
					'fieldList'  => Player::getFieldList(),
					'delimList'  => Helpers::getQueryDelimeterList(),
					'recMessage' => $recMessage,
					'queryField' => $queryField,
					'queryDelim' => $queryDelim,
					'queryValue' => $queryValue,
					'orderField' => $queryOrder,
					'username'   => Cookie::get('username'),
					'password'   => Cookie::get('password')
				];

		return View::make('players.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		var_dump("Player Create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		var_dump("Show Player with id {$id}");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		var_dump("Edit Player with id {$id}");
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}