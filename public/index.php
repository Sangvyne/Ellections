<?php
/**
 * Created by PhpStorm.
 * User: zen
 * Date: 2/28/2015
 * Time: 9:46 AM
 */ 
try {

    //Read the configuration
    $config = new Phalcon\Config\Adapter\Ini('../app/config/config.ini');

    // App init
    require __DIR__ . "/../app/bootstrap.php";
    $bootstrap = new Bootstrap($config);

    //Handle the request
    $application = new \Phalcon\Mvc\Application($bootstrap->run());
    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}