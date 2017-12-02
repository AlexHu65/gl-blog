<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->controllersDir,
    $config->application->modelsDir])->register();


//Alex: Add namespaces according phalcon doc.
$loader->registerNamespaces([
    'Blog\Models' => dirname(__DIR__) . '/models',
    'Blog\Controllers' => dirname(__DIR__) . '/controllers',
    'Blog\Views\Auth' => dirname(__DIR__) . '/views/',
    'Blog\Library' => dirname(__DIR__) . '/library'
])->register();
