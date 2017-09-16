<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Registration</h2>
                <div class="form-contact">
                    <form method="post">
                        <input type="hidden" name="action" value="confirmUsername"/>
                        <?php
                        if (!empty($_POST)) {
                            $success = $users->execute();
                            if (is_bool($success) && $success == true) {
                                //$url = $_SESSION['current_page'];
                                App::redirectTo('?register_school');
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="username" placeholder="Email *">
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