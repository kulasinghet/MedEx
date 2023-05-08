<?php

namespace app\stores;

use app\models\EmployeeModel;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use Exception;

class EmployeeStore
{
    public string $username;
    public array $toast_list;

    // general list page variables
    public string $flag_g_t; // stores the entity type
    public int $flag_g_st; // stores the set number
    public array $list_g;

    // general details page variables
    public string $flag_g_usr; // stores the username
    public string $flag_g_act; // stores the action
    public HyperPharmacyModel|HyperDeliveryModel|HyperLabModel|HyperSupplierModel|null $g_obj;

    /**
     * @throws Exception
     */
    private final function __construct()
    {
        $this->list_g = [];
        $this->toast_list = [];
        $this->g_obj = null;
        $this->flag_g_t = '';
        $this->flag_g_st = 0;
        $this->flag_g_usr = '';
        $this->flag_g_act = '';

        // retrieve user details from session
        if (isset($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        } else {
            throw new Exception('Username not set in session');
        }
    }

    public static function getEmployeeStore() {
        if (!isset($_SESSION['employee_store'])) {
            $_SESSION['employee_store'] = new EmployeeStore();
        }

        return $_SESSION['employee_store'];
    }

    /**
     * @throws Exception
     */
    public function getUser(): ?EmployeeModel
    {
        if (isset($this->username)) {
            return EmployeeModel::getByUsername($this->username);
        } else {
            throw new Exception('Username not set in session');
        }
    }

    public function setNotification($subject, $message, $type): void
    {
        $this->toast_list[] = new ToastNotification($subject, $message, $type);
    }

    public function renderNotifications(): void
    {
        if ($this->toast_list != []) {
            foreach ($this->toast_list as $toast) {
                echo $toast->render();
            }
            $this->toast_list = [];
        }
    }
}