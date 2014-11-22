<?php

class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome() {
		$data['name'] = "Home";
		return View::make('home', compact('data'));
	}
	public function contact() {
		$data['name'] = "Contact";
		return View::make('contact', compact('data'));
	}
	public function contactProcess() {
		$validator = Validator::make(
			array(
				'email' => Input::get('email'),
				'firstname' => Input::get('firstname'),
				'lastname' => Input::get('lastname'),
				'message' => Input::get('message'),
				'priority' => Input::get('priority'),
			),
			array(
				'email' => 'required|email',
				'firstname' => 'required|alpha|min:1',
				'lastname' => 'required|alpha|min:1',
				'message' => 'required|min:20',
				'priority' => 'required'
			)
		);
		if ($validator->fails()) {
			$return_data[] = array("status" => "danger");
			$return_data[] = $validator->messages();
			header('Content-Type: application/json');
			echo json_encode($return_data);
		}
		else {
			$contact = new Contact;
			$contact->email = Input::get('email');
			$contact->firstname = Input::get('firstname');
			$contact->lastname = Crypt::encrypt(Input::get('lastname'));
			$contact->message = Crypt::encrypt(Input::get('message'));
			$contact->priority = Input::get('priority');
			$contact->save();
				
			$return_data = array('status' => 'success');			
			header('Content-Type: application/json');
			echo json_encode($return_data);
		}
	}
}