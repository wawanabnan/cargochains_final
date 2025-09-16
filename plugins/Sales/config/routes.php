<?php
declare(strict_types=1);
use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;



return static function (RouteBuilder $routes): void {
    $routes->plugin('Sales', ['path' => '/sales'], function (RouteBuilder $routes): void {
        $routes->connect('/quotations', ['controller' => 'Quotations', 'action' => 'index', '_name' => 'sales:quotations:index']);
        $routes->connect('/quotations/add', ['controller' => 'Quotations', 'action' => 'add', '_name' => 'sales:quotations:add']);
        $routes->connect('/quotations/view/{id}', ['controller' => 'Quotations', 'action' => 'view', '_name' => 'sales:quotations:view'])->setPatterns(['id'=>'\d+'])->setPass(['id']);
        $routes->connect('/quotations/edit/{id}', ['controller' => 'Quotations', 'action' => 'edit', '_name' => 'sales:quotations:edit'])->setPatterns(['id'=>'\d+'])->setPass(['id']);
        $routes->connect('/quotations/delete/{id}', ['controller' => 'Quotations', 'action' => 'delete', '_name' => 'sales:quotations:delete'])->setPatterns(['id'=>'\d+'])->setPass(['id']);
		// plugins/Sales/config/routes.php
		$routes->connect('/quotations/lines', ['controller'=>'Quotations','action'=>'lines']);  // Step-2 (final save)

		

	   $routes->fallbacks(DashedRoute::class);
    });
};
