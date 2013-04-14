<?php

class CompaniesController extends BaseController {

	public $perPage = 12;
	public $where   = [];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}