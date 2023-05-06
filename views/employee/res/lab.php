<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$lab = $store->g_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Loboratory Management</title>

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
        <!-- Details Form -->
        <div class="row justify-content-center">
            <div class="col card details-form">
                <div class="card-body">
                    <h4 class="card-title">Laboratory Details</h4>
                    <form action="/employee/res/delivery/push" method="post">
                        <?php if ($lab != null) { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <!-- General info -->
                                    <h5>General Details</h5>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-input disabled" id="username" value="<?php echo $lab->username ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-input" id="email" value="<?php echo $lab->email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-input" id="address" rows="3">
                                            <?php echo $lab->address ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile" value="<?php echo $lab->mobile ?>">
                                    </div>

                                    <!-- Lab info -->
                                    <h5>Laboratory Information</h5>
                                    <div class="form-group">
                                        <label for="name">Laboratory Name</label>
                                        <input type="text" class="form-input" id="name" value="<?php echo $lab->name ?>">
                                    </div>

                                    <!-- Legal info -->
                                    <h5>Legal Information</h5>
                                    <div class="form-group">
                                        <label for="business_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="business_reg_id" value="<?php echo $lab->business_reg_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_cert_name">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="business_cert_name" accept="image/*" value="<?php echo $lab->business_cert_name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lab_cert_id">Laboratory Certificate Id</label>
                                        <input type="text" class="form-input" id="lab_cert_id" value="<?php echo $lab->lab_cert_id ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <!-- General info -->
                                    <h5>General Details</h5>
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
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile">
                                    </div>

                                    <!-- Lab info -->
                                    <h5>Laboratory Information</h5>
                                    <div class="form-group">
                                        <label for="name">Laboratory Name</label>
                                        <input type="text" class="form-input" id="name">
                                    </div>

                                    <!-- Legal info -->
                                    <h5>Legal Information</h5>
                                    <div class="form-group">
                                        <label for="business_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="business_reg_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_cert_name">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="business_cert_name" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="lab_cert_id">Laboratory Certificate Id</label>
                                        <input type="text" class="form-input" id="lab_cert_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="lab_cert_name">Laboratory Certificate</label>
                                        <input class="form-input" type="file" id="lab_cert_name" accept="image/*">
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

