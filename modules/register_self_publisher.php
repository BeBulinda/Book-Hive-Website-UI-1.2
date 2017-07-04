<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Users.php";
$users = new Users();

require_once "core/template/header.php";

if (!empty($_POST)) {
    if ($_POST["terms_and_conditions"] != "Yes") {
        $_SESSION['terms_and_conditions'] = false;
    } else {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['add_success'] = true;
        } else {
            $_SESSION['add_error'] = true;
        }
    }
    App::redirectTo("?process_feedback");
}
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Publisher Registration</h2>
                <div class="form-contact">
                    <form method="post">  
                        <input type="hidden" name="action" value="add_self_publisher"/>

                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="firstname">Firstname<sup>*</sup></label>
                                <input type="text" name="firstname" placeholder="Firstname" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="lastname">Lastname<sup>*</sup></label>
                                <input type="text" name="lastname" placeholder="Lastname" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="idnumber">ID/Passport Number<sup>*</sup></label>
                                <input type="text" name="idnumber" placeholder="ID/Passport Number" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="gender">Gender<sup>*</sup></label>
                                <select class="form-magic" name="gender" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="phone_number">Phone Number<sup>*</sup></label>
                                <input type="tel" name="phone_number" placeholder="Phone Number" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="email">Email<sup>*</sup></label>
                                <input type="email" name="email" placeholder="Email Address" required="true">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <textarea name="description" cols="30" rows="8" placeholder="Description"></textarea>
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="checkbox" name="terms_and_conditions" value="Yes" required="yes"/> <label for="remember"> &nbsp I accept Bookhive Kenya's <a href="?tac">terms and conditions</a></label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" value="Register" />
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Content -->