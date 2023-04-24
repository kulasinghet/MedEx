<?php

namespace app\views\employee;

use app\controllers\employee\EmployeeApprovalsController;
use app\stores\EmployeeStore;
use Exception;

class EmployeeViewComponents
{
    //private EmployeeApprovalsController $controller;
    private EmployeeStore $store;
    private mixed $approval_flag;
    private string $username;

    public function __construct()
    {
        //$this->controller = new EmployeeApprovalsController();
        $this->store = EmployeeStore::getEmployeeStore();
        $this->approval_flag = $this->store->approval_flag;
        $this->username = $this->store->username;
    }

    public function createSidebar($selection): string
    {
        return ('
<div class="sidebar-collapsible">
    <div class="sidebar-inner">
        <nav class="sidebar-header">
            <div class="sidebar-logo">
                <a href="#">
                    <img alt="MedEx logo" src="../../res/logo/logo-text_light.svg"/>
                </a>
            </div>
        </nav>
        <div class="sidebar-context">
            <ul class="main-buttons">
                <li>
                    <a '.($selection == 'home' ? "class='disabled'" : "").' href="/dashboard"> <i class="fa-solid fa-house"></i>Home</a>
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Approvals
                    <ul class="hidden">
                    '.($selection == 'approval' ? '
                        <li'.($this->approval_flag == 'all' ? " class='disabled'" : "").'><a href="/employee/approvals">All</a></li>
                        <li'.($this->approval_flag == 'pharmacy' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=pharmacy">Pharmacy</a></li>
                        <li'.($this->approval_flag == 'supplier' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=supplier">Supplier</a></li>
                        <li'.($this->approval_flag == 'lab' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=lab">Lab</a></li>
                        <li'.($this->approval_flag == 'delivery' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=delivery">Delivery Partner</a></li>
                    ' : '
                        <li><a href="/employee/approvals">All</a></li>
                        <li><a href="/employee/approvals?filter=pharmacy">Pharmacy</a></li>
                        <li><a href="/employee/approvals?filter=supplier">Supplier</a></li>
                        <li><a href="/employee/approvals?filter=lab">Lab</a></li>
                        <li><a href="/employee/approvals?filter=delivery">Delivery Partner</a></li>
                    ').'
                    </ul>
                </li>
                <li>
                    <a href="/employee/reports"> <i class="fa-solid fa-newspaper"></i>Reports</a>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-server"></i>Resources</a>
                    <ul class="hidden">
                        <li>Pharmacy</li>
                        <li>Supplier</li>
                        <li>Laboratory</li>
                        <li>Delivery Partner</li>
                    </ul>
                </li>
                <li>
                    <a href="/employee/configs"> <i class="fa-solid fa-wrench"></i>Configurations</a>
                </li>
            </ul>
        </div>
    </div>
</div>
        ');
    }

    /**
     * @throws Exception
     */
    public function createNavbar(): string
    {
        $user = $this->store->getUser();
        if (isset($user)) {
            //$user->profile_pic = base64_encode($user->profile_pic);

            return ('
<nav>
    <div class="nav-inner">
        <ul>
            <li><a href="/employee/settings"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
            <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
        <a class="nav-profile" href="/employee">
            <div class="nav-profile-text">
                <h6>'.$user->username.'</h6>
                <span>'.($user->is_manager? "Manager" : "Staff").'</span>
            </div>
            <div class="nav-profile-image">
                <img alt="Profile image" src="'.($user->profile_pic ?? "../res/avatar-empty.png").'"/>
            </div>
        </a>
    </div>
</nav>
        ');
        } else {
            return ('
<nav>
    <div class="nav-inner">
        <ul>
            <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
            <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
        <a class="nav-profile" href="/employee">
            <div class="nav-profile-text">
                <h6>Guest</h6>
                <span>Unknown</span>
            </div>
            <div class="nav-profile-image">
                <img alt="Profile image" src="../res/avatar-empty.png"/>
            </div>
        </a>
    </div>
</nav>
        ');
        }
    }
}