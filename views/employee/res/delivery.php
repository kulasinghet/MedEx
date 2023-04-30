<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$delivery = $store->aprv_one_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Delivery Management</title>

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
                    <h5 class="card-title">Delivery Details</h5>
                    <form method="POST" action="">
                        <?php if ($delivery != null) { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="entity-username">Username</label>
                                        <input type="text" class="form-input" id="entity-username" value="<?php echo $delivery->username ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-email">Email address</label>
                                        <input type="email" class="form-input" id="entity-email" value="<?php echo $delivery->email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-address">Address</label>
                                        <textarea class="form-input" id="entity-address" rows="3">
                                            <?php echo $delivery->address ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-license-id">Driving License ID</label>
                                        <input type="text" class="form-input" id="entity-license-id" value="<?php echo $delivery->license_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-no">Vehicle Register Number</label>
                                        <input type="text" class="form-input" id="entity-vehicle-no" pattern="[a-zA-Z]{2,3}-[0-9a-zA-Z]{2,3}-[0-9]{4}" value="<?php echo $delivery->vehicle_no ?>">
                                    </div>
                                    <div class="selector-group">
                                        <label>Refrigerators</label>
                                        <div class="form-selector">
                                            <input type="checkbox" class="form-input" id="entity-vehicle-ref-yes"<?php echo $delivery->refrigerators? " checked" : "" ?>>
                                            <label class="form-check-label" for="entity-vehicle-ref-yes">The vehicle has refrigerators</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-license-photo">Driving License Photo</label>
                                        <input class="form-input" type="file" id="entity-license-photo" accept="image/*" value="<?php echo $delivery->license_photo ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-photo">Vehicle Photo</label>
                                        <input class="form-input" type="file" id="entity-vehicle-photo" accept="image/*" value="<?php echo $delivery->vehicle_photo ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="entity-name">Name</label>
                                        <input type="text" class="form-input" id="entity-name" value="<?php echo $delivery->name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-phone">Phone Number</label>
                                        <input type="text" class="form-input" id="entity-phone" value="<?php echo $delivery->mobile ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-city">Deliverable Cities</label>
                                        <input type="text" class="form-input" id="entity-city" value="<?php echo $delivery->city ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-license-name">Driving License Name</label>
                                        <input type="text" class="form-input" id="entity-license-name" value="<?php echo $delivery->license_name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-type">Vehicle Type</label>
                                        <input type="text" class="form-input" id="entity-vehicle-type" value="<?php echo $delivery->vehicle_type ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-max">Max Load</label>
                                        <input type="text" class="form-input" id="entity-vehicle-max" value="<?php echo $delivery->max_load ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-phar_cert">Delivery Certificate</label>
                                        <input class="form-input" type="file" id="entity-phar_cert" accept="image/*" value="<?php echo $delivery->phar_cert_name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-reg-photo">Vehicle Registration</label>
                                        <input class="form-input" type="file" id="entity-vehicle-reg-photo" accept="image/*" value="<?php echo $delivery->vehicle_reg_photo ?>">
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
                                        <label for="entity-license-id">Driving License ID</label>
                                        <input type="text" class="form-input" id="entity-license-id">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-no">Vehicle Register Number</label>
                                        <input type="text" class="form-input" id="entity-vehicle-no" pattern="[a-zA-Z]{2,3}-[0-9a-zA-Z]{2,3}-[0-9]{4}">
                                    </div>
                                    <div class="selector-group">
                                        <label>Refrigerators</label>
                                        <div class="form-selector">
                                            <input type="checkbox" class="form-input" id="entity-vehicle-ref-yes">
                                            <label class="form-check-label" for="entity-vehicle-ref-yes">The vehicle has refrigerators</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-license-photo">Driving License Photo</label>
                                        <input class="form-input" type="file" id="entity-license-photo" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-photo">Vehicle Photo</label>
                                        <input class="form-input" type="file" id="entity-vehicle-photo" accept="image/*">
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
                                        <label for="entity-city">Deliverable Cities</label>
                                        <input type="text" class="form-input" id="entity-city">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-license-name">Driving License Name</label>
                                        <input type="text" class="form-input" id="entity-license-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-type">Vehicle Type</label>
                                        <input type="text" class="form-input" id="entity-vehicle-type">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-max">Max Load</label>
                                        <input type="text" class="form-input" id="entity-vehicle-max">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-phar_cert">Delivery Certificate</label>
                                        <input class="form-input" type="file" id="entity-phar_cert" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-vehicle-reg-photo">Vehicle Registration</label>
                                        <input class="form-input" type="file" id="entity-vehicle-reg-photo" accept="image/*">
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
