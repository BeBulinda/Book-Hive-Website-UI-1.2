<div class="header-ontop">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="logo">
                    <a href="?"><img src="images/logo/bookhive_logo_dark.png" width="80" alt=""></a>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <nav class="main-nav main-nav-ontop">
                    <ul>
                        <li class="menu-item-has-children">
                            <a href="?">Home</a>
                        </li>
                        <li class="has-mega-menu">
                            <a href="?featured">Feature Products</a>
                            <!--Adds Pop up Menu with featured items. -->
                            <?php require_once 'modules/menu-inserts/featured-inserts.php'; ?>
                        </li>
                        <li class="has-mega-menu">
                            <a href="?ecd">ECD</a>
                        </li>
                        <li class="has-mega-menu">
                            <a href="?primary">Primary</a>
                        </li>
                        <li class="has-mega-menu">
                            <a href="?secondary">Secondary</a>
                        </li>
                        <li class="has-mega-menu">
                            <a href="?contact">Contact Us</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">MORE</a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="#">PUBLISHERS</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">LONGHORN</a></li>
                                        <li><a href="#">KLB</a></li>
                                        <li><a href="#">KIE</a></li>
                                        <li><a href="#">STORY MOJA</a></li>
                                        <li><a href="#">LAUNGREHN</a></li>
                                    </ul>
                                </li>                                        
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Main Nav -->
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="check-cart check-cart-ontop">
                    <div class="checkout-box">
                        <a href="#" class="checkout-link"><i class="fa fa-lock" aria-hidden="true"></i></a>
                        <ul class="list-checkout list-unstyled">
                            <li><a href="#"><i class="fa fa-user"></i> Account Info</a></li>
                            <li><a href="#"><i class="fa fa-heart-o"></i> Wish List</a></li>
                            <li><a href="#"><i class="fa fa-toggle-on"></i> Compare</a></li>
                            <li><a href="#"><i class="fa fa-key" aria-hidden="true"></i>Sign in</a></li>
                            <li><a href="#"><i class="fa fa-sign-in"></i> Checkout</a></li>
                        </ul>
                    </div>
                    <!-- End Check Out Box -->
                    <div class="search-hover-box">
                        <a href="#" class="search-hover-link"><i class="fa fa-search" aria-hidden="true"></i></a>
                        <form class="search-form-hover">
                            <input onblur="if (this.value == '')
                                        this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                    this.value = ''" value="Search..." type="text">
                            <input value="" type="hidden">
                        </form>
                    </div>
                    <!-- End Wishlist -->
                    <?php require_once 'mini-cart.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header On Top -->