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

/** @var Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/api/login', 'TokenController@generate');

$router->group(['prefix' => 'api', 'middleware' => 'authenticator'], function () use ($router) {

    $router->group(['prefix' => 'series'], function () use ($router) {

        $router->get('', 'SeriesController@index');
        $router->get('{id}', 'SeriesController@show');
        $router->post('', 'SeriesController@store');
        $router->put('{id}', 'SeriesController@update');
        $router->delete('{id}', 'SeriesController@destroy');
        $router->get('{serieId}/episodes', 'EpisodesController@bySerie');
    });
    
    $router->group(['prefix' => 'episodes'], function () use ($router) {

        $router->get('', 'EpisodesController@index');
        $router->get('{id}', 'EpisodesController@show');
        $router->post('', 'EpisodesController@store');
        $router->put('{id}', 'EpisodesController@update');
        $router->delete('{id}', 'EpisodesController@destroy');
    });

});
