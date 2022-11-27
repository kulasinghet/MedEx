<?php

require_once '../vendor/autoload.php';

use app\controllers\Lab\LabAuthController;
use app\core\Application;
use app\controllers\AuthController;
use app\controllers\Delivery\DeliveryAuthController;
use app\controllers\employee\EmployeeAuthController;
use app\controllers\LoginAuthController;
use app\controllers\SiteController;


$app = new Application();

// Global Routes
$app -> router -> get('', [SiteController::class, 'home']);
$app -> router -> get('/', [SiteController::class, 'home']);
$app -> router -> get('/404', [SiteController::class, '_404']);


// Delivery Routes
$app -> router -> get('/delivery/login', [LoginAuthController::class, 'deliveryLogin']);
$app -> router -> post('/delivery/login', [LoginAuthController::class, 'deliveryLogin']);
$app -> router -> get('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app -> router -> post('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);

// Lab Routes
$app -> router -> get('/lab/login', [LoginAuthController::class, 'labLogin']);
$app -> router -> post('/lab/login', [LoginAuthController::class, 'labLogin']);
$app -> router -> get('/lab/register', [LabAuthController::class, 'labRegister']);
$app -> router -> post('/lab/register', [LabAuthController::class, 'labRegister']);

// Employee Routes
$app -> router -> get('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app -> router -> post('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app -> router -> get('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);
$app -> router -> post('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);

$app->run();
