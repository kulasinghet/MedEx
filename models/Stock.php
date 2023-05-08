<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class Stock extends Model
{

    private $id;
    private $medId;
    private $pharmacyName;
    private $receivedDate;
    private $remQty;
    private $sellingPrice;
    private $buyingPrice;
    private $remainingDays;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMedId()
    {
        return $this->medId;
    }

    /**
     * @param mixed $medId
     */
    public function setMedId($medId): void
    {
        $this->medId = $medId;
    }

    /**
     * @return mixed
     */
    public function getPharmacyName()
    {
        return $this->pharmacyName;
    }

    /**
     * @param mixed $pharmacyName
     */
    public function setPharmacyName($pharmacyName): void
    {
        $this->pharmacyName = $pharmacyName;
    }

    /**
     * @return mixed
     */
    public function getReceivedDate()
    {
        return $this->receivedDate;
    }

    /**
     * @param mixed $receivedDate
     */
    public function setReceivedDate($receivedDate): void
    {
        $this->receivedDate = $receivedDate;
    }

    /**
     * @return mixed
     */
    public function getRemQty()
    {
        return $this->remQty;
    }

    /**
     * @param mixed $remQty
     */
    public function setRemQty($remQty): void
    {
        $this->remQty = $remQty;
    }

    /**
     * @return mixed
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * @param mixed $sellingPrice
     */
    public function setSellingPrice($sellingPrice): void
    {
        $this->sellingPrice = $sellingPrice;
    }

    /**
     * @return mixed
     */
    public function getBuyingPrice()
    {
        return $this->buyingPrice;
    }

    /**
     * @param mixed $buyingPrice
     */
    public function setBuyingPrice($buyingPrice): void
    {
        $this->buyingPrice = $buyingPrice;
    }

    /**
     * @return mixed
     */
    public function getRemainingDays()
    {
        return $this->remainingDays;
    }

    /**
     * @param mixed $remainingDays
     */
    public function setRemainingDays($remainingDays): void
    {
        $this->remainingDays = $remainingDays;
    }


    public function getStock($pharmacyName)
    {

        $conn = (new Database())->getConnection();
        $sql = "SELECT stock.id, stock.medId, stock.remaining_days, medicine.medName, medicine.sciName, stock.remQty, stock.buying_price, stock.receivedDate, stock.sellingPrice, medicine.weight FROM stock LEFT JOIN medicine ON stock.medID = medicine.id WHERE pharmacyName = '$pharmacyName' ORDER BY remaining_days ASC;";

        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result;
        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return null;
        }
    }


    public function getMedicine(mixed $medID)
    {
        $conn = (new Database())->getConnection();
        $sql = "SELECT * FROM medicine WHERE id = '$medID'";

        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_assoc();
        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return null;
        }
    }

    public function getStockForDashboard(mixed $pharmacyName)
    {
        $conn = (new Database())->getConnection();
        $sql = "SELECT * FROM stock WHERE pharmacyName = '$pharmacyName' AND remaining_days <= 14 ORDER BY remaining_days ASC;";

        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result;
        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return null;
        }
    }

    public function getMedicineStock(mixed $medicineID, mixed $username)
    {
        $conn = (new Database())->getConnection();
        $sql = "SELECT * FROM stock LEFT JOIN medicine ON stock.medId = medicine.id WHERE medId = '$medicineID' AND pharmacyName = '$username';";

        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_assoc();
        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return null;
        }
    }

    public function updateMedicine(mixed $pharmacyName, mixed $medicineID, mixed $medName, mixed $sciName, mixed $remQty, mixed $buyingPrice, mixed $sellingPrice, mixed $remainingDays, mixed $consumption, mixed $recievedDate): bool
    {
        $conn = (new Database())->getConnection();
        $sql = "UPDATE stock SET remQty = '$remQty', buying_price = '$buyingPrice', sellingPrice = '$sellingPrice', remaining_days = '$remainingDays', consumption_rate = '$consumption', receivedDate = '$recievedDate' WHERE medId = '$medicineID' AND pharmacyName = '$pharmacyName';";

        try {
            $conn->query($sql);
            $conn->close();

            if ($conn->affected_rows > 0) {
                Logger::logDebug("Medicine updated successfully " . $sql);
                return true;
            } else {
                Logger::logDebug("Medicine not updated " . $sql);
                return false;
            }

        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return false;
        }
    }

    public function getRemainingDaysByMedicineID(mixed $medicineID, mixed $pharmacyName)
    {
        $conn = (new Database())->getConnection();
        $sql = "SELECT remaining_days FROM stock WHERE medId = '$medicineID' AND pharmacyName = '$pharmacyName';";

        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_assoc();
        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return null;
        }
    }

    public function getConsumptionByMedicineID(mixed $medicineID, mixed $pharmacyName)
    {
        $conn = (new Database())->getConnection();
        $sql = "SELECT consumption_rate FROM stock WHERE medId = '$medicineID' AND pharmacyName = '$pharmacyName';";

        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_assoc();
        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return null;
        }
    }

    public function updateStock($orderId)
    {
        $conn = (new Database())->getConnection();
        $sqlallMedicine = "SELECT medId, quantity FROM pharmacyordermedicine WHERE orderId='$orderId'";
        $sqlpharmacyName = "SELECT pharmacyorder.pharmacyUsername FROM pharmacyorder WHERE id='$orderId'";


        $conn = mysqli_connect("medex-do-user-10529241-0.b.db.ondigitalocean.com", "doadmin", "AVNS_K2y23Zo-MYqg2bmkgTy", "medex", 25060);
//        mysqli_query($conn,$sql2);
        try {
            $result = true;


            $pharmacyName = mysqli_query($conn, $sqlpharmacyName)->fetch_assoc()['pharmacyUsername'];
            $allMedicine = mysqli_query($conn, $sqlallMedicine)->fetch_all(MYSQLI_ASSOC);
            $receivedDate = date("Y-m-d");

            for($i=0;$i<sizeof($allMedicine);$i++){

                $sqlSupName = "SELECT pharmacyordermedicine.supName FROM pharmacyordermedicine WHERE medId='" . $allMedicine[$i]['medId'] . "' AND orderId='$orderId';";

                $supName = mysqli_query($conn, $sqlSupName)->fetch_assoc()['supName'];

                $sqlpharmacyBuyPrice = "SELECT supplier_medicine.unitPrice FROM supplier_medicine WHERE medId='" . $allMedicine[$i]['medId'] . "' AND supName='" . $supName . "';";
                $sqlisMedicineExist = "SELECT * FROM stock WHERE medId='" . $allMedicine[$i]['medId'] . "' AND pharmacyName='$pharmacyName';";
                $sqlremainingQty = "SELECT remQty FROM stock WHERE medId='" . $allMedicine[$i]['medId'] . "' AND pharmacyName='$pharmacyName';";
                $sqlconsumptionRate = "SELECT consumption_rate FROM stock WHERE medId='" . $allMedicine[$i]['medId'] . "' AND pharmacyName='$pharmacyName';";

                Logger::logDebug($sqlremainingQty);

                $remainingQtyIntheStock = mysqli_query($conn, $sqlremainingQty);
                if ($remainingQtyIntheStock->num_rows > 0) {
                    $remainingQtyIntheStock = $remainingQtyIntheStock->fetch_assoc()['remQty'];
                } else {
                    $remainingQtyIntheStock = 0;
                }

                $remainingQty = $remainingQtyIntheStock + $allMedicine[$i]['quantity'];

                $pharmacyBuyPrice = mysqli_query($conn, $sqlpharmacyBuyPrice)->fetch_assoc()['unitPrice'];
                $isMedicineExist = mysqli_query($conn, $sqlisMedicineExist)->fetch_assoc();

                if($isMedicineExist){

                    $consumptionRate = mysqli_query($conn, $sqlconsumptionRate)->fetch_assoc()['consumption_rate'];
                    if ($consumptionRate == 0) {
                        $consumptionRate = 1;
                    }
                    $newRemainingDays = $remainingQty/$consumptionRate;

                    $sqlupdateStock = "UPDATE stock SET remQty = '$remainingQty', buying_price = '$pharmacyBuyPrice', receivedDate = '$receivedDate', remaining_days = '$newRemainingDays' WHERE medId = '" . $allMedicine[$i]['medId'] . "' AND pharmacyName = '$pharmacyName';";
                    if (!mysqli_query($conn, $sqlupdateStock)) {
                        $result = false;
                    }
                }else{

                    $sqlcountStock = "SELECT COUNT(*) FROM stock;";
                    $countStock = mysqli_query($conn, $sqlcountStock)->fetch_assoc()['COUNT(*)'];
                    $countStock = (int)$countStock;
                    $countStock = $countStock + 1;
                    $newStockId = "STK" . $countStock . "";

                    $sqlinsertStock = "INSERT INTO stock (id, medId, pharmacyName, receivedDate, remQty, sellingPrice, buying_price, remaining_days, consumption_rate) VALUES ('$newStockId', '" . $allMedicine[$i]['medId'] . "', '$pharmacyName', '$receivedDate', '$remainingQty', '$pharmacyBuyPrice', '$pharmacyBuyPrice', '0', '0');";
                    if (!mysqli_query($conn, $sqlinsertStock)) {
                        $result = false;
                    }
                }
            }

            $conn->close();
            return $result;

        } catch (\Exception $e) {
            $conn->close();
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler())->somethingWentWrong();
            return false;
        }
    }

}
