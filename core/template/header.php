<div id="header">
    <div class="header">
        <div class="top-header top-header4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="account-login">
                            <a href="?profile">My Account</a>
                            <a href="?login">Login</a>
                            <a href="?register">Register</a>
                            <a href="?report-piracy">Report Piracy</a>
                            <a href="?tac">Privacy</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs">
                        <div class="currency-language">
                            <div class="language-box">
                                <a href="#" class="language-current"><img src="images/flag/flag.png" alt="" /><span>English</span></a>
                                <ul class="language-list list-unstyled">
                                    <li><a href="#"><img src="images/flag/flag-en.png" alt="" /><span>English</span></a></li>
<!--                                    <li><a href="#"><img src="images/flag/flag-fr.png" alt="" /><span>French</span></a></li>
                                    <li><a href="#"><img src="images/flag/flag-gm.png" alt="" /><span>German</span></a></li>-->
                                </ul>
                            </div>
                            <div class="currency-box">
                                <a href="#" class="currency-current"><span>KES</span></a>
                                <ul class="currency-list list-unstyled">
                                    <li><a href="#"><span class="currency-index">€</span>EUR</a></li>
                                    <li><a href="#"><span class="currency-index">¥</span>JPY</a></li>
                                    <li><a href="#"><span class="currency-index">KES.</span>USD</a></li>
                                </ul>
                            </div>
                            <div class="address-box">
                                <a href="#" class="address-toggle"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                <ul class="address-list list-unstyled">
                                    <li><p>P.O. Box 25663-00100</p></li>
                                    <li><p>Nairobi, Kenya</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Header -->
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="logo logo4">
                            <h1 class="hidden">BookHive Kenya</h1>
                            <a href="?"><img src="images/logo/bookhive_logo_dark.png" width="140" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="smart-search smart-search4">
                            <div class="select-category">
                                <select class="category-toggle-link">
<!--                                <a class="category-toggle-link" href="#"><span>All Categories</span></a>-->
                                <ul class="list-category-toggle list-unstyled">
                                     <option value="all">All Categories</option>
                                    <option value="featured">Featured Products</option>
                                    <option value="ecd">ECD Books</option>
                                    
<!--                                    <li><a href="#">Primary Books</a></li>
                                    <li><a href="#">Secondary Books</a></li>
                                    <li><a href="#">Lifestyle Books</a></li>
                                    <li><a href="#">Religious Books</a></li>-->
                                </ul>
                                </select>
                            </div>
                            <form class="smart-search-form ajax-search">
                                <input type="text" onblur="if (this.value == '')
                                            this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                        this.value = ''" value="Search...">
                                <input type="submit" value="">
                                <div class="list-product-search">
                                    <div class="item-search-pro">
                                        <div class="search-ajax-thumb product-thumb">
                                            <a href="#" class="product-thumb-link"><img src="images/photos/fashion/5.jpg" alt="" /></a>
                                        </div>
                                        <div class="search-ajax-title"><h3 class="title14"><a href="?product-page">The Littlest Bird</a></h3></div>
                                        <div class="search-ajax-price">
                                            <span>KES.350.00</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-9">
                        <div class="check-cart check-cart4">
                            <?php require_once 'mini-cart.php'; ?>
                            <div class="wishlist-box">
                                <a href="?wishlist" class="wishlist-top-link"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            </div>
                            <!-- End Wishlist -->
                            <div class="checkout-box">
                                <a href="#" class="checkout-link"><i class="fa fa-lock" aria-hidden="true"></i></a>
                                <ul class="list-checkout list-unstyled">
                                    <li><a href="?profile"><i class="fa fa-user"></i> Account Info</a></li>
                                    <li><a href="?wishlist"><i class="fa fa-heart-o"></i> Wish List</a></li>
                                    <li><a href="?compare"><i class="fa fa-toggle-on"></i> Compare</a></li>
                                    <li><a href="?login"><i class="fa fa-key" aria-hidden="true"></i>Sign in</a></li>
                                    <li><a href="?checkout"><i class="fa fa-sign-in"></i> Checkout</a></li>
                                </ul>
                            </div>
                            <!-- End Check Out Box -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-3">
                        <nav class="main-nav main-nav4">
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
                                    <a href="?lifestyle">Lifestyle</a>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?religious">Religious</a>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?about">About Us</a>
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
                            <a href="#" class="toggle-mobile-menu"><span></span></a>
                        </nav>
                        <!-- End Main Nav -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Header -->
    </div>
    <?php require_once 'top-menu.php'; ?>
</div>
<!-- End Header -->