<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\ORM\TableRegistry;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;

use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Policy\OrmResolver;

use Psr\Http\Message\ServerRequestInterface;

class Application extends BaseApplication
    implements AuthenticationServiceProviderInterface,
               AuthorizationServiceProviderInterface
{
    public function bootstrap(): void
    {
        parent::bootstrap();

        // Plugins
      //  $this->addPlugin('Authentication');
      //  $this->addPlugin('Authorization');
       // $this->addPlugin('CakeDC/Users');

        // (opsional) konfigurasi CakeDC Users
        if (file_exists(CONFIG . 'users.php')) {
            Configure::load('users', 'default', false);
        }

        // Inject relasi Users <-> Groups (karena Groups buatan App)
        $locator = TableRegistry::getTableLocator();
        /** @var \CakeDC\Users\Model\Table\UsersTable $Users */
        $Users = $locator->get('CakeDC/Users.Users');

        if (!$Users->hasAssociation('Groups')) {
            $Users->belongsToMany('Groups', [
                'className'        => 'App.Groups',
                'through'          => 'App.UsersGroups',
                'foreignKey'       => 'user_id',     // users_groups.user_id (UUID)
                'targetForeignKey' => 'group_id',    // users_groups.group_id (int)
                'joinTable'        => 'users_groups',
            ]);
        }
    }

    public function services(ContainerInterface $container): void
    {
        parent::services($container);
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        return $middlewareQueue
            ->add(new RoutingMiddleware($this))
            ->add(new AuthenticationMiddleware($this))
            ->add(new AuthorizationMiddleware($this, [
                // penting: jangan paksa tiap request harus authorize()/skipAuthorization()
                'requireAuthorizationCheck' => false,
                'unauthorizedHandler' => [
                    'className'  => 'Authorization.Redirect',
                    'url'        => '/login',
                    'queryParam' => 'redirect',
                    'exceptions' => [
                        \Authorization\Exception\MissingIdentityException::class,
                    ],
                ],
            ]));
    }

    // Authentication (login)
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationService
    {
        $service = new AuthenticationService([
            'unauthenticatedRedirect' => '/login',
            'queryParam' => 'redirect',
        ]);

        // Identify user by email+password
        $service->loadIdentifier('Authentication.Password', [
            'fields' => ['username' => 'email', 'password' => 'password'],
        ]);

        // Authenticators
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'loginUrl' => '/login',
            'fields'   => ['username' => 'email', 'password' => 'password'],
        ]);

        return $service;
    }

    // Authorization (policies)
    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        return new AuthorizationService(new OrmResolver());
    }
}
