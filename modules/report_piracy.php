<?php
//if (!App::isLoggedIn()) {
//    App::redirectTo("?");
//}
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
if (!empty($_POST)) {

    $createdby = $_POST['createdby'];
    $_SESSION['createdby'] = $createdby;
    $book = md5("book" . $createdby . time());
    $book_photo_name = $_FILES['book_photo']['name'];
    $tmp_name_book = $_FILES['book_photo']['tmp_name'];
    $extension_book = substr($book_photo_name, strpos($book_photo_name, '.') + 1);
    $book_photo = strtoupper($book . '.' . $extension_book);
    $_SESSION['book_photo'] = $book_photo;
    $location1 = 'modules/images/piracy/books/';

    $receipt = md5("receipt" . $createdby . time());
    $receipt_photo_name = $_FILES['receipt_photo']['name'];
    $tmp_name_receipt = $_FILES['receipt_photo']['tmp_name'];
    $extension_receipt = substr($receipt_photo_name, strpos($receipt_photo_name, '.') + 1);
    $receipt_photo = strtoupper($receipt . '.' . $extension_receipt);
    $_SESSION['receipt_photo'] = $receipt_photo;
    $location2 = 'modules/images/piracy/receipts/';

    move_uploaded_file($tmp_name_book, $location1 . $book_photo);
    move_uploaded_file($tmp_name_receipt, $location2 . $receipt_photo);

    $success = $transactions->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['report_success'] = true;
    } else {
        $_SESSION['report_error'] = true;
    }
    App::redirectTo("?process_feedback");
}
?>
﻿
<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <h2>Report Piracy</h2>
                <div class="form-contact">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_piracy_report"/>
                        
                        <?php 
                        if (isset($_SESSION['logged_in_user_type_details'])) {
                            $reporter_type = $_SESSION['logged_in_user_type_details']['name'];
                        } else {
                            $reporter_type = "GUEST USER";
                        }
                        ?>
                        
                        <input type="hidden" name="reporter_type" value="<?php echo $reporter_type; ?>"/>
                        <input type="hidden" name="createdby" value="<?php echo 01; //  echo $_SESSION['userid'];            ?>"/>
                        <h5>Kindly fill in the below details:</h5>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="reported_by">Your Name</label>
                                <input type="text" name="reported_by" placeholder="Your Name">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="seller_type">Seller Type<sup>*</sup></label>
                                <select class="form-magic" name="seller_type">
                                    <option value="street_vendor">Street Vendor</option>
                                    <option value="book_shop">Book Shop</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="seller_name">Seller's name</label>
                                <input type="text" name="seller_name" placeholder="Seller's name">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="book_title">Book Title<sup>*</sup></label>
                                <input type="text" name="book_title" placeholder="Book Title">
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="book_photo">Book Photo</label>
                                <input type="file" name="book_photo">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <label class="control-label" for="receipt_photo">Receipt Photo</label>
                                <input type="file" name="receipt_photo">
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
                                <label class="control-label" for="description">Description</label>
                                <textarea name="description" cols="30" rows="8" placeholder="Description"></textarea>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" value="Report" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->