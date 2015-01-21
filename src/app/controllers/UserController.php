<?php


class UserController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {


        return array('message' => 'Form show.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $validator = Validator::make(Input::all(), User::$rules);
        $data = array();

        if ($validator->passes()) {

            $checkDublicate = User::first(['email' => Input::get('email')]);
            
            if ($checkDublicate instanceOf User) {
                
                $data = array(
                    'response'  => 'ERROR',
                    'message'   => 'You have already been registared.',
                    'code'      => 304,
                );

            } else {

                $user   = new User;
                $value  = Input::get('name').Input::get('email'); //.Input::get('last_name')
                $token  = $this->createToken($value);

                $user->first_name           = Input::get('name');
                //$user->last_name            = Input::get('last_name');
                $user->email                = Input::get('email');
                $user->password             = Hash::make(Input::get('password'));
                $user->phone                = Input::get('phone');
                $user->city                 = Input::get('city');
                $user->country              = Input::get('country');
                $user->status_token         = $token;
                $user->token_expire_date    = Carbon::now()->addDay();
                $user->status               = 0;

                $user->save(true);

                $id = $user->_id;
                
                $params = array(
                    'token'          => $token,
                    'id'             => $id,
                    'link'           => 'http://codewarriors.me/#/user/verify/'.$token.'/'.$id
                );
                try{
                Mail::send('emails.auth.verify', array('name'=>Input::get('name'), 'values' =>$params), function($message){
                    $message->to(Input::get('email'), Input::get('name'))->subject('[Ergo Warriors] Please Verify Your Email');
                });
                }catch(Exception $e){
                    
                }

                $data = array(
                    'response'          => 'OK',
                    'message'           => 'You have been registered successfully. Please check your mail for confirmation link.',
                    'token'             => $token,
                    'id'                => $id,
                    'code'              => 200,
                );
            }

        } else {

            // validation has failed, display error messages
            $data = array(
                'message'   => 'Validation failed not registered',
                'code'      => 400,
            );
        }

        return $data;
    }

    /**
     * For creating token.
     *
     * @param  int  $value
     * @return Response
     */
    public function createToken($value) {
        
        $token_value = $value.time();

        return $token = md5($token_value);
    }

    /**
     * Request For creating new token.
     *
     * @param  int  $email
     * @return Response
     */
    public function requestToken() {

        $checkExistance = User::first(['email' => Input::get('email')]);

        if ($checkExistance instanceOf User) {

            $token_value    = $checkExistance->first_name.$checkExistance->email;//.$checkExistance->last_name;
            $token          = $this->createToken($token_value);
            $id             = $checkExistance->_id;

            if (Input::get('sector') == "email-verification") {

                $checkExistance->status_token       = $token;
                $checkExistance->token_expire_date  = Carbon::now()->addDay();
                $checkExistance->save(true);

                $data = array(
                    'response'          => 'OK',
                    'message'           => 'New token created and mailed to your email.',
                    'verification_link' => Request::server('HTTP_HOST') . '/api/v1/auth/' . $token . '/verify/' .$id,
                    'id'                => $id,
                    'code'              => 200,
                );

            } else if (Input::get('sector') == "forgot-password") {

                if ($checkExistance->status == 0) {
                    
                    $data = array(
                        'response'  => 'ERROR',
                        'message'   => 'Your email is not verified yet. Please verify your email first.',
                        'code'      => 401,
                    );

                } else {

                    $checkExistance->status_token       = $token;
                    $checkExistance->token_expire_date  = Carbon::now()->addDay();
                    $checkExistance->save(true);

                    $data = array(
                        'response'  => 'OK',
                        'message'   => 'New token created and mailed to your email.',
                        'token'     => $token,
                        'id'        => $id,
                        'code'      => 200,
                    );
                }

            }
        } else {

            $data = array(
                'message'   => 'Email address is not currect.',
                'code'      => 400,
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
    public function show($id) {

        $data = array();

        $user = User::find($id);


        if (isset($user->email)) {

            $data               = $user;
            $data['code']       = 200;
            $data['response']   = 'OK';

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'user not found',
                'code'      => 400,
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
    public function edit($id) {

        $data = array();

        $user = User::find($id);


        if (isset($user->email)) {

            $data               = $user;
            $data['code']       = 200;
            $data['response']   = 'OK';

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'user not found',
                'code'      => 400,
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
    public function update($id) {

        $data = array();

        $user = User::first($id);

        if (isset($user->email)) {

            $user->first_name   = Input::get('first_name');
//            //$user->last_name    = Input::get('last_name');
//            $user->email        = Input::get('email');
//            $user->password     = Hash::make(Input::get('password'));
//            $user->phone        = Input::get('phone');
//            $user->city         = Input::get('city');
//            $user->country      = Input::get('country');

            $user->save(true);

            $data = array(
                'response'  => 'OK',
                'message'   => 'user successfully updated.',
                'code'      => 200,
            );

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'user not found',
                'code'      => 400,
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
    public function destroy($id) {

        $user = User::first($id);

        if (isset($user)) {

            $user->delete();

            $data = array(
                'response'  => 'OK',
                'message'   => 'user successfully deleted.',
                'code'      => 200,
            );

        } else {

            $data = array(
                'response'  => 'ERROR',
                'message'   => 'user not found',
                'code'      => 400,
            );
        }

        return $data;
    }

    public function login() {
        $users = array('email' => Input::get('email'), 'password' => Input::get('password'));
        $data = array();        
        if (Auth::attempt($users)) {
            $user = User::first(array('email' => $users['email']));
            $person = array(
                'name'      => $user->first_name,//." ".$user->last_name,
                'email'     => $user->email,
                'id'        => $user->_id,
            );
            
            $data = array(
                'response'  => 'OK',
                'message'   => $person,
                'code'      => 200,
            );

        } else {
            
            $data = array(
                'response'  => 'ERROR',
                'message'   => 'Your username/password combination was incorrect',
                'code'      => 400,
            );
        }
        return $data;
    }

    /**
     * For verify user.
     *
     * @param  int  $id
     * @return Response
     */
    public function verifyUser($token, $id) {

        $data           = array();
        //$id             = Crypt::decrypt($id);
        $checkExistance = User::first(['_id' => $id, 'status_token' => $token]);

        if ($checkExistance instanceOf User) {

            if (Carbon::now() <= $checkExistance->token_expire_date["date"]) {

                if ($checkExistance->status == 0) {

                    $checkExistance->status = 1;
                    $checkExistance->save(true);

                    $data = array(
                        'response'  => 'OK',
                        'message'   => 'Email successfully verified',
                        'code'      => 200,
                    );

                } else {
                    $data = array(
                        'response'  => 'ERROR',
                        'message'   => 'Your email is already verified.',
                        'code'      => 203,
                    );
                }

            } else {

                $data = array(
                    'response'  => 'ERROR',
                    'message'   => 'Email validation token expired. You need to request for a new one',
                    'code'      => 304,
                );
            }
        }else{
           $data = array(
                    'response'  => 'ERROR',
                    'message'   => 'Something wrong with your verification. try again later.',
                    'code'      => 304,
                );
        }

        return $data;
    }

    /**
     * For check userExistance for forgot password.
     *
     * @param  int  $id
     * @return Response
     */
    public function forgotPassword() {

        $data   = array();
        //$id     = Crypt::decrypt(Input::get('id'));
        $token  = Input::get('token');
        
        $checkExistance = User::first(['_id' => $id, 'status_token' => $token]);

        if ($checkExistance instanceOf User) {

            if (Carbon::now() <= $checkExistance->token_expire_date["date"]) {

                $checkExistance->password = Hash::make(Input::get('password'));
                $checkExistance->save(true);

                $data = array(
                    'response'  => 'OK',
                    'message'   => 'Password changed successfully.',
                    'code'      => 200,
                );

            } else {

                $data = array(
                    'response'  => 'ERROR',
                    'message'   => 'Forgot password token expired. You need to request for a new one',
                    'code'      => 403,
                );
            }

        } else {
            
            $data = array(
                'response'  => 'ERROR',
                'message'   => 'Not a valid user.',
                'code'      => 401,
            );

        }

        return $data;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function logout() {

        $data = array();

        if (Auth::logout()) {
            
            $data = array(
                'response'  => 'OK',
                'message'   => 'You have been successfully logged out.',
                'code'      => 200,
            );

        } else {
            
            $data = array(
                'response'  => 'ERROR',
                'message'   => 'Problem occured when trying to logout, pleaes try again.',
                'code'      => 400,
            );
        }
        return $data;
    }
    
    /**
     * Function for sending mail.
     *
     * @return Response
     */

}
