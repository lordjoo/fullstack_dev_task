<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;

$router = new Router();

$router->addRoute('GET', '/categories', 'CategoryController@getCategories');
$router->addRoute('GET', '/categories/{id}', 'CategoryController@getCategoryById');
$router->addRoute('GET','/categories/{id}/courses','CategoryController@getCoursesByCategoryId');
$router->addRoute('GET', '/courses', 'CourseController@getCourses');
$router->addRoute('GET', '/courses/{id}', 'CourseController@getCourseById');

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');
$requestMethod = $_SERVER['REQUEST_METHOD'];
$router->handleRequest($requestUri, $requestMethod);
