<?php
use Core\Route;

// Initialize Route
$routes = new Route();

$routes->get("voiture/:id", 'car/update/:id');

// Return all routes
return $routes;
