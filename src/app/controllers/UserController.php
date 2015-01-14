<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		
		return View::make('hello');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $users = User::all();
		return $users;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// $input = Input::all();

		return Input::all();;
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
