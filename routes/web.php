<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/auth/login', 'auth\AuthController@login');

/**
 * Routes that need authentication
 */
$router->group(['middleware' => 'auth'], function ($router) {
    // A checker if user is logged_in
    $router->get('/auth/check-token', 'auth\AuthController@checkToken');
    // User
    $router->group(['prefix' => 'users'], function ($router) {
        $router->get('/', 'user\UserController@getList');
        $router->get('/{id}', 'user\UserController@get');
        $router->post('/create', 'user\UserController@store');
        $router->put('/{id}', 'user\UserController@update');
        $router->delete('/{id}', 'user\UserController@delete');

        $router->get('/{id}/pages', 'user\UserController@getPages');
    });
    // Page
    $router->group(['prefix' => 'pages'], function ($router) {
        $router->get('/', 'page\PagesController@getList');
        $router->post('/', 'page\PagesController@store');
        $router->get('/', 'page\PagesController@getList');
        $router->get('/', 'page\PagesController@getList');
    });
});
