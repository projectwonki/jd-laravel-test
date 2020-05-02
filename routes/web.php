<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/differentiation','ExampleController@calculateDifferentiate');
$router->get('/string-reduce','ExampleController@stringReduce');
$router->get('/tcpdf','ExampleController@getTcpdf');
$router->post('/convert-images-to-pdf','ExampleController@postTcpdf');
$router->get('/testing-tcpdf','ExampleController@testingTcpdf');
$router->get('/product','ExampleController@getProduct');
$router->post('add-to-cart','ExampleController@addToCart');
$router->get('/cart','ExampleController@getCart');
