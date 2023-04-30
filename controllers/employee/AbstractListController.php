<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;

abstract class AbstractListController extends Controller
{
    const login = 'Location: /login';
    const approval_flags = ['all', 'pharmacy', 'supplier', 'lab', 'delivery'];

    protected function validate(): void
    {
        // checking whether the user is logged into the server
        if ($_SESSION['userType'] != 'staff') {
            header(self::login);
        }
    }

    public function getFilterFlag(Request $request): string
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('f', $params)) {
                return (string)$params['f'];
            } else {
                return 'all';
            }
        }

        return '';
    }

    public function getSetNoFlag(Request $request): int
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('st', $params)) {
                return (int)$params['st'];
            } else {
                return 0;
            }
        }

        return 0;
    }

    abstract public function load(Request $request): void;
}