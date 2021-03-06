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

use App\Models\Carrier;

$router->get('/', function () use ($router) {
    return 'Go to /api/shipments to test API!';
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('shipments', ['uses' => 'ShipmentController@index']);
});
