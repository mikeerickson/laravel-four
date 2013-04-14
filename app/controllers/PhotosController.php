<?php

class PhotosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//return Photo::all();
		
		$photos = Photo::all();
		
		$data = [
			'title'   => 'Photos',
			'photos'  => $photos
		];
		
		//return View::make('photos.index',compact('photos'));
		//return View::make('photos.index,$data);
		return View::make('photos.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	
		$data = ['title' => 'Photo: Create'];
		return View::make('photos.create')->with($data);
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
		$photo = Photo::find($id);
		
		$data = [
			'title'   => 'Photo: Detail',
			'photo'  => $photo
		];
				
		return View::make('photos.show')->with($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$photo = Photo::find($id);
		$data = [
			'title' => 'Photo: Edit',
			'photo' => $photo
		];
		return View::make('photos.edit')->with($data);
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