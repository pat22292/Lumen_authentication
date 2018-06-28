<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix'=>'oauth'], function($api) {
        $api->post('token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
        $api->delete('clients/{client_id}', '\Laravel\Passport\Http\Controllers\ClientController@destroy');
    });

    $api->group(['namespace'=>'App\Http\Controllers','middleware'=>['cors']], function($api){
        //Controller Routes
        $api->group(['middleware'=>['auth:api']], function() use ($api) {
            //get user
        $api->get('users', 'UserController@show');
        $api->post('verify', 'AuthController@verify');
        $api->get('transactions', 'TransactionController@show');
        $api->get('user/{id}', 'UserController@showById');
        $api->get('logout', 'AuthController@logout');
        });
       
        $api->post('login', 'AuthController@login');
        $api->post('register', 'UserController@register');     
        
    });  

    
});

