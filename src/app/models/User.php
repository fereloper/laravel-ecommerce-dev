<?php
use Illuminate\Auth\UserInterface;

class User extends MongoLid implements UserInterface {

    /**
     * The database collection used by the model.
     *
     * @var string
     */
    protected $collection = 'users';
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');
    
    
    public static $rules = array(
        'first_name'=>'required|min:2',
        'last_name'=>'required|min:2',
        'email'=>'required|email',
        'password'=>'required|alpha_num|between:6,12|confirmed',
        'password_confirmation'=>'required|alpha_num|between:6,12'
        );
    

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->_id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken() {
        
    }

    public function getRememberTokenName() {
        
    }

    public function setRememberToken($value) {
        
    }

}
