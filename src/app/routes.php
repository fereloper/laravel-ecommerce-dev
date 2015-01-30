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

//dd($mongo);die();
App::singleton('storage',function(){
    $mongodb = array(
            'host'     => '127.0.0.1',
            'port'     => 27017,
            'database' => 'mongolid',
            'username'     => '',
            'password'     => '',
        );
    $storage = new OAuth2\Storage\Mongo($mongodb);
    return $storage;
});
App::singleton('oauth2', function() {
  
    $storage = App::make('storage');
    $storage->setClientDetails("TestClient", "TestSecret");


    $server = new OAuth2\Server($storage);


    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
    $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));
    $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

    return $server;
});

Route::group(array('prefix' => 'api/v1'), function() {

    Route::resource('user', 'UserController');
    Route::post('user/test', 'UserController@test');
    // custom method for user login and registration
    Route::post('user/login', 'UserController@login');

    Route::get('auth/{token}/verify/{id}', 'UserController@verifyUser');

    Route::post('auth/request-token', 'UserController@requestToken');

    Route::post('auth/change-password', 'UserController@forgotPassword');

    Route::post('city/get-city', 'LocationController@getCity');

    Route::get('country/get-country', 'LocationController@getCountry');

    Route::get('auth/logout', 'UserController@logout');

    Route::get('auth/islogged', 'UserController@isLogged');
    
    /*
     * Cart route sector.....
     */
    Route::resource('cart', 'CartController');  
    Route::post('cart/add-to-wishlist', 'CartController@addToWishlist');
    Route::get('cart/wishlist', 'CartController@showWishlistProducts');
    Route::post('cart/delete-wishlist', 'CartController@deleteWishlistProduct');
    
    /*
     * Order Controller sector
     */
    Route::resource('order', 'OrderController');
    Route::post('order/show-order', 'OrderController@showUserOrder');
    Route::post('order/change-status', 'OrderController@changeStatus');
    
    Route::post('oauth/token', function() {

        $bridgedRequest = OAuth2\HttpFoundationBridge\Request::createFromRequest(Request::instance());
        $bridgedResponse = new OAuth2\HttpFoundationBridge\Response();

        $bridgedResponse = App::make('oauth2')->handleTokenRequest($bridgedRequest, $bridgedResponse);

        return $bridgedResponse;
    });

    Route::get('private', function() {
        $bridgedRequest = OAuth2\HttpFoundationBridge\Request::createFromRequest(Request::instance());
        $bridgedResponse = new OAuth2\HttpFoundationBridge\Response();


        if (App::make('oauth2')->verifyResourceRequest($bridgedRequest, $bridgedResponse)) {

            $token = App::make('oauth2')->getAccessTokenData($bridgedRequest);
            var_dump($token);
            die();

            return Response::json(array(
                        'private' => 'stuff',
                        'user_id' => $token['user_id'],
                        'client' => $token['client_id'],
                        'expires' => $token['expires'],
            ));
        } else {
            return Response::json(array(
                        'error' => 'Unauthorized'
                            ), $bridgedResponse->getStatusCode());
        }
    });
  /*
   * Product CRUD
   */
  Route::resource('product','ProductController');
  
  /*
   * Category
   */
  Route::get('category','ProductController@getCategory');
    
 /**
  * Product listing routes 
  */
  Route::get('products/category/{category_id}/sub/{sub_category_id}', 'ProductController@getProductBySubCategory');
  Route::get('products/category/{category_id}', 'ProductController@getProductByCategory');
//     Route::get('product/{product_id}/{product_name?}', 'ProductController@getProductById');
  //Product update api (Image upload)
     Route::post('product/upload','ProductController@upload');
     Route::get('create-db','LocationController@createDB');
    
});
