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
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    public function toString()
    {
        $array = (array) $this;
        return json_encode($array);
    }



}
