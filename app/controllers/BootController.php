<?php

class BootController extends BaseController {

	public $restful  = true;

	public function index() {
		$data = array(
			'title' => 'Bootstrap Test',
			'header' => 'Bootstrap Test'
		);
		//return View::make('boot.index',$data);
		//return "Hello from BootController";
		return View::make('boot.index',$data);
	}

}