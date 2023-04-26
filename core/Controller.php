<?php

namespace app\core;

class Controller
{
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function print_r($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public function print_request_body_to_log($requestBody)
    {
        Logger::logDebug('Request Body:');
        $str = '';
        foreach ($requestBody as $key => $value) {
            $str .= $key . ' => ' . $value . ', ';
        }
        Logger::logDebug($str);
    }

}
