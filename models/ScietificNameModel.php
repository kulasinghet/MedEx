<?php

namespace app\models;

use app\core\Database;

class ScietificNameModel extends Model
{
    public string $sciName;

    public function SciNameDropdown()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT SciName FROM scientificname;";
        $result = $db->query($sql);
        var_dump($result);
        while ($row = $result->fetch_assoc()) {
            $name = $row["SciName"];
            echo "<option value='$name' class='option'> $name</option>";
        }
    }
}