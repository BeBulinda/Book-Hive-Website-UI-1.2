<?php

require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
if (!empty($_POST)) {
        $success = $transactions->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['add_success'] = true;
        }
}
?>
﻿
<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Verify Book</h2>
                <div class="form-contact">
                    <form method="post">
                    <input type="hidden" name="action" value="verify_book"/>
                    <input type="hidden" name="createdby" value="<?php echo 01; //  echo $_SESSION['userid'];        ?>"/>
                    <h5>Kindly fill in the below details:</h5>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="number">Book ISBN Number <sup>*</sup></label>
                                <input type="text" name="number" placeholder="ISBN Number">
                            </div>
                            
                            <p><sup>*</sup>Required field	</p>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" value="Verify" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->