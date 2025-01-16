<?php
use Core\Route;

// Initialize Route
$routes = new Route();

$routes->get("voiture", 'car/update/1');

// Return all routes
return $routes;
