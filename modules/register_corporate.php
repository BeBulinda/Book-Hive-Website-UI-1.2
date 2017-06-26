<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();

if (!empty($_POST)) {
    if ($_POST["terms_and_conditions"] != "Yes") {
        $_SESSION['terms_and_conditions'] = false;
        App::redirectTo("?process_feedback");
    } else {
        $createdby = "WEBSITE USER";
        $logo = md5("logo" . $createdby . time());
        $logo_photo_name = $_FILES['logo_photo']['name'];
        $tmp_name_logo = $_FILES['logo_photo']['tmp_name'];
        $extension_logo = substr($logo_photo_name, strpos($logo_photo_name, '.') + 1);
        $logo_photo = strtoupper($logo . '.' . $extension_logo);
        $_SESSION['logo_photo'] = $logo_photo;
        $location = 'modules/images/logos/corporates/';

        move_uploaded_file($tmp_name_logo, $location . $logo_photo);

        $_SESSION['company_name'] = $_POST['company_name'];
        $_SESSION['website'] = $_POST['website'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['postal_number'] = $_POST['postal_number'];
        $_SESSION['postal_code'] = $_POST['postal_code'];
        $_SESSION['town'] = $_POST['town'];
        $_SESSION['county'] = $_POST['county'];
        $_SESSION['sub_county'] = $_POST['sub_county'];
        $_SESSION['location'] = $_POST['location'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['user_type'] = 'CORPORATE';

        if (isset($_SESSION['company_name'])) {
            App::redirectTo("?add_system_administrator&ref_type=" . $_SESSION['user_type']);
        }
    }
}
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Corporate Registration</h2>
                <div class="form-contact">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="company_name">Company name<sup>*</sup></label>
                                <input type="text" name="company_name" placeholder="Company name" required="true">
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
                                <label class="control-label" for="website">Website<sup>*</sup></label>
                                <input type="text" name="website" placeholder="Website" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="logo_photo">Company Logo</label>
                                <input type="file" name="logo_photo">
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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <textarea name="description" cols="30" rows="8" placeholder="Description"></textarea>
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="checkbox" name="terms_and_conditions" value="Yes" required="yes"/> <label for="remember"> &nbsp I accept Book Hive Kenya's terms and conditions</label>
                                <input style="float:right;" type="submit" value="Register" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->