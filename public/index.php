<?php

require_once '../vendor/autoload.php';
use app\base\Application;
use app\controllers\AuthController;
use app\controllers\Delivery\DeliveryAuthController;
use app\controllers\employee\EmployeeAuthController;
use app\controllers\LoginAuthController;
use app\controllers\SiteController;


$app = new Application();

//$app -> router->get('/', function() use ($app) {
//    $app->render('index.php');
//});

// Global Routes
$app -> router->get('/', [SiteController::class, 'home']);
$app -> router -> get('/404', [SiteController::class, '_404']);


// Delivery Routes
$app -> router -> get('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app -> router -> post('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app -> router -> get('/delivery/login', [DeliveryAuthController::class, 'deliveryLogin']);
$app -> router -> post('/delivery/login', [DeliveryAuthController::class, 'deliveryLogin']);

// Lab Routes
$app -> router -> get('/lab/login', [AuthController::class, 'labLogin']);
$app -> router -> post('/lab/login', [AuthController::class, 'labLogin']);

// Employee Routes
$app -> router -> get('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app -> router -> post('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app -> router -> get('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);
$app -> router -> post('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);

// Admin Routes

$app->run();
