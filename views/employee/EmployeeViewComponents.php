<?php

namespace app\views\employee;

use app\models\InquiryModel;
use app\models\PharmacyOrderModel;
use app\stores\EmployeeStore;
use Exception;
use ReflectionClass;

class EmployeeViewComponents
{
    const para_placeholder = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

    private EmployeeStore $store;

    public function __construct()
    {
        $this->store = EmployeeStore::getEmployeeStore();
    }

    /**
     * @throws \ReflectionException
     */
    private function getTypeOf($obj): string
    {
        $reflect = new ReflectionClass($obj);
        return match ($reflect->getShortName()) {
            'HyperPharmacyModel' => 'pharmacy',
            'HyperSupplierModel' => 'supplier',
            'HyperLabModel' => 'lab',
            'HyperDeliveryModel' => 'delivery',
            default => 'Unknown',
        };
    }

    private function getActorIcon($type): string
    {
        $cls = match ($type) {
            'employee' => 'fa-solid fa-user-tie',
            'pharmacy' => 'fa-solid fa-capsules',
            'supplier' => 'fa-solid fa-truck-medical',
            'lab' => 'fa-solid fa-flask',
            'delivery' => 'fa-solid fa-motorcycle',
            default => 'fa-solid fa-question',
        };

        return '<i class="'.$cls.'"></i>';
    }

    public function createSidebar($selection): string
    {
        return ('
<div class="sidebar-collapsible">
    <div class="sidebar-inner">
        <nav class="sidebar-header">
            <div class="sidebar-logo">
                <a href="#">
                    <img alt="MedEx logo" src="/res/logo/logo-text_light.svg"/>
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
                        <li'.($this->store->flag_g_t == 'all' ? " class='disabled'" : "").'><a href="/employee/approve">All</a></li>
                        <li'.($this->store->flag_g_t == 'pharmacy' ? " class='disabled'" : "").'><a href="/employee/approve?f=pharmacy">Pharmacy</a></li>
                        <li'.($this->store->flag_g_t == 'supplier' ? " class='disabled'" : "").'><a href="/employee/approve?f=supplier">Supplier</a></li>
                        <li'.($this->store->flag_g_t == 'lab' ? " class='disabled'" : "").'><a href="/employee/approve?f=lab">Laboratory</a></li>
                        <li'.($this->store->flag_g_t == 'delivery' ? " class='disabled'" : "").'><a href="/employee/approve?f=delivery">Delivery Partner</a></li>
                    ' : '
                        <li><a href="/employee/approve">All</a></li>
                        <li><a href="/employee/approve?f=pharmacy">Pharmacy</a></li>
                        <li><a href="/employee/approve?f=supplier">Supplier</a></li>
                        <li><a href="/employee/approve?f=lab">Laboratory</a></li>
                        <li><a href="/employee/approve?f=delivery">Delivery Partner</a></li>
                    ').'
                    </ul>
                </li>
                <li'.($selection == 'orders'? ' class="disabled"' : '').'>
                    <a href="/employee/orders"><i class="fa-solid fa-list-check"></i>Pharmacy Oreders</a>
                </li>
                <li'.($selection == 'inquiries'? ' class="disabled"' : '').'>
                    <a href="/employee/inquiries"><i class="fa-solid fa-newspaper"></i>Inquiries</a>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-server"></i>Resources</a>
                    <ul class="hidden">
                    '.($selection == 'res' ? '
                        <li'.($this->store->flag_g_t == 'pharmacy' ? " class='disabled'" : "").'><a href="/employee/res?f=pharmacy">Pharmacy</a></li>
                        <li'.($this->store->flag_g_t == 'supplier' ? " class='disabled'" : "").'><a href="/employee/res?f=supplier">Supplier</a></li>
                        <li'.($this->store->flag_g_t == 'lab' ? " class='disabled'" : "").'><a href="/employee/res?f=lab">Laboratory</a></li>
                        <li'.($this->store->flag_g_t == 'delivery' ? " class='disabled'" : "").'><a href="/employee/res?f=delivery">Delivery Partner</a></li>
                    ' : '
                        <li><a href="/employee/res?f=pharmacy">Pharmacy</a></li>
                        <li><a href="/employee/res?f=supplier">Supplier</a></li>
                        <li><a href="/employee/res?f=lab">Laboratory</a></li>
                        <li><a href="/employee/res?f=delivery">Delivery Partner</a></li>
                    ').'
                    </ul>
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
                <h6>'.$this->store->username.'</h6>
                <span>'.($user->is_manager? "Manager" : "Staff").'</span>
            </div>
            <div class="nav-profile-image">
                <img alt="Profile image" src="'.($user->profile_pic ?? "/res/avatar-empty.png").'"/>
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

    /**
     * @throws \ReflectionException
     */
    public function createApprovalItem($approval): string
    {
        $type = $this->getTypeOf($approval);

        return ('
<tr data-usr="'.$approval->username.'" data-tp="'.$type.'">
    <td class="approval-type">
        <a>'.$this->getActorIcon($type).'</a>
    </td>
    <td>'.$approval->name.'</td>
    <td>'.$approval->email.'</td>
    <td>'.$approval->mobile.'</td>
    <td>
        <div class="row action-buttons">
            <div class="col">
                <a class="btn btn--success" href="/employee/approve/'.$type.'?et='.$approval->username.'">
                    <i class="fa-solid fa-circle-check"></i>
                </a>
            </div>
            <div class="col">
                <a class="btn btn--danger" href="/employee/approve/'.$type.'?et='.$approval->username.'&a=ignore">
                    <i class="fa-solid fa-circle-xmark"></i>
                </a>
            </div>
        </div>
    </td>
</tr>
        ');
    }

    /**
     * @throws \ReflectionException
     */
    public function createResItem($res): string
    {
        $type = $this->getTypeOf($res);

        return ('
<tr data-usr="'.$res->username.'" data-tp="'.$type.'">
    <td>'.$res->username.'</td>
    <td>'.$res->name.'</td>
    <td>'.$res->email.'</td>
    <td>'.$res->mobile.'</td>
    <td>
        <div class="row action-buttons">
            <div class="col">
                <a class="btn btn--info" href="/employee/res/'.$type.'?et='.$res->username.'">
                    <i class="fa-solid fa-pen"></i>
                </a>
            </div>
            <div class="col">
                <a class="btn btn--danger" href="/employee/res/'.$type.'?et='.$res->username.'&a=delete">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>
    </td>
</tr>
        ');
    }

    public function createReportItem(InquiryModel $report): string
    {
        return ('
        <div class="report-itm'.(!$report->is_employee_noticed? " $report->user_type" : "").'" data-id="'.($report->inquiry_id?? "N/A").'" tabindex="0">
            <div class="report-inner">
                <div class="header">
                    <div class="header-icon">
                        <a>'.$this->getActorIcon($report->user_type).'</a>
                    </div>
                    <div class="header-data">
                        <h6 class="header-username">'.($report->username?? "N/A").'</h6>
                        <h5 class="header-subject">'.($report->subject?? "N/A").'</h5>
                    </div>
                </div>
                <div class="report-body">
                    <p>'.($report->message?? self::para_placeholder).'</p>
                </div>
                <div class="report-actions">
                    <div class="report-btn"><a>Accept</a></div>
                </div>
            </div>
        </div>
        ');
    }

    public function createOrderItem(PharmacyOrderModel $order): string
    {
        return ('
<tr data-id="'.$order->id.'" data-tp="'.$order->status.'">
    <td>'.$order->id.'</td>
    <td>'.$order->pharmacyUsername.'</td>
    <td>'.$order->status.'</td>
    <td>'.$order->order_date.'</td>
</tr>
        ');
    }
}