
<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$system_administration = new System_Administration();
$users = new Users();
$books = new Books();

require_once "core/template/header.php";

if (isset($_SESSION["cart_number_of_items"]) AND $_SESSION["cart_number_of_items"] == 0) {
    ?>
    <div class="alert alert-block alert-error fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>No items added to cart. <a href="?home"> Click here </a> to add items to your shopping cart before proceeding.</strong>
    </div>
    <?php
}

if (!empty($_POST) AND $_POST['action'] == "checkout_transaction") {

    if ($_POST["terms_and_conditions"] != "Yes") {
        $_SESSION['terms_and_conditions'] == false;
        App::redirectTo("?process_feedback");
    } else {
        if (isset($_SESSION["cart_item"])) {
            // Billing details
            $_SESSION["billing_firstname"] = $_POST["firstname"];
            $_SESSION["billing_lastname"] = $_POST["lastname"];
            $_SESSION["billing_id_passport_number"] = $_POST["id_passport_number"];
            $_SESSION["billing_phone_number"] = $_POST["phone_number"];
            $_SESSION["billing_email_address"] = $_POST["email_address"];
            $_SESSION["billing_gender"] = $_POST["gender"];
            $_SESSION["billing_company_name"] = $_POST["company_name"];
//        $_SESSION["billing_create_account"] = $_POST["create_account"];
//        $_SESSION["billing_different_address"] = $_POST["different_address"]; 
            $_SESSION["billing_different_address_value"] = $_POST["different_address_value"];

            $_SESSION["transactedby"] = 01; // $_SESSION["user_id"];
            $_SESSION["payment_option"] = $_POST["payment_method"];
            $_SESSION["transaction_id"] = $transactions->getTransactionId($_SESSION["payment_option"], $_SESSION["transactedby"], $_SESSION["cart_total_cost"]);
            $transaction = $transactions->addTransaction();
            if (is_bool($transaction) && $transaction == true) {
                foreach ($_SESSION["cart_item"] as $item) {
                    $_SESSION["book_id"] = $item["id"];
                    $_SESSION["unit_price"] = $item["price"];
                    $_SESSION["quantity"] = $item["quantity"];

                    $book_details = $books->fetchBookDetails($item["id"]);
                    $_SESSION['book_version'] = $book_details["print_type"];

                    $transaction_details = $transactions->addTransactionDetails();
                }
                unset($_SESSION['cart_item']);
                $_SESSION["transaction_status"] = "success";
            } else {
                $_SESSION["transaction_status"] = "process_error";
            }
            App::redirectTo("?home");
        }
    }
}
?>

<div id="content">
    <div class="content-page woocommerce">
        <div class="container">
            <form method="post">                    
                <input type="hidden" name="action" value="checkout_transaction"/>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title-shop-page">checkout</h2>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-billing">
                                    <div class="form-my-account">
                                        <h2 class="title18">Billing Details</h2>
                                        <?php
                                        if (App::isLoggedIn()) {

                                            $user_type_details = $users->fetchUserTypeDetails($_SESSION['login_user_type']);
                                            if ($user_type_details['name'] == "STAFF") {
                                                $user_details = $users->fetchStaffMemberDetails($_SESSION['login_user_ref_id']);
                                                $contact_details = $users->fetchContactDetails("STAFF", $_SESSION['login_user_ref_id']);
                                            } else if ($user_type_details['name'] == "PUBLISHER") {
                                                $user_details = $users->fetchSystemAdministratorDetails($_SESSION['login_user_ref_id']);
                                                $contact_details = $users->fetchContactDetails("PUBLISHER", $_SESSION['login_user_ref_id']);
                                            } else if ($user_type_details['name'] == "BOOK SELLER") {
                                                $user_details = $users->fetchSystemAdministratorDetails($_SESSION['login_user_ref_id']);
                                                $contact_details = $users->fetchContactDetails("BOOK SELLER", $_SESSION['login_user_ref_id']);
                                            } else if ($user_type_details['name'] == "INDIVIDUAL USER") {
                                                $user_details = $users->fetchIndividualUserDetails($_SESSION['login_user_ref_id']);
                                                $contact_details = $users->fetchContactDetails(5, $_SESSION['login_user_ref_id']);
                                            } else if ($user_type_details['name'] == "CORPORATE") {
                                                $user_details = $users->fetchSystemAdministratorDetails($_SESSION['login_user_ref_id']);
                                                $contact_details = $users->fetchContactDetails("CORPORATE", $_SESSION['login_user_ref_id']);
                                            } else if ($user_type_details['name'] == "GUEST USER") {
                                                $user_details = $users->fetchGuestUserDetails($_SESSION['login_user_ref_id']);
                                                $contact_details = $users->fetchContactDetails("GUEST USER", $_SESSION['login_user_ref_id']);
                                            }
//                                            
//                                            argDump($user_type_details);
//                                            argDump($_SESSION['userid']);
//                                            argDump($user_details);
//                                            exit();
                                            ?>                                        
                                            <p class="clearfix box-col2">                                            
                                                <input type="text" name="firstname" value="First Name : <?php echo $user_details['firstname']; ?>" placeholder="First Name *" readonly="yes"/>
                                                <input type="text" name="lastname" value="Last Name : <?php echo $user_details['lastname']; ?>" placeholder="Last Name *" readonly="yes"/>
                                            </p>
                                            <p class="clearfix box-col2">
                                                <input type="text" name="id_passport_number" value="ID/Passport : <?php echo $user_details['idnumber']; ?>" placeholder="ID/Passport Number*" readonly="yes"/>
                                                <input type="text" name="phone_number" value="Phone : <?php echo $contact_details['phone_number']; ?>" placeholder="Phone *" readonly="yes"/>
                                            </p>
                                            <p>
                                                <input type="email" name="email_address" value="EMAIL : <?php echo $contact_details['email']; ?>" placeholder="Email *" readonly="yes"/>
                                            </p>    
                                            <p>    
                                                <input type="text" name="gender" value="GENDER : <?php echo $user_details['gender']; ?>" placeholder="Gender *" readonly="yes"/>
                                            </p>
    <!--                                            <p>
                                                <input type="text" name="company_name" value="Company : Reflex Concepts Ltd" placeholder="Company Name *" readonly="yes"/>
                                            </p>-->
                                        <?php } else { ?>                                            
                                            <p class="clearfix box-col2">                                            
                                                <input type="text" name="firstname" placeholder="First Name *" required=""/>
                                                <input type="text" name="lastname" placeholder="Last Name *" required=""/>
                                            </p>
                                            <p class="clearfix box-col2">
                                                <input type="text" name="id_passport_number" placeholder="ID/Passport Number*" required=""/>
                                                <input type="text" name="phone_number" placeholder="Phone *" required=""/>
                                            </p>
                                            <p>
                                                <input type="email" name="email_address" placeholder="Email *" required=""/>
                                            </p>    
                                            <p class="clearfix box-col2">    
                                                <select name="gender" id="gender">
                                                    <option value="none">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </p>
                                            <p>
                                                <input type="text" name="company_name" placeholder="Company Name *" required=""/>
                                            </p>
                                            <p>
                                                <input type="checkbox" name="create_account" value="Yes" /> <label for="remember">Create an account?</label>
                                            </p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-address">
                                    <div class="form-my-account">
                                        <p class="ship-address">
                                            <input type="checkbox" name="different_address" value="Yes" /> <label for="address">Deliver to a different address?</label>
                                        </p>
                                        <p>
                                            <textarea name="different_address_value" cols="30" rows="10" onblur="if (this.value == '')
                                                        this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                    this.value = ''">Order Notes</textarea>
                                        </p>
                                    </div>
                                </div>		
                            </div>
                        </div>
                        <h3 class="order_review_heading">Your order</h3>
                        <div class="woocommerce-checkout-review-order" id="order_review">
                            <div class="table-responsive">
                                <?php
                                if (isset($_SESSION["cart_item"])) {
                                    $item_total = 0;
                                    ?>                            
                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($_SESSION["cart_item"] as $item) {
                                                $sub_item_total = ($item["price"] * $item["quantity"]);
                                                $book_details = $books->fetchBookDetails($item["id"]);
                                                ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <?php echo $book_details['title']; ?> &nbsp; <span class="product-quantity">× <?php echo $item["quantity"]; ?></span>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount"><?php echo $sub_item_total; ?></span>						
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong><span class="amount">KES 12600</span></strong> </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <?php } ?>
                            </div>
                            <div class="woocommerce-checkout-payment" id="payment">
                                <ul class="payment_methods methods list-none">
                                    <li class="payment_method_bacs">
                                        <input type="radio" data-order_button_text="" value="mpesa" name="payment_method" class="input-radio" id="payment_method_bacs" checked="checked">
                                        <label for="payment_method_mpesa">M-Pesa</label>
                                    </li>
                                    <li class="payment_method_bacs">
                                        <input type="radio" data-order_button_text="" value="bank_transfer" name="payment_method" class="input-radio" id="payment_method_bacs">
                                        <label for="payment_method_bank">Direct Bank Transfer</label>
                                    </li>
                                    <li class="payment_method_cheque">
                                        <input type="radio" data-order_button_text="" value="paypal" name="payment_method" class="input-radio" id="payment_method_cheque">
                                        <label for="payment_method_paypal">Paypal</label>
                                    </li>
                                    <li class="payment_method_paypal">
                                        <input type="radio" data-order_button_text="Proceed to PayPal" value="credit_card" name="payment_method" class="input-radio" id="payment_method_paypal">
                                        <label for="payment_method_card">Credit Card</label>
                                    </li>
                                    <li class="payment_method_cod">
                                        <input type="radio" data-order_button_text="" value="cash" name="payment_method" class="input-radio" id="payment_method_cod">
                                        <label for="payment_method_cod">Cash on Delivery</label>
                                    </li>
                                </ul>
                                <div class="form-row">
                                    <input type="checkbox" name="terms_and_conditions" value="Yes" /> <label for="remember"> &nbsp I accept Book Hive Kenya's terms and conditions</label>
                                </div>
                                <div class="form-row place-order">
                                    <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content Page -->
</div>
