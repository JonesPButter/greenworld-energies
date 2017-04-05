<?php
// "use"-imports for better readability
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Source\Controller\HomeController;
use Source\Controller\Unauthorized\LoginController;
use Source\Controller\Unauthorized\PriceCalculationController;
use Source\Controller\Unauthorized\RegistrationController;
use Source\Models\Auth\Auth;
use Source\Models\DAOs\UserDAO;
use Source\Models\DBAdapters\DatabaseAdapter;

/*
 * DIC configuration
 * this container handles the dependency injection and has therefore knowledge about all
 * dependencies in this project.
 */
$container = $app->getContainer();

// ********************************* External Libraries ************************************

/*
 * Monolog-Logger - A simple Logging - Framework. log messages will be written in /logs/app.log
 */
$container['logger'] = function (ContainerInterface $container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    $logger->pushProcessor(new UidProcessor());
    return $logger;
};

/*
 * Twig-View - A Framework for creating the frontend
 */
$container['view'] = function (ContainerInterface $container) {
    $settings = $container->get('settings')['renderer'];
    $view = new Twig($settings['template_paths'], ['cache' => false]);

    // add an Extension, so that we can assign the router within twig
    $extension = new TwigExtension($container->get("router"),$container->get("request")->getUri());
    $view->addExtension($extension);

    // adding some Environment variables, so that we can assign them in the views.
    $view->getEnvironment()->addGlobal('auth', [
        'isUserLoggedIn' => $container->get("auth")->isUserLoggedIn(),
        'user' => $container->get("auth")->getUser(),
    ]);
    $view->getEnvironment()->addGlobal('flash', $container->get('flash'));
    return $view;
};

/*
 * Flash - A Framework for showing the user flash-messages
 */
$container['flash'] = function () {
    return new Messages();
};


// *********************************** Internal System ******************************************

// *** Utilities ***

/*
 * DatabaseAdapter - An implementation for creating a connection with the database.
 */
$container['dbAdapter'] = function (ContainerInterface $container) {
    $dbAdapter = null;
    $settings = $container->get('settings')['db'];
    try{
        $dbAdapter = new DatabaseAdapter($settings);
    } catch(\PDOException $e){
        require __DIR__ . '/../src/views/errorPage.twig';
        die();
    }
    return $dbAdapter;
};


/*
 * Auth - Validates user and creates the Session if a user is valid.
 */
$container['auth'] = function (ContainerInterface $container) {
    $userDAO = $container->get('userDAO');
    return new Auth($userDAO);
};

// *** Controllers ***
$container['HomeController'] = function (ContainerInterface $container) {
    return new HomeController($container->get('view'),$container->get('router'));
};
$container['LoginController'] = function (ContainerInterface $container) {
    return new LoginController($container->get('view'),$container->get('router'));
};
$container['RegistrationController'] = function (ContainerInterface $container) {
    return new RegistrationController($container->get('view'),$container->get('router'));
};
$container['PriceCalculationController'] = function (ContainerInterface $container) {
    return new PriceCalculationController($container->get('view'),$container->get('router'));
};

// *** Data Access Objects (DAOs)***

/*
 * UserDAO - The DAO that handles the database requests.
 */
$container['userDAO'] = function (ContainerInterface $container) {
    $dbAdapter = $container->get('dbAdapter');
    return new UserDAO($dbAdapter);
};



