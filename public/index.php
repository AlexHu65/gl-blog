<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Router;
use Phalcon\Loader;


define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('C_PATH_LAYOUTS', BASE_PATH . '/app/views/layouts/');
define('C_PATH_IMAGES', BASE_PATH . '/public/img');


try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

    $di->set(
        'view',
        function () {
            $view = new View();
            $view->setViewsDir(APP_PATH . '/views/');
            return $view;
        }
    );

    // Setup the database service
    $di->set(
        'db',
        function () {
            return new DbAdapter(
                [
                    'host' => '127.0.0.1',
                    'username' => 'root',
                    'password' => '',
                    'dbname' => 'glblog',
                ]
            );
        }
    );

    $loader = new Loader();


    $loader->registerDirs([
        '../app/controllers/',
        '../app/models/',
        '../app/library/',
        '../app/js'
    ])->register();


} catch (\Exception $e) {

    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
