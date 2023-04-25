<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class Model
{

    public function loadData(array $getBody)
    {
        foreach ($getBody as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this as $key => $value) {
            if ($key !== "managerid") {
                if (empty($value)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function toString()
    {
        $array = (array) $this;
        return json_encode($array);
    }

    public function createRandomID($tableName): string
    {
        $tag = "";

        switch ($tableName) {
            case "pharmacy":
                $tag = "PH";
                break;
            case "contact_us":
                $tag = "INQ";
                break;
            case "pharmacyorder":
                $tag = "ORD";
                break;
            default:
                $tag = "ID";
                break;
        }


        try {
            $db = (new Database())->getConnection();

            $sql = "SELECT count(*) FROM $tableName;";
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $max = $stmt->get_result()->fetch_assoc()['count(*)'];
            Logger::logDebug("Max: $max" . " Tag: $tag");
            $max = $max + 1;

            $stmt->close();
            return $tag . $max;

        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
        }

        $stmt->close();
        return "";
    }



}
