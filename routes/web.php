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

// CRUD tabla products (productos)
$router->get('/api/products', 'ProductController@records');
$router->get('/api/products/{id}', 'ProductController@record');
$router->post('/api/products', 'ProductController@store');
$router->delete('/api/products/{id}', 'ProductController@destroy');

// CRUD tabla advisors (Asesores)
$router->get('/api/advisors', 'AdvisorController@records');
$router->get('/api/advisors/{id}', 'AdvisorController@record');
$router->post('/api/advisors', 'AdvisorController@store');
$router->delete('/api/advisors/{id}', 'AdvisorController@destroy');

// CRUD tabla customers (Clientes)
$router->get('/api/customers', 'CustomerController@records');
$router->get('/api/customers/{id}', 'CustomerController@record');
$router->post('/api/customers', 'CustomerController@store');
$router->delete('/api/customers/{id}', 'CustomerController@destroy');

// CRUD tabla orders (Pedidos)
$router->get('/api/orders', 'OrderController@records');
$router->get('/api/orders/{id}', 'OrderController@record');
$router->post('/api/orders', 'OrderController@store');
$router->delete('/api/orders/{id}', 'OrderController@destroy');


$router->get('/orders', 'OrderController@index');

