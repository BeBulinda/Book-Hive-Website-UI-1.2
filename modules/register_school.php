<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
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
        $location = 'modules/images/logos/schools/';

        move_uploaded_file($tmp_name_logo, $location . $logo_photo);

        $_SESSION['school_name'] = $_POST['school_name'];
        $_SESSION['school_type'] = $_POST['school_type'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['website'] = $_POST['website'];
        $_SESSION['postal_number'] = $_POST['postal_number'];
        $_SESSION['postal_code'] = $_POST['postal_code'];
        $_SESSION['town'] = $_POST['town'];
        $_SESSION['county'] = $_POST['county'];
        $_SESSION['sub_county'] = $_POST['sub_county'];
        $_SESSION['location'] = $_POST['location'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['user_type'] = 'SCHOOL';

        if (isset($_SESSION['company_name'])) {
            App::redirectTo("?add_system_administrator&ref_type=" . $_SESSION['user_type']);
        }
    }
}
?>
﻿
<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>School Registration</h2>
                <div class="form-contact">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_piracy_report"/>
                        <input type="hidden" name="reporter_type" value="2"/>
                        <input type="hidden" name="createdby" value="<?php echo 01; //  echo $_SESSION['userid'];            ?>"/>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="school_name">School Name</label>
                                <input type="text" name="school_name" placeholder="School Name">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="school_type">School Type<sup>*</sup></label>
                                <select class="form-magic" name="school_type">
                                    <option value="primary school">Primary School</option>
                                    <option value="secondary school">Secondary School</option>
                                    <option value="college">College</option>
                                    <option value="university">University</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="phone_number">Phone Number<sup>*</sup></label>
                                <input type="text" name="phone_number" placeholder="Phone Number" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="email">Email Address<sup>*</sup></label>
                                <input type="text" name="email" placeholder="Email Address" value="<?php
                                if (isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                } else
                                    echo 'Session Unset';
                                ?>" readonly="">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="website">Website<sup>*</sup></label>
                                <input type="text" name="website" placeholder="Website" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="logo_photo">School Logo</label>
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
                                <label class="control-label" for="town">Postal Town<sup>*</sup></label>
                                <input type="text" name="town" placeholder="Town" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="county">County<sup>*</sup></label>
                                <select class="county form-magic" id="country-list" name="county" onChange="getState(this.value);">
                                    <?php // echo $system_administration->getCounties();   ?>
                                    <option value="">Select County</option>
                                    <?php
                                    foreach ($results as $county) {
                                        ?>
                                        <option value="<?php echo $county["id"]; ?>"><?php echo $county["name"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="sub_county">Sub-County<sup>*</sup></label>
                                <select class="form-magic" name="sub_county" id="county-list" onChange="getLocation(this.value);">
                                    <?php //echo $system_administration->getSubCounties();  ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="location">Location<sup>*</sup></label>
                                <select class="form-magic" name="location"id="location-list">
                                    <?php //echo $system_administration->getLocations();  ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <textarea name="description" cols="30" rows="8" placeholder="Description"></textarea>
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="checkbox" name="terms_and_conditions" value="Yes" required="yes"/> <label for="remember"> &nbsp I accept Bookhive Kenya's <a href="?tac">terms and conditions</a></label>
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