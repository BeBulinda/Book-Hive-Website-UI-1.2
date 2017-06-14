
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
    if (isset($_SESSION["cart_item"])) {
        $_SESSION["transactedby"] = 01; // $_SESSION["user_id"];
        $_SESSION["payment_option"] = $_POST["payment_method"];
        $_SESSION["book_version"] = $_POST["book_version"];
        $_SESSION["transaction_id"] = $transactions->getTransactionId($_SESSION["payment_option"], $_SESSION["transactedby"], $_SESSION["cart_total_cost"]);
        $transaction = $transactions->addTransaction();
        if (is_bool($transaction) && $transaction == true) {
            foreach ($_SESSION["cart_item"] as $item) {
                $_SESSION["book_id"] = $item["id"];
                $_SESSION["unit_price"] = $item["price"];
                $_SESSION["quantity"] = $item["quantity"];
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
?>

<div id="content">
    <div class="content-page woocommerce">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title-shop-page">checkout</h2>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-ms-12">
                            <div class="check-billing">
                                <form class="form-my-account" method="post">                    
                                    <input type="hidden" name="action" value="checkout_transaction"/>
                                    <h2 class="title18">Billing Details</h2>
                                    <p class="clearfix box-col2">
                                        <input type="text" value="First Name *" name="firstname" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                        <input type="text" value="Last Name *" name="lastname" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>
                                    <p class="clearfix box-col2">
                                        <input type="text" value="ID/Passport Number " name="idnumber" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                        <input type="text" value="phone *" name="phone_number" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>
                                    <p>
                                        <input type="text" value="Email *" name="email_address" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>    
                                    <p class="clearfix box-col2">    
                                        <select name="gender">
                                            <option value="none">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </p>
                                    <p><input type="text" value="Company Name" name="company_name" onblur="if (this.value == '')
                                                this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                            this.value = ''" /></p>
                                    <p>
                                        <input type="checkbox"  id="remember" /> <label for="remember">Create an account?</label>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-ms-12">
                            <div class="check-address">
                                <form class="form-my-account">
                                    <p class="ship-address">
                                        <input type="checkbox"  id="address" /> <label for="address">Deliver to a different address?</label>
                                    </p>
                                    <p>
                                        <textarea cols="30" rows="10" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''">Order Notes</textarea>
                                    </p>
                                </form>
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
                                    <label for="payment_method_bacs">M-Pesa</label>
                                </li>
                                <li class="payment_method_bacs">
                                    <input type="radio" data-order_button_text="" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                    <label for="payment_method_bacs">Direct Bank Transfer</label>
                                </li>
                                <li class="payment_method_cheque">
                                    <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                    <label for="payment_method_cheque">Cheque Payment</label>
                                </li>
                                <li class="payment_method_cod">
                                    <input type="radio" data-order_button_text="" value="cod" name="payment_method" class="input-radio" id="payment_method_cod">
                                    <label for="payment_method_cod">Cash on Delivery</label>
                                </li>
                                <li class="payment_method_paypal">
                                    <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                    <label for="payment_method_paypal">Credit Card</label>
                                </li>
                            </ul>
                            <div class="form-row place-order">
                                <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Page -->
</div>
