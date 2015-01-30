<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends MongoLid implements UserInterface, RemindableInterface {

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
        'name'                  => 'required|min:2',
        'email'                 => 'required|email',
        'password'              => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12',
        'mobile'                => 'required|numeric|between:10,11',
    );

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->_id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        
    }

    public function getRememberTokenName() {
        
    }

    public function setRememberToken($value) {
        
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

}
