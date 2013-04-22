<?php

class UsersController extends BaseController {

	public $perPage = 12;
	public $where   = [];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$users = User::getUsers($this->perPage,$this->where);
		if( count($users) == 0 )
			return Redirect::to(URL::route('users.index').'?page=1');
			
		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = User::getCount($this->where);
		$pageCount  = count($users);	
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);		
				
		$data = array(
				'title'     => 'Users',
				'recMessage' => $recMessage,
				'users'     => $users,
				'username'  => Cookie::get('username'),
				'password'  => Cookie::get('password')
			);
			
		return View::make('users.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		return "Edit User {$id}";
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
		return "Destroy User {$id}";
	}

}