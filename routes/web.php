<?php

use Illuminate\Http\Request; 
use App\Http\Controllers\ProvinceController;

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

$router->group(['namespace' => 'Search', 'prefix' => 'search'], function() use ($router) {
    $router->get('/provinces', 'ProvinceController@show');
    $router->get('/cities', 'CityController@show');
});