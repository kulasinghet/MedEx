<?php

namespace app\models;

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

    public function createRandomID($entity): string
    {
        $time = time();
        $time = str_replace(" ", "", $time);
        $time = str_replace(":", "", $time);
        $time = str_replace("-", "", $time);
        // take only the last 6 digits
        $time = substr($time, -6);
//        $time = substr($time ,0 ,2);
        return $time . $entity  . rand(0, 1000);
    }



}
