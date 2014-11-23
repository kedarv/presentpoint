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
	public function createRoom() {
		$data['name'] = "Create a Room";
		return View::make('createroom', compact('data'));
	}
	public function createRoomProcess() {
		$validator = Validator::make(
			array(
				'name' => Input::get('name'),
				'identifier' => Input::get('identifier'),
				'hooks' => Input::get('hooks'),
			),
			array(
				'name' => 'required|alpha_spaces',
				'identifier' => 'required|alpha|min:3',
				'hooks' => 'required|alpha_dash|min:1'
			)
		);
		if (Auth::check()) {
			if ($validator->fails()) {
				$return_data[] = array("status" => "danger");
				$return_data[] = $validator->messages();
				header('Content-Type: application/json');
				echo json_encode($return_data);
			}
			else {
				$room = new Room;
				$room->uid = Auth::user()->id;
				$room->name = Input::get('name');
				$room->identifier = Input::get('identifier');
				$room->hooks = Input::get('hooks');
				$room->save();
					
				$return_data = array('status' => 'success');			
				header('Content-Type: application/json');
				echo json_encode($return_data);
			}
		}
		else {
			$return_data[] = array('status' => 'danger');
			$return_data[] = array('error' => 'You are not logged in!');			
			header('Content-Type: application/json');
			echo json_encode($return_data);
		}
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

	public function viewAllRooms() {
		$room = Room::where('uid', '=', Auth::user()->id)->get()->toArray();
		$data['name'] = "View All Rooms";
		return View::make('viewallrooms', compact('data', 'room'));
	}

	public function getRoom($id) {
		if (Auth::check()) {
			$query = Room::where('uid', '=', Auth::user()->id);
			$count = $query->count();
			if($count > 0) {
				$info = $query->select('id')->get()->toArray();
				//Log::info(var_dump($getList));
				foreach($info as $value) {
					if(in_array($id, $value)) {
						$validator = Validator::make(
						    array('id' => $id),
						    array('id' => 'required|numeric')
						);
						if ($validator->fails()) {
							$data['name'] = "Error";
						}
						else {
							$records = Room::where('uid', '=', Auth::user()->id)->where('id','=',$id)->get()->toArray();
							$data['name'] = "Viewing Room";
						}
						break;
					}
					else {
						$data['name'] = "Error";
					}
				}
			}
			else {
				$data['name'] = "Error";
			}
		}
		else {
			$data['name'] = "Error";
		}
		return View::make('getroom', compact('data', 'records'));
	}
}