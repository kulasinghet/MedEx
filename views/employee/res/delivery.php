<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$delivery = $store->g_obj;
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
        <!-- Details Form -->
        <div class="row justify-content-center">
            <div class="col card details-form">
                <div class="card-body">
                    <h4 class="card-title">Delivery Partner Details</h4>
                    <form action="/employee/res/delivery/push" method="post">
                        <?php if ($delivery != null) { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <!-- General info -->
                                    <h5>General Details</h5>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-input disabled" id="username" value="<?php echo $delivery->username ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-input" id="email" value="<?php echo $delivery->email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-input" id="address" rows="3">
                                            <?php echo $delivery->address ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile" value="<?php echo $delivery->mobile ?>">
                                    </div>

                                    <!-- Delivery info -->
                                    <h5>Delivery Partner Information</h5>
                                    <div class="form-group">
                                        <label for="name">Delivery Partner Name</label>
                                        <input type="text" class="form-input" id="name" value="<?php echo $delivery->name ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-input" id="age" value="<?php echo $delivery->age ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_location">Deliverable Cities</label>
                                        <input type="text" class="form-input" id="delivery_location" value="<?php echo $delivery->delivery_location ?>">
                                    </div>

                                    <!-- Vehicle info -->
                                    <h5>Vehicle Information</h5>
                                    <div class="form-group">
                                        <label for="vehicle_no">Vehicle Register Number</label>
                                        <input type="text" class="form-input" id="vehicle_no" pattern="[a-zA-Z]{2,3}-[0-9a-zA-Z]{2,3}-[0-9]{4}" value="<?php echo $delivery->vehicle_no ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicle_type">Vehicle Type</label>
                                        <input type="text" class="form-input" id="vehicle_type" value="<?php echo $delivery->vehicle_type ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="max_load">Max Load (Kg)</label>
                                        <input type="text" class="form-input" id="max_load" value="<?php echo $delivery->max_load ?>">
                                    </div>
                                    <div class="selector-group">
                                        <label>Refrigerators</label>
                                        <div class="form-selector">
                                            <input type="checkbox" class="form-input" id="refrigerators"<?php echo $delivery->refrigerators? " checked" : "" ?>>
                                            <label class="form-check-label" for="refrigerators">The vehicle has refrigerators</label>
                                        </div>
                                    </div>

                                    <!-- Legal info -->
                                    <h5>Legal Information</h5>
                                    <div class="form-group">
                                        <label for="license_id">Driving License ID</label>
                                        <input type="text" class="form-input" id="license_id" value="<?php echo $delivery->license_id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="license_name">Name in the license</label>
                                        <input type="text" class="form-input" id="license_name" value="<?php echo $delivery->license_name ?>">
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

                                    <!-- Delivery info -->
                                    <h5>Delivery Partner Information</h5>
                                    <div class="form-group">
                                        <label for="name">Delivery Partner Name</label>
                                        <input type="text" class="form-input" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-input" id="age">
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_location">Deliverable Cities</label>
                                        <input type="text" class="form-input" id="delivery_location">
                                    </div>

                                    <!-- Vehicle info -->
                                    <h5>Vehicle Information</h5>
                                    <div class="form-group">
                                        <label for="vehicle_no">Vehicle Register Number</label>
                                        <input type="text" class="form-input" id="vehicle_no" pattern="[a-zA-Z]{2,3}-[0-9a-zA-Z]{2,3}-[0-9]{4}">
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicle_type">Vehicle Type</label>
                                        <input type="text" class="form-input" id="vehicle_type">
                                    </div>
                                    <div class="form-group">
                                        <label for="max_load">Max Load</label>
                                        <input type="text" class="form-input" id="max_load">
                                    </div>
                                    <div class="selector-group">
                                        <label>Refrigerators</label>
                                        <div class="form-selector">
                                            <input type="checkbox" class="form-input" id="refrigerators">
                                            <label class="form-check-label" for="refrigerators">The vehicle has refrigerators</label>
                                        </div>
                                    </div>

                                    <!-- Legal info -->
                                    <h5>Legal Information</h5>
                                    <div class="form-group">
                                        <label for="license_id">Driving License ID</label>
                                        <input type="text" class="form-input" id="license_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="license_name">Driving License Name</label>
                                        <input type="text" class="form-input" id="license_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="license_photo">Driving License Photo</label>
                                        <input class="form-input" type="file" id="license_photo" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicle_reg_photo">Vehicle Registration</label>
                                        <input class="form-input" type="file" id="vehicle_reg_photo" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicle_photo">Vehicle Photo</label>
                                        <input class="form-input" type="file" id="vehicle_photo" accept="image/*">
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
