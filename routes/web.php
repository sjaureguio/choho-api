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
    // return $router->app->version();
    return response()->json([
        'success' => true,
        'message' => 'Not found'
    ], 200);
});

// CRUD tabla product_types (Tipos de producto)
$router->get('/api/product-types', 'ProductTypeController@records');
$router->get('/api/product-types/{id}', 'ProductTypeController@record');
$router->post('/api/product-types', 'ProductTypeController@store');
$router->delete('/api/product-types/{id}', 'ProductTypeController@destroy');

