<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;

abstract class MasterCRUDController extends Controller
{
    const login = 'Location: /login';

    protected function validate(): void
    {
        // checking whether the user is logged into the server
        if ($_SESSION['userType'] != 'staff') {
            header(self::login);
        }
    }

    public function getEntityFlag(Request $request): string
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('et', $params)) {
                return (string)$params['et'];
            }
        }

        return '';
    }

    public function getActionFlag(Request $request): string
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('a', $params)) {
                return (string)$params['a'];
            }
        }

        return '';
    }

    public function getRequestBody(array $body): array
    {
        $params = [];

        foreach ($body as $key => $value) {
            $params[$key] = preg_replace('/(^"(\s+)?|(\s+)?"$)/m', '', $value);
            //$params[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $params;
    }
}