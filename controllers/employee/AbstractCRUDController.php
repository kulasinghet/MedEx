<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;

abstract class AbstractCRUDController extends Controller
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

    abstract public function loadPharmacy(Request $request): void;
    abstract public function loadSupplier(Request $request): void;
    abstract public function loadDelivery(Request $request): void;
    abstract public function loadLab(Request $request): void;
}