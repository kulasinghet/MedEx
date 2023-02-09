<?php


namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\models\PharmacyOrderModel;
use app\models\Stock;
use Composer\Util\ErrorHandler;

class PharmacyInventoryController extends Controller
{
    public function getInventoryByUsername($username)
    {
        $stock = new Stock();
        $results = $stock->getStock($username);

        if ($results) {
            return $results;
        } else {
            return false;
        }
    }

    public function transformMedicineName(mixed $medID)
    {
        $stock = new Stock();
        $medicine = $stock->getMedicine($medID);

        if ($medicine) {
            return $medicine['medName'] . " <br> " . $medicine['weight'] . " mg ";
        } else {
            return "";
        }
    }

    public function remainingDays(mixed $remaining_days): string
    {
        if ($remaining_days <= 7) {
            return "danger";
        } else if ($remaining_days <= 14) {
            return "warning";
        } else {
            return "success";
        }
    }

    public function getInventoryByUsernameForDashboard(mixed $username)
    {
        $stock = new Stock();
        $results = $stock->getStockForDashboard($username);

        if ($results) {
            return $results;
        } else {
            return false;
        }
    }
}
