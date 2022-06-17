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
    // Default source
    $provinceController = 'ProvinceController@show';
    $cityController = 'CityController@show';
    $source = env('LOCATION_SOURCE');

    // Swapable location source
    switch($source)
    {
        case 'rajaongkir':
            $provinceController = 'ROProvinceController@show';
            $cityController = 'ROCityController@show';
            break;
        case 'wano':
            // Waiting Mr. Momo open their land
            break;
        default:
            // use local database as default
    }

    $router->get('/provinces', ['middleware' => 'auth', 'uses' => $provinceController]);
    $router->get('/cities', ['middleware' => 'auth', 'uses' => $cityController]);
});