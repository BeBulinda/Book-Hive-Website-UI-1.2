<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();

if (!empty($_POST)) {
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['update_pass_forgot'] = true;
    } else {
        $_SESSION['update_pass_forgot'] = false;
    }
    App::redirectTo("?process_feedback");
}
?>

        <div id="content">
            <div class="content-page">
                <div class="container">
                    <div class="contact-form-page">
                        <div class="form-contact">
                            <div class="col-md-6">
                                <h3>Bookhive Password | <b>Recovery</b></h3>
                                <form method="post">
                                    <input type="hidden" name="action" value="forgot_password"/>
                                    <div class="row">
<!--                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="controls">
                                                <input  type="text" name="firstname"  placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="controls">
                                                <input  type="text" name="lastname"  placeholder="Last Name">
                                            </div>
                                        </div>-->
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="controls">
                                                <input  type="email" name="email"  placeholder="Email Address">
                                            </div>
                                        </div>                                
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="submit" value="Reset Password" />
                                        </div>
                                    </div>
                                </form>
                                <h5><a href="?login">Just Login!</a></h5>
                            </div>
                        </div>
                    </div>
                    <?php // require_once 'modules/inc/contact-details.php';  ?>
                </div>
            </div>
        </div>

