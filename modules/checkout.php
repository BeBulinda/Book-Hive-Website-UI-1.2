<div id="content">
    <div class="content-page woocommerce">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title-shop-page">checkout</h2>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-ms-12">
                            <div class="check-billing">
                                <form class="form-my-account">
                                    <h2 class="title18">Billing Details</h2>
                                    <p class="clearfix box-col2">
                                        <input type="text" value="First Name *" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                        <input type="text" value="Last name *" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>
                                    <p class="clearfix box-col2">
                                        <input type="text" value="ID/Passport Number " onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                        <input type="text" value="phone *" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>
                                    <p>
                                        <input type="text" value="Email *" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>    
                                    <p class="clearfix box-col2">    
                                        <select name="gender" id="gender">
                                            <option value="none">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </p>
                                    <p><input type="text" value="Company Name" onblur="if (this.value == '')
                                                this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                            this.value = ''" /></p>
<!--                                    <p>
                                        <select name="country" id="country">
                                            <option value="">Country*</option>
                                            <option value="">United State</option>
                                            <option value="">England</option>
                                            <option value="">Germany</option>
                                            <option value="">France</option>
                                        </select>
                                    </p>
                                    <p><input type="text" value="Address *" onblur="if (this.value == '')
                                                this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                            this.value = ''" /></p>
                                    <p class="clearfix box-col2">
                                        <input type="text" value="Postcode / Zip" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                        <input type="text" value="Town / City *" onblur="if (this.value == '')
                                                    this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                                this.value = ''" />
                                    </p>-->
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
                            <table class="shop_table woocommerce-checkout-review-order-table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Book 1 Title &nbsp; <span class="product-quantity">× 1</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">KES 6800</span>						
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Book 2 Title &nbsp;	<span class="product-quantity">× 2</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">KES 3800</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Delivery Charge &nbsp;	<span class="product-quantity"> (XXXXXX To YYYYYY)</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">KES 2000</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
<!--                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td><strong class="amount">KES 10600</strong></td>
                                    </tr>-->
<!--                                    <tr class="shipping">
                                        <th>Delivery Method</th>
                                        <td>
                                            <ul id="shipping_method" class="list-none">
                                                <li>
                                                    <input type="radio" class="shipping_method" checked="checked" value="by_seller" id="shipping_method_0_free_shipping" data-index="0" name="shipping_method[0]">
                                                    <label for="shipping_method_0_free_shipping">Delivery by Seller(Charged)</label>
                                                </li>
                                                <li>
                                                    <input type="radio" class="shipping_method" value="by_buyer" id="shipping_method_0_local_pickup" data-index="0" name="shipping_method[0]">
                                                    <label for="shipping_method_0_local_pickup">Pickup by Buyer(Free)</label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>-->
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="amount">KES 12600</span></strong> </td>
                                    </tr>
                                </tfoot>
                            </table>
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
