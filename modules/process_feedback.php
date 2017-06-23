
<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();
$books = new Books();
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="product-quickview">
                <div class="row">
                    <?php if (isset($_SESSION['add_success']) && $_SESSION['add_success'] == true) { ?>
                        <div class="alert alert-info fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Your registration was successful. Please check your email for login credentials.</strong> 
                        </div>
                    <?php 
                    unset($_SESSION['add_success']);
                    } 
                    if (isset($_SESSION['add_error']) && $_SESSION['add_error'] == true) { ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Your registration was unsuccessful. Please try again.</strong>
                        </div>
                    <?php 
                    unset($_SESSION['add_error']);
                    } 
                    if (isset($_SESSION['terms_and_conditions']) && $_SESSION['terms_and_conditions'] == false) { ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>To proceed with this action, you must accept Book Hive Kenya's terms and conditions.</strong>
                        </div>
                    <?php 
                    unset($_SESSION['terms_and_conditions']);
                    }
                    if (isset($_SESSION['account_blocked']) AND $_SESSION['account_blocked'] == true) { ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Sorry, your account has been blocked. Kindly contact your system administrator.</strong>
                        </div>
                    <?php 
                    unset($_SESSION['account_blocked']);
                    }
                    if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == true) { ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>To proceed with this action, you must accept Book Hive Kenya's terms and conditions.</strong>
                        </div>
                    <?php 
                    unset($_SESSION['update_pass_forgot']);
                    } else if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == false) { ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>To proceed with this action, you must accept Book Hive Kenya's terms and conditions.</strong>
                        </div>
                    <?php 
                    unset($_SESSION['update_pass_forgot']);
                    }
                    ?>
                </div>	
            </div>	
        </div>	
    </div>
</div>
<!-- End Content -->