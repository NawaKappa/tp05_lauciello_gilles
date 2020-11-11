<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;


include(dirname(__DIR__).'/Models/Client.php');

include('ClientAPIController.php');

$app->group('/api', function(RouteCollectorProxy $group) {
    $group->group('/client', function(RouteCollectorProxy $group) {
        $group->post('/login', \ClientAPIController::class . ':login');
        $group->post('/signin', \ClientAPIController::class . ':signin');
        $group->get('/auth', \ClientAPIController::class . ':CheckClientToken');
        $group->get('/info', \ClientAPIController::class . ':getUserByJWT');

    });
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});