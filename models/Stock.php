<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class Stock extends Model {

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


    public function getStock($pharmacyName){

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


}
