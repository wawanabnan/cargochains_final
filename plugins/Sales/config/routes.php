<?php
use Cake\Routing\Route\DashedRoute;

return static function ($routes) {
    $routes->plugin('Sales', ['path' => '/sales'], function ($routes) {
        $routes->setRouteClass(DashedRoute::class);
        $routes->connect('/', ['controller' => 'SalesQuotations', 'action' => 'index']);
        $routes->fallbacks(DashedRoute::class);
    });
};
