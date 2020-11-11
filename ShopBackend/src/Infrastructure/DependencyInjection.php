<?php
use Psr\Container\ContainerInterface;
use DI\Container;

//require 'src/API/ClientAPIController.php';
require 'src/Repository/IClientsRepo.php';
require 'src/Repository/ClientsRepo.php';
require 'src/ApplicationServices/ClientService.php';

$container = new Container();

$container->set(IClientsRepo::class, function (ContainerInterface $container) {
    return new ClientsRepo();
});

$container->set(IClientService::class, function (ContainerInterface $container) {
    $repo = $container->get(IClientsRepo::class);
    return new ClientService($repo);
});

$container->set(ClientAPIController::class, function (ContainerInterface $container) {
    $service = $container->get(IClientService::class);
    return new ClientAPIController($service);
});