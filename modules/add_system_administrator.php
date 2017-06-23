<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$ref_type = $_GET['ref_type'];  //If Publisher, Book seller etc

if (!empty($_POST)) {
    $_SESSION['admin_firstname'] = $_POST['firstname'];
    $_SESSION['admin_lastname'] = $_POST['lastname'];
    $_SESSION['admin_idnumber'] = $_POST['idnumber'];
    $_SESSION['admin_phone_number'] = $_POST['phone_number'];
    $_SESSION['admin_email'] = $_POST['email'];
    
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['add_success'] = true;
    } else {
        $_SESSION['add_error'] = true;
    }
    App::redirectTo("?process_feedback");
    

//    if ($ref_type == "PUBLISHER") {
//        $success = $users->execute();
//        if (is_bool($success) && $success == true) {
//            $_SESSION['add_success'] = true;
//        }
//        App::redirectTo("?home");
//    } else 

//    if ($ref_type == "BOOK SELLER") {
//        $success = $users->execute();
//        if (is_bool($success) && $success == true) {
//            $_SESSION['added_book_seller'] = true;
//        } else {
//            $_SESSION['added_book_seller'] = false;
//        }
//        App::redirectTo("?register_book_seller");
//    } else if ($ref_type == "CORPORATE") {
//        $success = $users->execute();
//        if (is_bool($success) && $success == true) {
//            $_SESSION['added_corporate'] = true;
//        } else {
//            $_SESSION['added_corporate'] = false;
//        }
//        App::redirectTo("?register_corporate");        
//    }
}
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Administrator Registration</h2>
                <div class="form-contact">
                    <form method="post">  
                        <?php if ($ref_type == "BOOK SELLER") { ?>
                            <input type="hidden" name="action" value="register_book_seller"/>
                        <?php } else if ($ref_type == "CORPORATE") { ?>
                            <input type="hidden" name="action" value="register_corporate"/>
                        <?php } ?>
                        
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
                                <label class="control-label" for="phone_number">Phone Number<sup>*</sup></label>
                                <input type="tel" name="phone_number" placeholder="Phone Number" required="true">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="email">Email<sup>*</sup></label>
                                <input type="email" name="email" placeholder="Email Address" required="true">
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