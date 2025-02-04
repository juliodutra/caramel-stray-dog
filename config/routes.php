use Cake\Routing\Route\DashedRoute;

return function($routes) {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function($routes) {
        $routes->connect('/', ['controller' => 'Donations', 'action' => 'index']);
        
        $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
        $routes->connect('/register', ['controller' => 'Users', 'action' => 'register']);

        $routes->connect('/donations', ['controller' => 'Donations', 'action' => 'index']);
        $routes->connect('/donations/add', ['controller' => 'Donations', 'action' => 'add']);
        $routes->connect('/donations/pickup/{id}', 
            ['controller' => 'Donations', 'action' => 'pickup'])
            ->setPass(['id']);
    });
};