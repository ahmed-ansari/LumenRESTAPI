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

$router->get('/key', function () use ($router) {
    return str_random(32);
});

// $router->get('/test', ['uses' => 'UserController@create']);

$router->group(['prefix' => 'api'], function () use ($router) {

$router->get('/test', 'UserController@create');
$router->get('/users', 'UserController@list');
$router->get('/user/{id}', 'UserController@show');

$router->post('/complaint','ComplaintController@create');

$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');



// $router->post()
});
