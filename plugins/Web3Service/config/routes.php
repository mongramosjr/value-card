<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Web3Service',
    ['path' => '/web3-service'],
    function (RouteBuilder $routes) {
        $routes->setExtensions(['json', 'xml']);
        $routes->fallbacks(DashedRoute::class);
    }
);
