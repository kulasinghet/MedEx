<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$pharmacy = $store->aprv_one_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Pharmacy Management</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Simplebar -->
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <script src="/js/g28-main.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<?php
echo $components->createSidebar('approval');
echo $components->createNavbar();
?>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <!-- DataBox -->
        <div class="row">
            <div class="col card data-box">
                <div class="card-body">
                    <h5 class="card-title">Pharmacy Details</h5>
                    <form method="POST" action="/employee/res/delivery/push">
                        <?php if ($pharmacy != null) { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-input disabled" id="username" value="<?php echo $pharmacy->username ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-input" id="email" value="<?php echo $pharmacy->email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-input" id="address" rows="3">
                                            <?php echo $pharmacy->address ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="phar_reg_no">Pharmacy Registration No.</label>
                                        <input type="text" class="form-input" id="phar_reg_no" value="<?php echo $pharmacy->phar_reg_no ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_cert_name">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="business_cert_name" accept="image/*" value="<?php echo $pharmacy->business_cert_name ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-input" id="name" value="<?php echo $pharmacy->name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile" value="<?php echo $pharmacy->mobile ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-input" id="city" value="<?php echo $pharmacy->city ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="business_reg_id" value="<?php echo $pharmacy->business_reg_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phar_cert_id">Pharmacy Certificate Id</label>
                                        <input type="text" class="form-input" id="phar_cert_id" value="<?php echo $pharmacy->phar_cert_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phar_cert_name">Pharmacy Certificate</label>
                                        <input class="form-input" type="file" id="phar_cert_name" accept="image/*" value="<?php echo $pharmacy->phar_cert_name ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-input" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-input" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-input" id="address" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="phar_reg_no">Pharmacy Registration No.</label>
                                        <input type="text" class="form-input" id="phar_reg_no">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_cert_name">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="business_cert_name" accept="image/*">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-input" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-input" id="city">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="business_reg_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="phar_cert_id">Pharmacy Certificate Id</label>
                                        <input type="text" class="form-input" id="phar_cert_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="phar_cert_name">Pharmacy Certificate</label>
                                        <input class="form-input" type="file" id="phar_cert_name" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col">
                                <div class="button-group center">
                                    <button type="submit" class="btn btn--primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- DataBox -->
    </div>
</div>
<!-- Section: Dashboard Layout -->

<!-- g28 styling framework -->
<script type="application/javascript">
    // you can configure variables in here.
    configs.stage = 'dev';
    configs.customFormElmPath = '/scss/components/forms';

    //logging
    logger("Logging g28 initial state before loading specialized JS files...");
    for (let property in configs) {
        logger(`> ${property}: ${configs[property]}`);
    }
</script>
<script src="/js/g28-forms.js"></script>
<!-- g28 styling framework -->
</body>
</html>
