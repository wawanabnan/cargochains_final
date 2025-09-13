<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return static function (RouteBuilder $routes): void {

    // === SHIPMENTS lowercase ===
    $routes->connect(
        '/shipments',
        ['plugin' => 'Shipments', 'controller' => 'Shipments', 'action' => 'index', '_name' => 'shipments:index']
    );
    $routes->connect(
        '/shipments/add',
        ['plugin' => 'Shipments', 'controller' => 'Shipments', 'action' => 'add', '_name' => 'shipments:add']
    );
    $routes->connect(
        '/shipments/edit/{id}',
        ['plugin' => 'Shipments', 'controller' => 'Shipments', 'action' => 'edit', '_name' => 'shipments:edit']
    )->setPatterns(['id' => '\d+'])->setPass(['id']);

    // === redirect uppercase ke lowercase (opsional) ===
  //  $routes->redirect('/Shipments', '/shipments', ['status' => 301]);
    //$routes->redirect('/Shipments/*', '/shipments/*', ['status' => 301]);

    // === fallback app ===
    $routes->scope('/', function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    });
};
