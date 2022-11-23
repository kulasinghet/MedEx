<?php

namespace app\base;

class Response
{
    public function setStatusCode(int $int)
    {
        http_response_code($int);
    }
}
