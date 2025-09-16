<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
 * So you can use `$this` to reference the application class instance
 * if required.
 */
return function (RouteBuilder $routes): void {
    
	 

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
		$builder->connect('/pages/*', 'Pages::display');
		
		// Auth routes (CakeDC Users)
		$builder->connect('/login',    ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'login']);
		$builder->connect('/logout',   ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'logout']);
		$builder->connect('/register', ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'register']); // opsional


		$builder->fallbacks();
    });
	
	$routes->prefix('Admin', function (RouteBuilder $builder): void {
        $builder->connect('/users', ['controller' => 'Users', 'action' => 'index']);
        $builder->connect('/users/add', ['controller' => 'Users', 'action' => 'add']);
        $builder->connect('/users/edit/:id', ['controller' => 'Users', 'action' => 'edit'])
            ->setPass(['id'])->setPatterns(['id'=>'\d+']);
        $builder->connect('/users/view/:id', ['controller' => 'Users', 'action' => 'view'])
            ->setPass(['id'])->setPatterns(['id'=>'\d+']);

        $builder->connect('/groups', ['controller' => 'Groups', 'action' => 'index']);
        $builder->connect('/groups/add', ['controller' => 'Groups', 'action' => 'add']);
        $builder->connect('/groups/edit/:id', ['controller' => 'Groups', 'action' => 'edit'])
            ->setPass(['id'])->setPatterns(['id'=>'\d+']);
        $builder->connect('/groups/view/:id', ['controller' => 'Groups', 'action' => 'view'])
            ->setPass(['id'])->setPatterns(['id'=>'\d+']);
			


        $builder->fallbacks();
    });


};
