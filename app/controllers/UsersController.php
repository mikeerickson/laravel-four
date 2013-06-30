<?php

class UsersController extends BaseController {

	public $perPage = 20;
	public $where   = [];
	/* TODO: Pull this data from model method */
	public $category = [
		''         => 'Select Category',
		'parent'   => 'Parent',
		'student'  => 'Student',
		'dog'      => 'Dog',
		'relative' => 'Relative',
		'brother'  => 'Brother',
		'sister'   => 'Sister'
	];

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
				'title'      => 'Users',
				'recMessage' => $recMessage,
				'users'      => $users,
				'username'   => Cookie::get('username'),
				'password'   => Cookie::get('password')
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
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = User::validate_edit(Input::all());
		if($validation->fails()) {
			return Redirect::to_route('edit_user',array(Input::get('id')))
				->with_errors($validation)
				->with_input()
				->with('msg_type','error');
		} else {
			User::update(Input::get('id'), array(
				'username' => Input::get('username'),
				'email'    => Input::get('email'),
				'category' => Input::get('category'),
				'active'   => Input::get('active') ? 1 : 0
			));

			Session::flash('message','{"msgType": "alert-success", "msgHdr": "Record Update Successfully", "msgBody": "'.ucwords(Input::get('username')).' Updated Successfully"}');
			return Redirect::to(URL::to_route('users').'?page='.Input::get('page'));

		}
	
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
		return "show";
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		if($user) {
			$data = [
				'title' => 'Users',
				'category' => $this->category,
				'user'  => $user
			];
			return View::make('users.edit',$data);
		}
		else {
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Edit Record ['.$id.'].<br />Please contact Database Administrator."}');
			return Redirect::to(URL::route('users.index').'?page='.Input::get('page'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$data = [
			'username'  => Input::get('username'),
			'email'  => Input::get('email'),
			'category' => Input::get('category'),
			'active' => Input::get('active') ? 1 : 0
		];

		$contact = User::find($id)->where('id', Input::get('id'))->update($data);
		Session::flash('message','{"msgType": "alert-success", "msgHdr": "Record Update Successfully", "msgBody": "'.ucwords(Input::get('username')).' Updated Successfully"}');
		return Redirect::to(URL::route('users.index').'?page='.Input::get('page'));
		//}
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