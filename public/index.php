<?php

require_once '../vendor/autoload.php';

use app\controllers\DashboardController;
use app\controllers\delivery\DeliveryContactusController;
use app\controllers\delivery\DeliveryDashboardController;
use app\controllers\employee\EmployeeAuthController;
use app\controllers\employee\EmployeeApprovalListController;
use app\controllers\employee\EmployeeApprovalController;
use app\controllers\employee\EmployeeDashboardController;
use app\controllers\employee\EmployeeResController;
use app\controllers\employee\EmployeeResListController;
use app\controllers\lab\LabAuthController;
use app\controllers\lab\LabContactusController;
use app\controllers\lab\LabDashboardController;
use app\controllers\pharmacy\PharmacyAuthController;
use app\controllers\pharmacy\PharmacyDashboardController;
use app\controllers\pharmacy\PharmacyOrderMedicineController;
use app\controllers\supplier\SupplierAuthController;
use app\controllers\supplier\SupplierDashboardController;
use app\controllers\supplier\SupplierUpdateMedicineController;
use app\core\Application;
use app\controllers\delivery\DeliveryAuthController;
use app\controllers\LoginAuthController;
use app\controllers\SiteController;
use app\controllers\supplier\SupplierAddMedicineController;
use app\controllers\lab\LabAcceptReqController;

$app = new Application();

session_start();

// Global Routes
$app->router->get('', [SiteController::class, 'home']);
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/dashboard', [DashboardController::class, 'redirectDashboard']);
$app->router->get('/404', [SiteController::class, '_404']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->get('/login', [LoginAuthController::class, 'login']);
$app->router->post('/login', [LoginAuthController::class, 'login']);

// delivery Routes
//$app -> router -> get('/delivery/login', [LoginAuthController::class, 'deliveryLogin']);
//$app -> router -> post('/delivery/login', [LoginAuthController::class, 'deliveryLogin']);
$app->router->get('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app->router->post('/delivery/register', [DeliveryAuthController::class, 'deliveryRegister']);
$app->router->get('/delivery/orders', [DeliveryDashboardController::class, 'orders']);
$app->router->post('/delivery/orders', [DeliveryDashboardController::class, 'orders']);
$app->router->get('/delivery/history', [DeliveryDashboardController::class, 'history']);
$app->router->post('/delivery/history', [DeliveryDashboardController::class, 'history']);
$app->router->get('/delivery/contact_us', [DeliveryDashboardController::class, 'contactUs']);
$app->router->post('/delivery/contact_us', [DeliveryDashboardController::class, 'contactUs']);
$app->router->post('/delivery/contact_us', [DeliveryContactusController::class, 'delivery_contact_us']);
// Lab Routes
//$app -> router -> get('/lab/login', [LoginAuthController::class, 'labLogin']);
//$app -> router -> post('/lab/login', [LoginAuthController::class, 'labLogin']);
$app->router->get('/lab/register', [LabAuthController::class, 'labRegister']);
$app->router->post('/lab/register', [LabAuthController::class, 'labRegister']);
$app->router->get('/lab/contact-us', [LabDashboardController::class, 'contactUs']);
$app->router->post('/lab/contact-us', [LabDashboardController::class, 'contactUs']);
$app->router->get('/lab/requests', [LabDashboardController::class, 'viewRequest']);
$app->router->post('/lab/requests', [LabDashboardController::class, 'viewRequest']);
$app->router->get('/lab/reports', [LabDashboardController::class, 'addLabReport']);
$app->router->post('/lab/reports', [LabDashboardController::class, 'addLabReport']);
$app->router->post('/lab/accept-req', [LabAcceptReqController::class, 'acceptRequest']);

// Employee Routes
//$app -> router -> get('/employee/login', [LoginAuthController::class, 'employeeLogin']);
//$app -> router -> post('/employee/login', [LoginAuthController::class, 'employeeLogin']);
$app->router->get('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);
$app->router->post('/employee/register', [EmployeeAuthController::class, 'employeeRegister']);
$app->router->get('/employee/reports', [EmployeeDashboardController::class, 'showReports']);
$app->router->post('/employee/reports', [EmployeeDashboardController::class, 'showReports']);
$app->router->get('/employee/approve', [EmployeeApprovalListController::class, 'load']);
$app->router->post('/employee/approve', [EmployeeApprovalListController::class, 'load']);
$app->router->get('/employee/approve/pharmacy', [EmployeeApprovalController::class, 'loadPharmacy']);
$app->router->post('/employee/approve/pharmacy', [EmployeeApprovalController::class, 'loadPharmacy']);
$app->router->get('/employee/approve/supplier', [EmployeeApprovalController::class, 'loadSupplier']);
$app->router->post('/employee/approve/supplier', [EmployeeApprovalController::class, 'loadSupplier']);
$app->router->get('/employee/approve/delivery', [EmployeeApprovalController::class, 'loadDelivery']);
$app->router->post('/employee/approve/delivery', [EmployeeApprovalController::class, 'loadDelivery']);
$app->router->get('/employee/approve/lab', [EmployeeApprovalController::class, 'loadLab']);
$app->router->post('/employee/approve/lab', [EmployeeApprovalController::class, 'loadLab']);
$app->router->get('/employee/res', [EmployeeResListController::class, 'load']);
$app->router->post('/employee/res', [EmployeeApprovalController::class, 'load']);
$app->router->get('/employee/res/pharmacy', [EmployeeResController::class, 'loadPharmacy']);
$app->router->post('/employee/res/pharmacy', [EmployeeResController::class, 'loadPharmacy']);
$app->router->get('/employee/res/supplier', [EmployeeResController::class, 'loadSupplier']);
$app->router->post('/employee/res/supplier', [EmployeeResController::class, 'loadSupplier']);
$app->router->get('/employee/res/delivery', [EmployeeResController::class, 'loadDelivery']);
$app->router->post('/employee/res/delivery', [EmployeeResController::class, 'loadDelivery']);
$app->router->get('/employee/res/lab', [EmployeeResController::class, 'loadLab']);
$app->router->post('/employee/res/lab', [EmployeeResController::class, 'loadLab']);
$app->router->get('/employee/configs', [EmployeeDashboardController::class, 'configs']);
$app->router->post('/employee/configs', [EmployeeDashboardController::class, 'configs']);

//#########################################################################################
// pharmacy Routes

//General Routes
$app->router->get('/pharmacy/register', [PharmacyAuthController::class, 'pharmacyRegister']);
$app->router->post('/pharmacy/register', [PharmacyAuthController::class, 'pharmacyRegister']);
$app->router->get('/pharmacy/sell-medicine', [PharmacyDashboardController::class, 'sellMedicine']);
$app->router->post('/pharmacy/sell-medicine', [PharmacyDashboardController::class, 'sellMedicine']);
$app->router->get('/pharmacy/order-medicine', [PharmacyDashboardController::class, 'orderMedicine']);
$app->router->post('/pharmacy/order-medicine', [PharmacyOrderMedicineController::class, 'createOrder']);
$app->router->get('/pharmacy/orders', [PharmacyDashboardController::class, 'orders']);
$app->router->post('/pharmacy/orders', [PharmacyDashboardController::class, 'orders']);
$app->router->get('/pharmacy/inventory', [PharmacyDashboardController::class, 'inventory']);
$app->router->post('/pharmacy/inventory', [PharmacyDashboardController::class, 'inventory']);
$app->router->get('/pharmacy/contact-us', [PharmacyDashboardController::class, 'contactUs']);
$app->router->post('/pharmacy/contact-us', [PharmacyDashboardController::class, 'contactUs']);
$app->router->get('/pharmacy/profile', [PharmacyDashboardController::class, 'profile']);
$app->router->post('/pharmacy/profile', [PharmacyDashboardController::class, 'profile']);
$app->router->get('/pharmacy/settings', [PharmacyDashboardController::class, 'settings']);
$app->router->post('/pharmacy/settings', [PharmacyDashboardController::class, 'settings']);

//REST API
$app->router->get('/pharmacy/api/order-details', [PharmacyOrderMedicineController::class, 'orderDetails']);
$app->router->get('/pharmacy/api/order-medicine-details', [PharmacyOrderMedicineController::class, 'orderMedicineDetails']);
$app->router->get('/pharmacy/api/cancel-order', [PharmacyOrderMedicineController::class, 'cancelOrder']);




// #############################################################################################


// Supplier Routes
//$app -> router -> get('/supplier/login', [LoginAuthController::class, 'supplierLogin']);
//$app -> router -> post('/supplier/login', [LoginAuthController::class, 'supplierLogin']);
$app->router->get('/supplier/register', [SupplierAuthController::class, 'supplierRegister']);
$app->router->post('/supplier/register', [SupplierAuthController::class, 'supplierRegister']);
$app->router->get('/supplier/add-medicine', [SupplierDashboardController::class, 'addMedicine']);
$app->router->post('/supplier/add-medicine', [SupplierAddMedicineController::class, 'addMedicine']);
$app->router->post('/supplier/add-existing-medicine', [SupplierAddMedicineController::class, 'addExsisting']);
$app->router->get('/supplier/update-inventory', [SupplierDashboardController::class, 'updateInventory']);
$app->router->post('/supplier/delete-medicine', [SupplierUpdateMedicineController::class, 'deleteMed']);
$app->router->post('/supplier/update-medicine', [SupplierUpdateMedicineController::class, 'updateMed']);
$app->router->post('/supplier/update-inventory', [SupplierDashboardController::class, 'updateInventory']);
$app->router->get('/supplier/accept-orders', [SupplierDashboardController::class, 'acceptOrders']);
$app->router->post('/supplier/accept-orders', [SupplierDashboardController::class, 'acceptOrders']);
$app->router->get('/supplier/orders', [SupplierDashboardController::class, 'Orders']);
$app->router->post('/supplier/orders', [SupplierDashboardController::class, 'Orders']);
$app->router->get('/supplier/inventory', [SupplierDashboardController::class, 'inventory']);
$app->router->post('/supplier/inventory', [SupplierDashboardController::class, 'inventory']);
$app->router->get('/supplier/contact-us', [SupplierDashboardController::class, 'contactUs']);
$app->router->post('/supplier/contact-us', [SupplierDashboardController::class, 'contactUs']);
$app->router->get('/supplier/medicine-requests', [SupplierDashboardController::class, 'medicineRequests']);
$app->router->post('/supplier/medicine-requests', [SupplierDashboardController::class, 'medicineRequests']);
// $app->router->post('/supplier/accept', [AcceptOrdersController::class, 'AcceptOrder']);





$app->run();