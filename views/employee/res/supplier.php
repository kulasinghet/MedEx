<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$supplier = $store->aprv_one_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Supplier Management</title>

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
                    <h5 class="card-title">Supplier Details</h5>
                    <form method="POST" action="">
                        <?php if ($supplier != null) { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="entity-username">Username</label>
                                        <input type="text" class="form-input" id="entity-username" value="<?php echo $supplier->username ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-email">Email address</label>
                                        <input type="email" class="form-input" id="entity-email" value="<?php echo $supplier->email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-address">Address</label>
                                        <textarea class="form-input" id="entity-address" rows="3">
                                            <?php echo $supplier->address ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-supp_reg_no">Supplier Registration No.</label>
                                        <input type="text" class="form-input" id="entity-supp_reg_no" value="<?php echo $supplier->supp_reg_no ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-bis_reg_cert">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="entity-bis_reg_cert" accept="image/*" value="<?php echo $supplier->business_cert_name ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="entity-name">Name</label>
                                        <input type="text" class="form-input" id="entity-name" value="<?php echo $supplier->name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-phone">Phone Number</label>
                                        <input type="text" class="form-input" id="entity-phone" value="<?php echo $supplier->mobile ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-bis_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="entity-bis_reg_id" value="<?php echo $supplier->business_reg_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-supp_cert_id">Supplier Certificate Id</label>
                                        <input type="text" class="form-input" id="entity-supp_cert_id" value="<?php echo $supplier->supp_cert_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-supp_cert">Supplier Certificate</label>
                                        <input class="form-input" type="file" id="entity-supp_cert" accept="image/*" value="<?php echo $supplier->supp_cert_name ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="entity-username">Username</label>
                                        <input type="text" class="form-input" id="entity-username">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-email">Email address</label>
                                        <input type="email" class="form-input" id="entity-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-address">Address</label>
                                        <textarea class="form-input" id="entity-address" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-supp_reg_no">Supplier Registration No.</label>
                                        <input type="text" class="form-input" id="entity-supp_reg_no">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-bis_reg_cert">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="entity-bis_reg_cert" accept="image/*">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="entity-name">Name</label>
                                        <input type="text" class="form-input" id="entity-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-phone">Phone Number</label>
                                        <input type="text" class="form-input" id="entity-phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-bis_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="entity-bis_reg_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-supp_cert_id">Supplier Certificate Id</label>
                                        <input type="text" class="form-input" id="entity-supp_cert_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-supp_cert">Supplier Certificate</label>
                                        <input class="form-input" type="file" id="entity-supp_cert" accept="image/*">
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
