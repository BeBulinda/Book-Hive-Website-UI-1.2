
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
                    } ?>
                </div>	
            </div>	
        </div>	
    </div>
</div>
<!-- End Content -->