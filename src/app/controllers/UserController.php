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
		
		
		return array('message' => 'Form show.');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array();

		if ( Input::get('email') !='' ) {

			$user = new User;

		    $user->name 	= Input::get('name');
		    $user->email 	= Input::get('email');
		    $user->password = Hash::make(Input::get('password'));

		    $user->save();

		    $data = array(
				'message'	=> 'successfully registered',
				'code'		=> 200,
			);

		    
		} else {

			$data = array(
				'message'	=> 'not registered',
				'code'		=> 202,
			);

		}
		
		return $data;
		
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$data = array();

		$user = User::find($id);

		
		if ( isset($user->email) ) {

			$data = $user;
			$data['code'] = 200;

		} else {

			$data = array(
				'user'	=> 'user not found',
				'code'		=> 203,
			);
		}

		return $data;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array();

		$user = User::find($id);

		
		if ( isset($user->email) ) {

			$data = $user;
			$data['code'] = 200;

		} else {

			$data = array(
				'user'	=> 'not found',
				'code'		=> 204,
			);
		}

		return $data;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = array();

		$user = User::first($id);
		
		if ( isset($user->email) ) {

			$user->name 	= Input::get('name');
			$user->email 	= Input::get('email');
			$user->password = Input::get('password');

			$user->save();

			$data = array(
				'user'	=> 'user successfully updated.',
				'code'		=> 200,
			);

		} else {

			$data = array(
				'user'	=> 'user not found',
				'code'		=> 205,
			);
		}

		return $data;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::first($id);

    	if( isset($user) ){

    		$user->delete();

    		$data = array(
				'user'	=> 'user successfully deleted.',
				'code'	=> 200,
			);

    	} else {

    		$data = array(
				'user'	=> 'user not found',
				'code'	=> 206,
			);
    	}

    	return $data;
	}

	
	public function login() {

		$data = array();

		//$user = User::find( array('email' => Input::get('email'), 'password' => Input::get('password') ));
                if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
                    //return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
                    $data = array(
				'message'	=> 'You are now logged in!',
				'code'		=> 200,
			);
                } else {
                    //return Redirect::to('users/login')->with('message', 'Your username/password combination was incorrect')->withInput();
                    $data = array(
				'message'	=> 'Your username/password combination was incorrect',
				'code'		=> 201,
			);
                }

//		if( isset($user->email) && isset($user->password) ){
//
//			$data = array(
//				'message'	=> 'logged in',
//				'code'		=> 200,
//			);
//
//		} else {
//
//			$data = array(
//				'message'	=> 'not logged in',
//				'code'		=> 201,
//			);
//
//		}
		
		return $data;
	}


}
