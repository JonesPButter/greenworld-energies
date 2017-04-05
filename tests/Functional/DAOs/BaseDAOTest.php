<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 04.04.2017
 * Time: 15:56
 */

namespace Tests\Functional\DAOs;


use Slim\App;
use Source\Models\DAOs\UserDAO;
use Source\Models\DBAdapters\DatabaseAdapter;

class BaseDAOTest extends \PHPUnit_Framework_TestCase  {

    protected $dbAdapter;

    protected function init() {
        // Use the application settings
        $settings = require __DIR__ . '/../../../src/settings.php';

        // Instantiate the application
        $app = new App($settings);
        $container = $app->getContainer();
        $settings = $container->get('settings')['db'];
        $this->dbAdapter = new DatabaseAdapter($settings);
    }
}