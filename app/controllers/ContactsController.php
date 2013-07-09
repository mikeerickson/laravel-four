<?php

class ContactsController extends BaseController {

	public $perPage = 20;
	public $where   = []; // ['lname','LIKE','E%']
	public $status = [
		''         => 'Select Status',
		'active'   => 'Active',
		'inactive' => 'Inactive',
		'pending'  => 'Pending',
		'banned'   => 'Banned'
	];

	public function index()
	{

		$user = User::where('username', '=', 'mike erickson')->first();
		Auth::login($user);

		$field = Input::get('queryField');
		$delim = Input::get('queryDelim');
		$value = Input::get('queryValue');
		if((!$field == '') && (!$value == '')) {
			if($delim == '#') $delim = '<>';
			if($delim == 'LIKE') $value = '%'.$value.'%';
			$this->where = [$field,$delim,$value];
		}

		$fieldList = Contact::getFieldList();
		$delimList = Contact::getDelimList();

		//$contacts  = Contact::with('company')->orderBy('lname')->paginate($this->perPage);
		$contacts  = Contact::contactList($this->perPage,$this->where);
		if( count($contacts) == 0 )
			return Redirect::to(URL::route('contacts.index').'?page=1');

		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = Contact::getCount($this->where);
		$pageCount  = count($contacts);
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);

		$data = [
					'title'      => 'Contacts',
					'contacts'   => $contacts,
					'fieldList'  => $fieldList,
					'delimList'  => $delimList,
					'recMessage' => $recMessage,
					'username'   => Cookie::get('username'),
					'password'   => Cookie::get('password')
				];

		return View::make('contacts.index',$data);
	}

	public function create()
	{
		var_dump("Contacts Create");
	}

	public function store()
	{
		$validation = Contact::validate_edit(Input::all());
		if($validation->fails()) {
			return Redirect::to_route('edit_user',array(Input::get('id')))
				->with_errors($validation)
				->with_input()
				->with('msg_type','error');
		} else {
			Contact::update(Input::get('id'), array(
				'fname'  => Input::get('fname'),
				'lname'  => Input::get('lname'),
				'email'  => Input::get('email'),
				'phone'  => Input::get('phone'),
				'status' => Input::get('status'),
				'active' => Input::get('active') ? 1 : 0
			));

			Session::flash('message','{"msgType": "alert-success", "msgHdr": "Success", "msgBody": "Contact Created Successfully"}');
			return Redirect::to(URL::to_route('contacts').'?page='.Input::get('page'));

		}
	}

	public function show($id)
	{
		$contact = Contact::find($id);
		if($contact) {
			$data = [
				'title'    => 'Contacts',
				'status'   => $this->status,
				'contact'  => $contact
			];
			return View::make('contacts.show',$data);
		}
		else {
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Edit Record ['.$id.'].<br />Please contact Database Administrator."}');
			return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
		}
	}

	public function edit($id)
	{
		$contact = Contact::find($id);
		if($contact) {
			$data = [
				'title'    => 'Contacts',
				'status'   => $this->status,
				'contact'  => $contact
			];
			return View::make('contacts.edit',$data);
		}
		else {
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Edit Record ['.$id.'].<br />Please contact Database Administrator."}');
			return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
		}
	}

	public function update($id)
	{
		$data = [
			'lname'  => Input::get('lname'),
			'fname'  => Input::get('fname'),
			'email'  => Input::get('email'),
			'status' => Input::get('status'),
			'phone'  => Input::get('phone'),
			'active' => Input::get('active') ? 1 : 0
		];
		$fullname = Input::get('fname').' '.Input::get('lname');
		$contact = Contact::find($id)->where('id', Input::get('id'))->update($data);
		Session::flash('message','{"msgType": "alert-success", "msgHdr": "Record Update Successfully", "msgBody": "'.$fullname.' Updated Successfully"}');
		return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
	}

	public function destroy($id)
	{
		$contact = Contact::find($id)->delete();
		Session::flash('message','{"msgType": "alert-success", "msgHdr": "Success", "msgBody": "Contact Deleted Successfully"}');
		return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
	}

}