<?php

class ContactsController extends BaseController {

	public $perPage = 12;
	public $where   = [];
	public $status = [
		''         => 'Select Status',
		'active'   => 'Active', 
		'inactive' => 'Inactive',
		'pending'  => 'Pending',
		'banned'   => 'Banned'
	];			

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		

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
					'recMessage' => $recMessage,
					'username'   => Cookie::get('username'),
					'password'   => Cookie::get('password')
				];
								
		//return View::make('contacts.test',$data);
		return View::make('contacts.index',$data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		var_dump("Contacts Create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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
						
			return Redirect::to(URL::to_route('contacts').'?page='.Input::get('page'))
				->with('message','User Updated Successfully')
				->with('msg_type','success');
		}		
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$contact = getContact($id);
		if($contact) {
			$data = [
				'title'    => 'Contacts',
				'contact'  => $contact
			];
			return View::make('contacts.show',$data);
		}
		else
			return "No record found matching ID {$id}";
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
	
		// query for record, if not found add a flash message and redirect to index method
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
			Session::flash('status_message', "Unable to Edit Record [{$id}].<br />Please contact Database Administrator.");
			Session::flash('status_class','alert-error');
			Session::flash('status_header','Database Error');
			return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
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
			'lname'  => Input::get('lname'),
			'fname'  => Input::get('fname'),			
			'email'  => Input::get('email'),
			'status' => Input::get('status'),
			'phone'  => Input::get('phone'),
			'active' => Input::get('active') ? 1 : 0			
		];

		$contact = Contact::find($id)->where('id', Input::get('id'))->update($data);
		//if ($contact) {	previous version of laravel had this as a truthy value, b4 does not
			Session::flash('status_message', 'Contact Updated Successfully');
			return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
		//}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$contact = Contact::find($id)->delete();
		Session::flash('status_message', 'Contact Deleted Successfully');
		return Redirect::to(URL::route('contacts.index').'?page='.Input::get('page'));
	}

}