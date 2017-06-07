<div id="header">
    <div class="header">
        <div class="top-header top-header4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="account-login">
                            <nav class="main-nav top-menu">
                                <ul>
                                    <li><a href="?verify_book">Verify Book</a></li>
                                    <li><a href="?report_piracy">Report Piracy</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Register</a>
                                        <ul class="sub-menu">
                                            <li><a href="?register_individual_user">Register Individual User</a></li>
                                            <li><a href="?register_book_seller">Register Book Seller</a></li>
                                            <li><a href="?register_self_publisher">Register Self Publisher</a></li>
                                        </ul>
                                    </li>
                                </ul>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs">
                        <div class="currency-language">
                            <div class="currency-box">
                                <a href="?login" class="currency-current">Login</a>
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
                                <a class="category-toggle-link" href="#"><span>All Categories</span></a>
                                <ul class="list-category-toggle list-unstyled">
                                    <li><a href="?ecd_books">ECD Books</a></li>
                                    <li><a href="?primary_books">Primary Books</a></li>
                                    <li><a href="?secondary_books">Secondary Books</a></li>
                                    <li><a href="?adult_books">Adult Reader Books</a></li>
                                    <li><a href="?english_books">English Books</a></li>
                                    <li><a href="?kiswahili_books">Kiswahili Books</a></li>
                                    <li><a href="?activity_books">Activity Books</a></li>
                                </ul>
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
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-3">
                        <nav class="main-nav main-nav4">
                            <ul>
                                <li class="menu-item-has-children">
                                    <a href="?">Home</a>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?featured_books">Featured Books</a>
                                    <!--Adds Pop up Menu with featured items.--> 
                                    <?php require_once 'modules/menu-inserts/featured-inserts.php'; ?>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?ecd_books">ECD</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Primary</a>
                                    <ul class="sub-menu">
                                        <li><a href="?primary_books">All Books</a></li>
                                        <li><a href="?class_one_books">Class One</a></li>
                                        <li><a href="?class_two_books">Class Two</a></li>
                                        <li><a href="?class_three_books">Class Three</a></li>
                                        <li><a href="?class_four_books">Class Four</a></li>
                                        <li><a href="?class_five_books">Class Five</a></li>
                                        <li><a href="?class_six_books">Class Six</a></li>
                                        <li><a href="?class_seven_books">Class Seven</a></li>
                                        <li><a href="?class_eight_books">Class Eight</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Secondary</a>
                                    <ul class="sub-menu">
                                        <li><a href="?secondary_books">All Books</a></li>
                                        <li><a href="?form_one_books">Form One</a></li>
                                        <li><a href="?form_two_books">Form Two</a></li>
                                        <li><a href="?form_three_books">Form Three</a></li>
                                        <li><a href="?form_four_books">Form Four</a></li>
                                    </ul>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?adult_books">Adult Readers</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">PUBLISHERS</a>
                                    <ul class="sub-menu">
                                        <li><a href="?publisher_books">STORY MOJA</a></li>
                                        <li><a href="?publisher_books">LONGHORN</a></li>
                                        <li><a href="?publisher_books">KLB</a></li>
                                        <li><a href="?publisher_books">KIE</a></li>
                                        <li><a href="?publisher_books">LAUNGREHN</a></li>
                                    </ul>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?about">About Us</a>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="?contact">Contact Us</a>
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