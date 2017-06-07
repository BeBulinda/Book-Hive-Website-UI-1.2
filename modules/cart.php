<div class="container">
    <div class="cart-content-page">
        <h2 class="title-shop-page">my cart</h2>
        <form method="post">
            <div class="table-responsive">
                <table cellspacing="0" class="shop_table cart table">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="cart_item">
                            <td class="product-remove">
                                <a class="remove" href="#"><i class="fa fa-times"></i></a>
                            </td>
                            <td class="product-thumbnail">
                                <a href="#"><img  src="images/photos/fashion/7.jpg" width="120" alt=""/></a>					
                            </td>
                            <td class="product-name">
                                <a href="#">Luphen Caunoiteng kug </a>					
                            </td>
                            <td class="product-price">
                                <span class="amount">KES 6800</span>					
                            </td>
                            <td class="product-quantity">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <span class="qty-val">6</span>
                                    <a href="#" class="qty-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                </div>		
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">KES 6800</span>					
                            </td>
                        </tr>
                        <tr class="cart_item">
                            <td class="product-remove">
                                <a class="remove" href="#"><i class="fa fa-times"></i></a>					
                            </td>
                            <td class="product-thumbnail">
                                <a href="#"><img src="images/photos/fashion/8.jpg" width="120" alt=""/></a>					
                            </td>
                            <td class="product-name">
                                <a href="#">Cooc Huyinh Phale </a>					
                            </td>
                            <td class="product-price">
                                <span class="amount">KES 1900</span>					
                            </td>
                            <td class="product-quantity">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <span class="qty-val">6</span>
                                    <a href="#" class="qty-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                </div>			
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">KES 3800</span>					
                            </td>
                        </tr>
<!--                        <tr>
                            <td class="actions" colspan="6">
                                <div class="coupon">
                                    <label for="coupon_code">Coupon:</label> 
                                    <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code"> 
                                    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                </div>
                                <input type="submit" value="Update Cart" name="update_cart" class="button">			
                            </td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
        </form>

        <div class="cart-collaterals">
            <div class="cart_totals ">
                <h2>Cart Totals</h2>
                <div class="table-responsive">
                    <table cellspacing="0" class="table">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td><strong class="amount">KES 10600</strong></td>
                            </tr>
                            <tr class="shipping">
                                <th>Shipping</th>
                                <td>
                                    <ul id="shipping_method">
                                        <li>
                                            <input type="radio" class="shipping_method" checked="checked" value="free_shipping" id="shipping_method_0_free_shipping" data-index="0" name="shipping_method[0]">
                                            <label for="shipping_method_0_free_shipping">Free Shipping</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="shipping_method" value="local_delivery" id="shipping_method_0_local_delivery" data-index="0" name="shipping_method[0]">
                                            <label for="shipping_method_0_local_delivery">Local Delivery (Free)</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="shipping_method" value="local_pickup" id="shipping_method_0_local_pickup" data-index="0" name="shipping_method[0]">
                                            <label for="shipping_method_0_local_pickup">Local Pickup (Free)</label>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong><span class="amount">KES 10600</span></strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="wc-proceed-to-checkout">
                    <a class="checkout-button button alt wc-forward" href="checkout.html">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>	
<!-- End Content Page -->