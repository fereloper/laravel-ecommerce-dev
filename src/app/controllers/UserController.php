<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		return User::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$message = Session::get('message');

		$form = '<p>' . $message . '</p>';
    	$form .= '<form action="/api/v1/user" method="POST">';
		$form .= Form::token();
		$form .= 'Name: <input type="text" name="name" placeholder="Enter your name" id="name"><br>';
		$form .= 'Email: <input type="email" name="email" placeholder="Enter your email" id="email"><br>';
		$form .= 'Password: <input type="text" name="password" placeholder="Enter your password" id="password"><br>';
		$form .= '<input type="submit">';
		$form .= '</form>';
		
		return $form;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( Input::get('email') !='' ) {

			$user = new User;

		    $user->name 	= Input::get('name');
		    $user->email 	= Input::get('email');
		    $user->password = Input::get('password');

		    $user->save();

		    return Redirect::to('api/v1/user');
		}

		return Redirect::to('api/v1/user/create')->with('message', 'All fields are required!.');
		
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$user = array(
			'name' 		=> 'Demo user',
			'email'		=> 'user@email-address.com',
			'myproducts'=> array(
				'title'	=> 'Product title1',
				'price'	=> 195.00,
			),
		);

		return Response::json($user, 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return "Editing user : " . $id;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return "Updating user : " . $id;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return "Deleteing user : " . $id;
	}

	
	public function login() {

		if ( Input::get('email') == 'imrancluster@gmail.com' && Input::get('password') == '123' )
	    {
	        return Redirect::to('api/v1/user/demouser');
	    }

		return Redirect::to('api/v1/user')->with('message', 'Login Failed');
	}


}
