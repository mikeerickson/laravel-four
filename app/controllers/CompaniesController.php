<?php

class CompaniesController extends BaseController {

	public $perPage = 20;
	public $where   = []; // ['lname','LIKE','E%']

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

		$companies = Company::companyList($this->perPage,$this->where,$queryOrder);
		if( count($companies) == 0 ) {
			Session::set('queryParams','');
			//return Redirect::to(URL::route('contacts.index').'?page=1');
		}

		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = Company::getCount($this->where);
		$pageCount  = count($companies);
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);

		$data = [
					'title'      => 'Companies',
					'companies'   => $companies,
					'fieldList'  => Company::getFieldList(),
					'delimList'  => Company::getDelimList(),
					'recMessage' => $recMessage,
					'queryField' => $queryField,
					'queryDelim' => $queryDelim,
					'queryValue' => $queryValue,
					'orderField' => $queryOrder,
					'username'   => Cookie::get('username'),
					'password'   => Cookie::get('password')
				];

		return View::make('companies.index',$data);
	}

	public function create()
	{
		var_dump("Companies Create");
	}

	public function store()
	{
		$validation = Company::validate_edit(Input::all());
		if($validation->fails()) {
			return Redirect::to_route('edit_user',array(Input::get('id')))
				->with_errors($validation)
				->with_input()
				->with('msg_type','error');
		} else {
			Company::update(Input::get('id'), array(
				'fname'  => Input::get('fname'),
				'lname'  => Input::get('lname'),
				'email'  => Input::get('email'),
				'phone'  => Input::get('phone'),
				'status' => Input::get('status'),
				'active' => Input::get('active') ? 1 : 0
			));

			Session::flash('message','{"msgType": "alert-success", "msgHdr": "Success", "msgBody": "Company Created Successfully"}');
			return Redirect::to(URL::to_route('companies').'?page='.Input::get('page'));

		}
	}

	public function show($id)
	{
		$company = Company::find($id);
		if($company) {
			$data = [
				'title'    => 'Companies',
				'status'   => $this->status,
				'company'  => $company
			];
			return View::make('companies.show',$data);
		}
		else {
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Edit Record ['.$id.'].<br />Please contact Database Administrator."}');
			return Redirect::to(URL::route('companies.index').'?page='.Input::get('page'));
		}
	}

	public function edit($id)
	{
		$company = Company::find($id);
		if($company) {
			$data = [
				'title'    => 'Companies',
				'status'   => $this->status,
				'company'  => $company
			];
			return View::make('companies.edit',$data);
		}
		else {
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Edit Record ['.$id.'].<br />Please contact Database Administrator."}');
			return Redirect::to(URL::route('companies.index').'?page='.Input::get('page'));
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
		$company = Company::find($id)->where('id', Input::get('id'))->update($data);
		Session::flash('message','{"msgType": "alert-success", "msgHdr": "Record Update Successfully", "msgBody": "'.$fullname.' Updated Successfully"}');
		return Redirect::to(URL::route('companies.index').'?page='.Input::get('page'));
	}

	public function destroy($id)
	{
		$company = Company::find($id)->delete();
		Session::flash('message','{"msgType": "alert-success", "msgHdr": "Success", "msgBody": "Company Deleted Successfully"}');
		return Redirect::to(URL::route('companies.index').'?page='.Input::get('page'));
	}

}