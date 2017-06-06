<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();

if (!empty($_POST)) {
    $_SESSION['company_name'] = $_POST['company_name'];
    $_SESSION['company_pin'] = $_POST['company_pin'];
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['postal_number'] = $_POST['postal_number'];
    $_SESSION['postal_code'] = $_POST['postal_code'];
    $_SESSION['town'] = $_POST['town'];
    $_SESSION['county'] = $_POST['county'];
    $_SESSION['sub_county'] = $_POST['sub_county'];
    $_SESSION['location'] = $_POST['location'];
    $_SESSION['landmark_feature'] = $_POST['landmark_feature'];
    $_SESSION['user_type'] = 'BOOK SELLER';

    if (isset($_SESSION['company_name'])) {
        App::redirectTo("?add_system_administrator&ref_type=" . $_SESSION['user_type']);
    }
}

if (isset($_SESSION['added_book_seller']) && $_SESSION['added_book_seller'] == true) {
    ?>
    <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Your registration was successful. Please check your email for login credentials.</strong> 
    </div>
    <?php
    unset($_SESSION['added_book_seller']);
} else if (isset($_SESSION['added_book_seller']) && $_SESSION['added_book_seller'] == false) {
    ?>
    <div class="alert alert-block alert-error fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Your registration was unsuccessful. Please try again.</strong>
    </div>
    <?php
    unset($_SESSION['added_book_seller']);
}
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Book Seller Registration</h2>
                <div class="form-contact">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="company_name">Company name<sup>*</sup></label>
                                <input type="text" name="company_name" placeholder="Company name" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="company_pin">Company PIN<sup>*</sup></label>
                                <input type="text" name="company_pin" placeholder="Company PIN" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="phone_number">Phone Number<sup>*</sup></label>
                                <input type="text" name="phone_number" placeholder="Phone Number" required="true">
                            </div>
                            
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="email">Email Address<sup>*</sup></label>
                                <input type="text" name="email" placeholder="Email Address" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="postal_number">Postal Number<sup>*</sup></label>
                                <input type="text" name="postal_number" placeholder="Postal Number" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="postal_code">Postal Code<sup>*</sup></label>
                                <input type="text" name="postal_code" placeholder="Postal Code" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="town">Town<sup>*</sup></label>
                                <input type="text" name="town" placeholder="Town" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="county">County<sup>*</sup></label>
                                <select class="form-magic" name="county">
                                    <?php echo $system_administration->getCounties(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="sub_county">Sub-County<sup>*</sup></label>
                                <select class="form-magic" name="sub_county">
                                    <?php echo $system_administration->getSubCounties(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="location">Location<sup>*</sup></label>
                                <select class="form-magic" name="location">
                                    <?php echo $system_administration->getLocations(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="landmark_feature">Landmark Feature<sup>*</sup></label>
                                <input type="text" name="landmark_feature" placeholder="Landmark Feature" required="true">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" value="Register" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->