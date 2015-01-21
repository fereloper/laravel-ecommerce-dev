<?php

/*
 * Include all routes file
 * Comment out for UnitTest. After testing it will be  uncomment
 */
//foreach (File::allFiles(__DIR__.'/routes') as $partial) {
//    include_once $partial->getPathname();
//}


Route::get('/', function() {
  return View::make('index');
});

/*
 * Please use all routes as like as this route. So that we can change the route from single point
 */
// Route::get('user/create', ['as' => 'login', 'uses' => 'LoginController@login']);

Route::group(array('prefix' => 'api/v1'), function() {
  Route::resource('user', 'UserController');

  // custom method for user login and registration
  Route::post('user/login', 'UserController@login');
  Route::get('auth/{token}/verify/{id}', 'UserController@verifyUser');
  Route::post('auth/request-token', 'UserController@requestToken');
  Route::post('auth/change-password', 'UserController@forgotPassword');
  Route::post('city/get-city', 'CountryController@getCity');
  Route::get('country/get-country', 'CountryController@getCountry');
});
