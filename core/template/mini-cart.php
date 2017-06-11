<div class="mini-cart-box">
    <a class="mini-cart-link" href="?cart">
        <span class="mini-cart-icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
        <span class="mini-cart-number">0</span>
    </a>
    <div class="mini-cart-content">
        <h2>(2) ITEMS IN MY CART</h2>
        <ul class="list-mini-cart-item list-unstyled">
            <li>
                <div class="mini-cart-edit">
                    <a class="delete-mini-cart-item" href="#"><i class="fa fa-trash-o"></i></a>
                    <a class="edit-mini-cart-item" href="#"><i class="fa fa-pencil"></i></a>
                </div>
                <div class="mini-cart-thumb">
                    <a href="#"><img alt="" src="images/home1/mini-cart-thumb.png"></a>
                </div>
                <div class="mini-cart-info">
                    <h3><a href="#">Book 1 Title</a></h3>
                    <div class="info-price">
                        <span>KES 5952</span>
                                            </div>
                    <form role="form">
                        <div class="">
                            <div class="btn-group btn-group-sm" role="group">
                                <input type="button" class="btn btn-secondary btn-danger" onclick="decrementValue()" value="-" />
                                <input type="text" class="btn btn-secondary" name="quantity" value="1" maxlength="2" max="10" size="1" id="number" readonly="" />
                                <input type="button" class="btn btn-secondary btn-info" onclick="incrementValue()" value="+" />
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
        <div class="mini-cart-total">
            <label>TOTAL</label>
            <span>KES 2428</span>
        </div>
        <div class="mini-cart-button">
            <a class="mini-cart-view" href="?cart">view my cart </a>
            <a class="mini-cart-checkout" href="?checkout">Checkout</a>
        </div>
    </div>
</div>
<!-- End Mini Cart -->