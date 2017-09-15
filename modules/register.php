<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
if (!empty($_POST)) {
    $_SESSION['individual_firstname'] = $_POST['firstname'];
    $_SESSION['individual_lastname'] = $_POST['lastname'];
    $_SESSION['individual_gender'] = $_POST['gender'];
    $_SESSION['individual_idnumber'] = $_POST['idnumber'];
    $_SESSION['user_type'] = 'INDIVIDUAL USER';

    if (isset($_SESSION['individual_firstname'])) {
        App::redirectTo("?add_contact&ref_type=" . $_SESSION['user_type']);
    }
}
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Registration</h2>
                <div class="form-contact">
                    <form method="post">
                        <input type="hidden" name="action" value="register_usertype"/>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="firstname" placeholder="Firstname">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="lastname" placeholder="Lastname">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="idnumber" placeholder="ID/Passport Number">
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="phone_number" placeholder="Phone Number">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="email" value="<?php
                                if (isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                } else
                                    echo 'Session Unset';
                                ?>" readonly="">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="postal_number" placeholder="Postal Number">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="postal_code" placeholder="Postal Code">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="town" placeholder="Town">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="gender">Gender<sup>*</sup></label>
                                <select class="form-magic" name="gender" id="gender">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="county">County<sup>*</sup></label>
                                <select class="form-magic" name="county" id="county">
                                    <?php //echo $system_administration->getCounties(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="sub_county">Sub-County<sup>*</sup></label>
                                <select class="form-magic" name="county" id="county">
                                    <?php //echo $system_administration->getSubCounties(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="location">Location<sup>*</sup></label>
                                <select class="form-magic" name="county" id="county">
                                    <?php //echo $system_administration->getLocations(); ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" value="Send" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->