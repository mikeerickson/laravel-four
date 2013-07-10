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

		$field = Input::get('queryField');
		$delim = Input::get('queryDelim');
		$value = Input::get('queryValue');
		if((!$field == '') && (!$value == '')) {
			if($delim == '#') $delim = '<>';
			if($delim == 'LIKE') $value = '%'.$value.'%';
			$this->where = [$field,$delim,$value];
		}

		$fieldList = Player::getFieldList();
		$delimList = Player::getDelimList();

		$players  = Player::playerList($this->perPage,$this->where);
		if( count($players) == 0 )
			return Redirect::to(URL::route('players.index').'?page=1');

		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = Player::getCount($this->where);
		$pageCount  = count($players);
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);

		$data = [
					'title'      => 'Players',
					'players'    => $players,
					'recMessage' => $recMessage,
					'fieldList'  => $fieldList,
					'delimList'  => $delimList,
					'username'   => Cookie::get('username'),
					'password'   => Cookie::get('password')
				];

		//return View::make('contacts.test',$data);
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