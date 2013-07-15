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
		$queryOrder = 'username,asc';

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

		$users = User::userList($this->perPage,$this->where,$queryOrder);
		if( count($users) == 0 ) {
			Session::set('queryParams','');
			//return Redirect::to(URL::route('contacts.index').'?page=1');
		}

		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = User::getCount($this->where);
		$pageCount  = count($users);
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);

		$data = [
					'title'      => 'Users',
					'users'   	 => $users,
					'fieldList'  => User::getFieldList(),
					'delimList'  => User::getDelimList(),
					'recMessage' => $recMessage,
					'queryField' => $queryField,
					'queryDelim' => $queryDelim,
					'queryValue' => $queryValue,
					'orderField' => $queryOrder,
					'username'   => Cookie::get('username'),
					'password'   => Cookie::get('password')
				];

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