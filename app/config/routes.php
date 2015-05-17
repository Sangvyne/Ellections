<?php
/**
 * Created by PhpStorm.
 * User: zen
 * Date: 2/28/2015
 * Time: 10:40 AM
 */

// Create the router
$router = new \Phalcon\Mvc\Router();

//Define a route
$router->addGet(
    "/login",
    array(
        "controller" => "users",
        "action"     => "index",
    )
);

$router->add(
    "/about",
    array(
        "controller" => "index",
        "action"     => "about",
    )
);

$router->add(
    "/whykids",
    array(
        "controller" => "index",
        "action"     => "why",
    )
);

$router->add(
    "/services",
    array(
        "controller" => "index",
        "action"     => "services",
    )
);

$router->handle();
