<?php

class CompaniesController extends BaseController {

	public $perPage = 20;
	public $where   = [];

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

		$fieldList = Company::getFieldList();
		$delimList = Company::getDelimList();

		$companies = Company::getCompanies($this->perPage,$this->where);
		if( count($companies) == 0 )
			return Redirect::to(URL::route('companies.index').'?page=1');

		// setup recMessage Object
		$currPage   = Input::get('page') ? Input::get('page') : 1;
		$recCount   = Company::getCount($this->where);
		$pageCount  = count($companies);
		$recMessage = Helpers::recMessage($currPage, $this->perPage, $pageCount, $recCount);

		$data = array(
				'title'      => 'Companies',
				'companies'  => $companies,
				'recMessage' => $recMessage,
				'fieldList'  => $fieldList,
				'delimList'  => $delimList,
				'username'   => Cookie::get('username'),
				'password'   => Cookie::get('password')
			);

		return View::make('companies.index',$data);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$company = Company::find($id);
		if($company) {
			$data = [
				'title'    => 'Companies',
				'company'  => $company
			];
			return View::make('companies.edit',$data);
		}
		else {
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Edit Record ['.$id.'].<br />Please contact Database Administrator."}');
			return Redirect::to(URL::route('companies.index').'?page='.Input::get('page'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = [
			'companyName' => Input::get('companyName'),
			'address'     => Input::get('address'),
			'city'        => Input::get('city'),
			'state'       => Input::get('state'),
			'zip'         => Input::get('zip')
		];
		$company = Company::find($id)->where('id', $id)->update($data);
		if($company)
			Session::flash('message','{"msgType": "alert-success", "msgHdr": "Record Update Successfully", "msgBody": "'.Input::get('companyName').' Updated Successfully"}');
		else
			Session::flash('message','{"msgType": "alert-error", "msgHdr": "Database Error", "msgBody": "Unable to Update Record ['.$id.'].<br />Please contact Database Administrator."}');

		return Redirect::to(URL::route('companies.index').'?page='.Input::get('page'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return "Deleting {$id}";
	}

}