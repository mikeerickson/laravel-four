<?php

Route::get('/boot','BootController@index');
/*
Route::get('/boot', function()
{
	return "Hello from boot";
});
*/
/* Route::get('boot', array('as' => 'boot', 'uses' => 'BootController@index')); */

Route::post('/angular', function(){

	$data = file_get_contents("php://input");	
	$objData = json_decode($data);		 
	$val = '%'.$objData->data.'%';
	return Contact::with('company')->where('fname','LIKE',$val)->orWhere('lname','LIKE',$val)->orderBy('lname')->get();	
			 
});

Route::get('/', function()
{	
/*
	$company = Company::with('contacts')->get();
	return $company;
*/
	
	//$contacts = Contact::find(67)->company;
	//$contacts = Contact::with('company')->find(67);
	//$contacts = Contact::with('company')->get();
	//return $contacts; 						// <- this will return the full contact record (with related one company recor)
	//return $contacts->company->companyName; // <- this will return the company name in related one record.
	$data = [	
				'msgInfo'   => json_decode('{"msgType": "alert-success", "msgHdr": "", "msgBody": "This is a test"}'),
				'title'  => 'Home',
				'header' => 'Home',
			];
	return View::make('hello', $data);
});

Route::get('/twig', function() {
	
	ChromePhp::log('test twig route');

	$date = ExpressiveDate::make(); var_dump($date);
	var_dump($date->minusSeconds(30)->getRelativeDate());
	var_dump($date->today());
	var_dump($date->tomorrow());
	var_dump($date->yesterday()->getRelativeDate());
	$born = ExpressiveDate::make('October 15, 1966'); var_dump($born->getRelativeDate());
	$days = $born->getDifferenceInDays($date); var_dump("Days old as of today: $days");
		
	$data = [	"fname"  => "Mike",
				"lname"  => "Erickson",
				"kids"   => ['joelle', 'brady', 'bailey', 'trevor'],
				'dogs'   => ['shilo','honu','gunner'],
				'designer' => 'mike erickson',
				'family' => [
								'father'    => 'mike erickson', 
								'mother'    => 'kira erickson',
								'daughter1' => 'joelle erickson',
								'son1'      => 'brady erickson',
								'daughter2' => 'bailey erickson',
								'son2'      => 'trevor erickson'
							]
			];
	
	return View::make('test')->with($data);	
});


Route::get('/blade', function() {
	
	ChromePhp::log('test blade route');

	$date = ExpressiveDate::make(); var_dump($date);
	var_dump($date->minusSeconds(30)->getRelativeDate());
	var_dump($date->today());
	var_dump($date->tomorrow());
	var_dump($date->yesterday()->getRelativeDate());
	$born = ExpressiveDate::make('October 15, 1966'); var_dump($born->getRelativeDate());
	$days = $born->getDifferenceInDays($date); var_dump("Days old as of today: $days");
		
	$data = [	"fname"    => "Mike",
				"lname"    => "Erickson",
				"kids"     => ['joelle', 'brady', 'bailey', 'trevor'],
				'dogs'     => ['shilo','honu','gunner'],
				'designer' => 'mike erickson',
				'title'    => 'title',
				'family'   => [
								'father'    => 'mike erickson', 
								'mother'    => 'kira erickson',
								'daughter1' => 'joelle erickson',
								'son1'      => 'brady erickson',
								'daughter2' => 'bailey erickson',
								'son2'      => 'trevor erickson'
							]
			];
	
	return View::make('test3')->with($data);	
	//return View::make('hello')->with($data);
});

Route::resource('users', 'UsersController');

Route::resource('photos', 'PhotosController');

Route::resource('contacts', 'ContactsController');

Route::resource('cars', 'CarsController');

Route::resource('animals', 'AnimalsController');

Route::resource('players', 'PlayersController');

Route::resource('companies', 'CompaniesController');