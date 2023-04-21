<?php

namespace app\views\employee;
use app\controllers\employee\EmployeeApprovalsController;

class EmployeeViewComponents
{
    private EmployeeApprovalsController $controller;
    private mixed $filter;

    public function __construct()
    {
        $this->controller = new EmployeeApprovalsController();
        $this->filter = $_SESSION['approval_filter'];
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
            <h6 class="sidebar-context-title">Menu</h6>
            <ul class="main-buttons">
                <li>
                    <a href="/dashboard"> <i class="fa-solid fa-house"></i>Home</a>
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Approvals
                    <ul class="hidden">
                    '.($selection == 'approval' ? '
                        <li'.($this->filter == 'all' ? " class='disabled'" : "").'><a href="/employee/approvals">All</a></li>
                        <li'.($this->filter == 'pharmacy' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=pharmacy">Pharmacy</a></li>
                        <li'.($this->filter == 'supplier' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=supplier">Supplier</a></li>
                        <li'.($this->filter == 'lab' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=lab">Lab</a></li>
                        <li'.($this->filter == 'delivery' ? " class='disabled'" : "").'><a href="/employee/approvals?filter=delivery">Delivery Partner</a></li>
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
}