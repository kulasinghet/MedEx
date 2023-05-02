<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class PharmacySellModel extends Model
{
    private $invoice_id;
    private $pharmacyUsername;
    private $invoice_date;
    private $bill_total;

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param mixed $invoice_id
     */
    public function setInvoiceId($invoice_id): void
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return mixed
     */
    public function getPharmacyUsername()
    {
        return $this->pharmacyUsername;
    }

    /**
     * @param mixed $pharmacyUsername
     */
    public function setPharmacyUsername($pharmacyUsername): void
    {
        $this->pharmacyUsername = $pharmacyUsername;
    }

    /**
     * @return mixed
     */
    public function getInvoiceDate()
    {
        return $this->invoice_date;
    }

    /**
     * @param mixed $invoice_date
     */
    public function setInvoiceDate($invoice_date): void
    {
        $this->invoice_date = $invoice_date;
    }

    /**
     * @return mixed
     */
    public function getBillTotal()
    {
        return $this->bill_total;
    }

    /**
     * @param mixed $bill_total
     */
    public function setBillTotal($bill_total): void
    {
        $this->bill_total = $bill_total;
    }

    public function createSellOrder($pharmacyUsername, $totalPrice, $medicinIDArray): bool | string
    {
        $this->setInvoiceId($this->createRandomID('pharmacysell'));
        $order_date = date("Y-m-d");

        $sql = "INSERT INTO pharmacysell (invoice_id, pharmacyUsername, invoice_date, bill_total) VALUES ('$this->invoice_id', '$pharmacyUsername', '$order_date', '$totalPrice');";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                if ($this->updateSellMedicineQuantity($pharmacyUsername, $medicinIDArray)) {
                    return $this->invoice_id;
                }

            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }

        return false;

    }

    private function updateSellMedicineQuantity($pharmacyUsername, $medicinIDArray): bool | string
    {
        $db = (new Database())->getConnection();

        $flag = true;

        foreach ($medicinIDArray as $medicine) {

            $medicineID = $medicine->getMedicineId();
            $quantity = $medicine->getQuantity();

            $sql = "INSERT INTO pharmacysellmedicine (invoice_id, pharmacyUsername, medId, quantity) VALUES ('$this->invoice_id', '$pharmacyUsername', '$medicineID', '$quantity');";

            Logger::logDebug($sql);

            try {
                $stmt = $db->prepare($sql);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    $stmt->close();

                    if ($this->updateStock($medicineID, $quantity, $pharmacyUsername)) {
                        continue;
                    } else {
                        $flag = false;
                        break;
                    }

                } else {
                    $flag = false;
                    break;
                }
            } catch (\Exception $e) {
                Logger::logError($e->getMessage());
                return false;
            }
        }



        return $flag;
    }

    public function getMedicineSellsByOrderID(bool|string $invoice_id )
    {
//        SELECT pharmacyordermedicine.medId, pharmacyordermedicine.quantity, medicine.medName, medicine.sciName, medicine.weight, supplier_medicine.unitPrice FROM pharmacyordermedicine LEFT JOIN medicine ON pharmacyordermedicine.medid = medicine.id LEFT JOIN supplier_medicine ON medicine.id = supplier_medicine.medid WHERE orderid = '$orderId'";
        $sql = "SELECT pharmacysellmedicine.medId, pharmacysellmedicine.quantity, medicine.medName, medicine.sciName, medicine.weight, supplier_medicine.unitPrice FROM pharmacysellmedicine LEFT JOIN medicine ON pharmacysellmedicine.medid = medicine.id LEFT JOIN supplier_medicine ON medicine.id = supplier_medicine.medid WHERE invoice_id = '$invoice_id'";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    private function updateStock($medicineID, $quantity, $pharmacyUsername): bool
    {
        $db = (new Database())->getConnection();

        $sql = "UPDATE stock SET remQty = remQty - '$quantity' WHERE medId = '$medicineID' AND pharmacyName = '$pharmacyUsername'";

        Logger::logDebug($sql);

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {

                if ($this->updateRemainingDays($medicineID, $pharmacyUsername) == true && $this->updateConsumptionRate($medicineID, $pharmacyUsername) == true) {
                    $stmt->close();
                    return true;
                } else {
                    $stmt->close();
                    return false;
                }

            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getPharmacySellOrders(mixed $username)
    {
        $sql = "SELECT * FROM pharmacysell WHERE pharmacyUsername = '$username' ORDER BY invoice_date DESC";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getPharmacySellOrdersByInvoiceId(mixed $invoiceId)
    {
        $sql = "SELECT * FROM pharmacysell WHERE invoice_id = '$invoiceId'";
        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getPharmacySellOrdersMedicinesByInvoiceId(mixed $invoiceId)
    {
        $sql = "SELECT pharmacysellmedicine.medId, pharmacysellmedicine.quantity, medicine.medName, medicine.sciName, medicine.weight, supplier_medicine.unitPrice FROM pharmacysellmedicine LEFT JOIN medicine ON pharmacysellmedicine.medid = medicine.id LEFT JOIN supplier_medicine ON medicine.id = supplier_medicine.medid WHERE invoice_id = '$invoiceId'";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function updateRemainingDays($medicineId, $pharmacyUsername) {
        $db = (new Database())->getConnection();

        $sql = "UPDATE stock SET remaining_days = remQty / consumption_rate WHERE medId = '$medicineId' AND pharmacyName = '$pharmacyUsername'";

        Logger::logDebug($sql);

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                Logger::logDebug("Remaining days updated");
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function updateConsumptionRate($medicineId, $pharmacyUsername) {
        // update consumption rate per day by getting the previous consumption rate and getting the moving average
        $db = (new Database())->getConnection();

        $sql = "UPDATE stock SET consumption_rate = (SELECT AVG(consumption_rate) FROM (SELECT consumption_rate FROM stock WHERE medId = '$medicineId' AND pharmacyName = '$pharmacyUsername' ORDER BY id DESC LIMIT 7) AS t) WHERE medId = '$medicineId' AND pharmacyName = '$pharmacyUsername'";

        Logger::logDebug($sql);

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();

            Logger::logDebug($stmt->affected_rows);

            // if no error

            if ($stmt->error == "") {
                $stmt->close();
                Logger::logDebug("Consumption rate updated");
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getSalesOrdersPerDayLimitWeek(mixed $pharmacyUsername)
    {
        $sql = "SELECT invoice_date, SUM(bill_total) AS total FROM pharmacysell WHERE pharmacyUsername = '$pharmacyUsername' AND invoice_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY invoice_date ORDER BY invoice_date DESC LIMIT 7";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getTotalSalesLimitMonth(mixed $pharmacyUsername)
    {
        $sql = "SELECT SUM(bill_total) AS total FROM pharmacysell WHERE pharmacyUsername = '$pharmacyUsername' AND MONTH(invoice_date) = MONTH(CURRENT_DATE()) AND YEAR(invoice_date) = YEAR(CURRENT_DATE())";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_assoc();
            $db->close();
            return $result['total'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getTotalCostLimitMonth(mixed $pharmacyUsername)
    {
        $sql = "SELECT SUM(quantity * stock.buying_price) AS total  FROM pharmacysellmedicine LEFT JOIN stock ON pharmacysellmedicine.medId = stock.medId WHERE pharmacysellmedicine.invoice_id IN (SELECT invoice_id FROM pharmacysell WHERE pharmacyUsername = '$pharmacyUsername' AND MONTH(invoice_date) = MONTH(CURRENT_DATE()) AND YEAR(invoice_date) = YEAR(CURRENT_DATE()))";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $result = $db->query($sql);
            $result = $result->fetch_assoc();
            $db->close();
            return $result['total'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }


}
