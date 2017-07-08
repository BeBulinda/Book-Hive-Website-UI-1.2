
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
                    if (isset($_SESSION['add_error']) && $_SESSION['add_error'] == true) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Your registration was unsuccessful. Please try again.</strong>
                        </div>
                        <?php
                        unset($_SESSION['add_error']);
                    }
                    if (isset($_SESSION['verify_success']) && $_SESSION['verify_success'] == true) { ?>
                        <div class="alert alert-info fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Your verification was processed successfully. Your book is one of our products.</strong> 
                        </div>
                        <?php
                        unset($_SESSION['verify_success']);
                    }
                    if (isset($_SESSION['verify_error']) && $_SESSION['verify_error'] == true) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>The book code entered is wrong/does not exist among our the selected publisher's books. Please try the verification process again. If it persists request for a replacement from the book seller.</strong>
                        </div>
                        <?php
                        unset($_SESSION['verify_error']);
                    }
                    if (isset($_SESSION['report_success']) && $_SESSION['report_success'] == true) { ?>
                        <div class="alert alert-info fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Your piracy report has been successfully logged and is being looked into. The necessary action shall be taken in due time. Thank you for taking part in the war against piracy.</strong> 
                        </div>
                        <?php
                        unset($_SESSION['report_success']);
                    }
                    if (isset($_SESSION['report_error']) && $_SESSION['report_error'] == true) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Your piracy report was not successfully submitted. Please submit the report again.</strong>
                        </div>
                        <?php
                        unset($_SESSION['report_error']);
                    }
                    if (isset($_SESSION['terms_and_conditions']) && $_SESSION['terms_and_conditions'] == false) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>To proceed with this action, you must accept Bookhive Kenya's <a href="?tac">terms and conditions</a>.</strong>
                        </div>
                        <?php
                        unset($_SESSION['terms_and_conditions']);
                    }
                    if (isset($_SESSION['account_blocked']) AND $_SESSION['account_blocked'] == true) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Sorry, your account has been blocked. Kindly contact your system administrator.</strong>
                        </div>
                        <?php
                        unset($_SESSION['account_blocked']);
                    }
                    if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == true) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Password successfully updated. Please check your email for the updated login credentials.</strong>
                        </div>
                        <?php
                        unset($_SESSION['update_pass_forgot']);
                    } else if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == false) {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Sorry, there was an error updating your password. Please confirm your email address and try the update process again.</strong>
                        </div>
                        <?php
                        unset($_SESSION['update_pass_forgot']);
                    }
                    if (isset($_SESSION['transaction_status']) AND $_SESSION['transaction_status'] == "success") {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Transaction processed successfully.</strong>
                        </div>
                        <?php
                        unset($_SESSION["cart_item"]);
                        unset($_SESSION["item_total"]);
                        unset($_SESSION['transaction_status']);
                    } else if (isset($_SESSION['transaction_status']) AND $_SESSION['transaction_status'] == "process_error") {
                        ?>
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Error processing transaction. Please try again later.</strong>
                        </div>
                        <?php
                        unset($_SESSION['transaction_status']);
                    }
                    ?>
                </div>	
            </div>	
        </div>	
    </div>
</div>
<!-- End Content -->