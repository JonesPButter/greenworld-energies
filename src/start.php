<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 21.11.2016
 * Time: 10:11
 *
 * description: This is where the initialization happens.
 *              A Slim App will be created, featuring dependencies, settings and routes.
 */


// *********** Require Autoloading for making all classes available ***********
require __DIR__ . '/../vendor/autoload.php';

\Source\Models\Helpers\SessionHelper::init(); // start the session

// *********** Instantiate the app ***********
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// *********** Set up dependencies ***********
require __DIR__ . '/../src/dependencies.php';

// *********** Register middleware ***********
require __DIR__ . '/../src/middleware.php';

// *********** Register routes ***********
require __DIR__ . '/../src/routes.php';
