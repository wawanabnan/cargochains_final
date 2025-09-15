<?php
declare(strict_types=1);

use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return static function (RouteBuilder $routes): void {
    $routes->plugin('Partners', ['path' => '/partners'], function (RouteBuilder $routes): void {
        $routes->connect('/', [
            'controller' => 'Partners',
            'action' => 'index',
            '_name' => 'partners:index',
        ]);
        $routes->connect('/add', [
            'controller' => 'Partners',
            'action' => 'add',
            '_name' => 'partners:add',
        ]);
		
		
		
		
        $routes->fallbacks(DashedRoute::class);
    });
};
