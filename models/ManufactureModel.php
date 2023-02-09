<?php

namespace app\models;

use app\core\Database;

class ManufactureModel extends Model
{
    public string $id;
    public string $name;

    public function registerManufacture()
    {

        $db = (new Database())->getConnection();


        try {
            $sql = "INSERT INTO manufacture (id, name) VALUES ('$this->id', '$this->name')";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function getManufacture($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from manufacture WHERE manufacture.id = '$id'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->id = $row["id"];
                $this->name = $row["name"];
            }
        }
        $db->close();
    }

    public function getManufactureName($id)
    {
        $this->getManufacture($id);
        return $this->name;
    }

    public function ManufactureDropdown()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id,name FROM manufacture;";
        $result = $db->query($sql);
        var_dump($result);
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];
            echo "<option value='$id' class='option'> $name</option>";
        }
    }
}