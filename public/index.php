<?php

require_once '../vendor/autoload.php';

use app\controllers\DashboardController;
use app\controllers\delivery\DeliveryContactusController;
use app\controllers\delivery\DeliveryDashboardController;
use app\controllers\lab\LabAuthController;
use app\controllers\lab\LabContactusController;
use app\controllers\lab\LabDashboardController;
use app\controllers\pharmacy\PharmacyAuthController;
use app\controllers\pharmacy\PharmacyDashboardController;
use app\controllers\pharmacy\PharmacyOrderMedicineController;
use app\controllers\supplier\SupplierAuthController;
use app\core\Application;
use app\controllers\AuthController;
use app\controllers\delivery\DeliveryAuthController;
use app\controllers\employee\EmployeeAuthController;
use app\controllers\LoginAuthController;
use app\controllers\SiteController;


$app = new Application();

session_start();

// Global Routes
$app -> router -> get('', [SiteController::class, 'home']);
$app -> router -> get('/', [SiteController::class, 'home']);
$app -> router -> get('/dashboard', [DashboardController::class, 'redirectDashboard']);
$app -> router -> get('/404', [SiteController::class, '_404']);
$app -> router -> get('/logout', [SiteController::class, 'logout']);

// delivery Routes
$app -> router -> get('/delivery/login', [LoginAuthController::class, 'deliveryLogin']);
$app -> router -> post('/delivery/login', [LoginAuthController::class, 'deliveryLogin']);
$app -> router -> get('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app -> router -> post('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app -> router -> get('/delivery/orders', [DeliveryDashboardController::class, 'orders']);
$app -> router -> post('/delivery/orders', [DeliveryDashboardController::class, 'orders']);
$app -> router -> get('/delivery/history', [DeliveryDashboardController::class, 'history']);
$app -> router -> post('/delivery/history', [DeliveryDashboardController::class, 'history']);
$app -> router -> get('/delivery/contact_us', [DeliveryDashboardController::class, 'contactUs']);
$app -> router -> post('/delivery/contact_us', [DeliveryDashboardController::class, 'contactUs']);
$app -> router -> post('/delivery/contact_us', [DeliveryContactusController::class, 'delivery_contact_us']);
// Lab Routes
$app -> router -> get('/lab/login', [LoginAuthController::class, 'labLogin']);
$app -> router -> post('/lab/login', [LoginAuthController::class, 'labLogin']);
$app -> router -> get('/lab/register', [LabAuthController::class, 'labRegister']);
$app -> router -> post('/lab/register', [LabAuthController::class, 'labRegister']);
$app -> router -> get('/lab/contact-us', [LabDashboardController::class, 'contactus']);
$app -> router -> post('/lab/contact-us', [LabContactusController::class, 'lab_contact_us']);

// Employee Routes
$app -> router -> get('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app -> router -> post('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app -> router -> get('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);
$app -> router -> post('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);

// pharmacy Routes
$app -> router -> get('/pharmacy/login', [LoginAuthController::class, 'pharmacyLogin']);
$app -> router -> post('/pharmacy/login', [LoginAuthController::class, 'pharmacyLogin']);
$app -> router -> get('/pharmacy/register', [PharmacyAuthController::class, 'pharmacyRegister']);
$app -> router -> post('/pharmacy/register', [PharmacyAuthController::class, 'pharmacyRegister']);
$app -> router -> get('/pharmacy/sell-medicine', [PharmacyDashboardController::class, 'sellMedicine']);
$app -> router -> post('/pharmacy/sell-medicine', [PharmacyDashboardController::class, 'sellMedicine']);
$app -> router -> get('/pharmacy/order-medicine', [PharmacyDashboardController::class, 'orderMedicine']);
$app -> router -> post('/pharmacy/order-medicine', [PharmacyOrderMedicineController::class, 'createOrder']);
$app -> router -> get('/pharmacy/orders', [PharmacyDashboardController::class, 'orders']);
$app -> router -> post('/pharmacy/orders', [PharmacyDashboardController::class, 'orders']);
$app -> router -> get('/pharmacy/inventory', [PharmacyDashboardController::class, 'inventory']);
$app -> router -> post('/pharmacy/inventory', [PharmacyDashboardController::class, 'inventory']);
$app -> router -> get('/pharmacy/contact-us', [PharmacyDashboardController::class, 'contactUs']);
$app -> router -> post('/pharmacy/contact-us', [PharmacyDashboardController::class, 'contactUs']);


// Supplier Routes
$app -> router -> get('/supplier/login', [LoginAuthController::class, 'supplierLogin']);
$app -> router -> post('/supplier/login', [LoginAuthController::class, 'supplierLogin']);
$app -> router -> get('/supplier/register', [SupplierAuthController::class, 'supplierRegister']);
$app -> router -> post('/supplier/register', [SupplierAuthController::class, 'supplierRegister']);




$app->run();
