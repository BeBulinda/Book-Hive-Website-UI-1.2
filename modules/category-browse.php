<?php
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Books.php";
$books = new Books();
$system_administration = new System_Administration();
$users = new Users();

//unset($_SESSION['searched_books']);
$item_total = 0;

if (isset($_SESSION["cart_item"])) {
    $_SESSION["cart_number_of_items"] = count($_SESSION["cart_item"]);
    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
        $_SESSION["cart_total_cost"] = $item_total;
    }
} else {
    $_SESSION["cart_number_of_items"] = 0;
    $_SESSION["cart_total_cost"] = 0;
}

if (!empty($_POST)) {
    if ($_POST['action'] == "register_usertype") {
        if ($_POST['user_type'] === "individual_user") {
            App::redirectTo("?register_individual_user");
        } else if ($_POST['user_type'] === "book_seller") {
            App::redirectTo("?register_book_seller");
        } else if ($_POST['user_type'] === "self_publisher") {
            App::redirectTo("?register_self_publisher");
        }
    } else if ($_POST['action'] == "search") {
        $searched_books[] = $books->getAllSearchedBooks($_POST['search_by'], $_POST['search_value']);
        $_SESSION['searched_books'] = $searched_books;
        if ($_POST['search_by'] === "none") {
            App::redirectTo("?home2");
        } else if ($_POST['search_by'] === "all") {
            App::redirectTo("?search_all_books");
        } else if ($_POST['search_by'] === "publishers") {
            App::redirectTo("?search_all_books");
        } else if ($_POST['search_by'] === "book_titles") {
            App::redirectTo("?search_individual_books");
        } else if ($_POST['search_by'] === "publication_years") {
            App::redirectTo("?search_individual_books");
        } else if ($_POST['search_by'] === "isbn_numbers") {
            App::redirectTo("?search_individual_books");
        } else if ($_POST['search_by'] === "book_types") {
            App::redirectTo("?search_all_books");
        } else if ($_POST['search_by'] === "book_levels") {
            App::redirectTo("?search_book_levels");
        }
    } else if ($_POST['action'] == "login") {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $user_details = $users->fetchLoggedInUserDetails($_SESSION['userid']);
            if ($user_details['status'] == 1) {
                $_SESSION['account_blocked'] = true;
            }
            if ($user_details['password_new'] == 0) {
                App::redirectTo("?update_password");
            }
            App::redirectTo("?home");
        }
    }
}
?>

<div id="content">
    <div class="content-page grid-ajax-infinite">
        <?php require_once 'modules/inc/breadcrumbs.php'; ?>
        <div class="container">
            <!-- End Bread Crumb -->
            <div class="sort-pagi-bar clearfix">
                <div class="view-type pull-left">
                    <a href="#" class="grid-view active"></a>
                    <a href="#" class="list-view"></a>
                </div>
                <div class="pull-left">
                    <!--                    <div class=" select-box">
                    <?php // if (is_menu_set('publisher_books') != "") { ?>
                                                <div class="smart-search smart-search4">
                                                <div style="right: inherit; margin-top: -20px; left: inherit; z-index: 99" class="select-category">
                                                    <a class="category-toggle-link" href="#"><span>Book Category</span></a>
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
                                                </div>
                    <?php // } ?>
                    
                    <?php
//                        if (is_menu_set('english_books') != ""
//                                OR is_menu_set('kiswahili_books') != ""
//                                OR is_menu_set('activity_books') != ""
//                        ) {
                    ?>
                                                <div class="smart-search smart-search4">
                                                <div style="right: inherit; margin-top: -20px; left: inherit; z-index: 99" class="select-category">
                                                    <a class="category-toggle-link" href="#"><span>Book Level</span></a>
                                                    <ul class="list-category-toggle list-unstyled">
                                                        <li><a href="?ecd_books">ECD Books</a></li>
                                                        <li><a href="?primary_books">Primary Books</a></li>
                                                        <li><a href="?secondary_books">Secondary Books</a></li>
                                                        <li><a href="?adult_books">Adult Reader Books</a></li>
                                                    </ul>
                                                </div>
                                                </div>
                    <?php // } ?>
                    
                    <?php
//                        if (is_menu_set('ecd_books') != ""
//                                OR is_menu_set('primary_books') != ""
//                                OR is_menu_set('secondary_books') != ""
//                                OR is_menu_set('adult_books') != ""
//                        ) {
                    ?>
                                                <div style="right: inherit; margin-top: -20px; left: inherit; z-index: 99" class="select-category">
                                                    <a class="category-toggle-link" href="#"><span> Book Type</span></a>
                                                    <ul class="list-category-toggle list-unstyled">
                                                        <li><a href="?english_books">English Books</a></li>
                                                        <li><a href="?kiswahili_books">Kiswahili Books</a></li>
                                                        <li><a href="?activity_books">Activity Books</a></li>
                                                    </ul>
                                                </div>
                    <?php // } ?>
                                        </div>-->

                    <div class="sort-bar select-box">
                        <form method="post">
                            <input type="hidden" name="action" value="filter_books"/>
                            <label>FILTER BY:</label>
                            <select name="publisher">  
                                <?php echo $users->getPublishers(); ?>
                            </select>
                            <select name="book_level">
                                <?php echo $system_administration->getBookLevels(); ?>
                            </select>
                            <select name="book_type">  
                                <?php echo $system_administration->getBookTypes(); ?>
                            </select>
                            <select name="print_type">
                                <option value="ALL">ALL PRINT TYPES</option>
                                <option value="PRINTED">PRINTED BOOKS</option>
                                <option value="DIGITAL">DIGITAL BOOKS</option>
                            </select>
                            <button type="submit" id="submitButton" class="btn btn-primary">Filter</button>
                        </form>

                    </div>
                    <!--                    <div class="show-bar select-box">
                                            <label>Show:</label>
                                            <select>
                                                <option value="">20</option>
                                                <option value="">12</option>
                                                <option value="">24</option>
                                            </select>
                                        </div>-->
                </div>
            </div>
            <!-- End Sort PagiBar -->
            <ul class="grid-product-ajax list-unstyled clearfix">
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" id="trigger" href="?product-page">
                                <img alt="" src="images/photos/sport/6.jpg">
                                <style type="text/css">

                                    /* HOVER STYLES */
                                    div#pop-up {
                                        display: none;
                                        position: absolute;
                                        width: 280px;
                                        padding: 10px;
                                        background: #eeeeee;
                                        color: #000000;
                                        border: 1px solid #1a1a1a;
                                        font-size: 90%;
                                        z-index: 9999999
                                    }
                                </style>
                                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
                                <script type="text/javascript">
                                    $(function () {
                                        var moveLeft = 20;
                                        var moveDown = 10;

                                        $('a#trigger').hover(function (e) {
                                            $('div#pop-up').show();
                                        }, function () {
                                            $('div#pop-up').hide();
                                        });

                                        $('a#trigger').mousemove(function (e) {
                                            $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
                                        });

                                    });
                                </script>
                                <!-- HIDDEN / POP-UP DIV -->
                                <div id="pop-up">
                                    <h3>Pop-up div Successfully Displayed</h3>
                                    <p>
                                        This div only appears when the trigger link is hovered over. Otherwise
                                        it is hidden from view.
                                    </p>
                                </div>
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/8.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/10.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/10.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End All -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/5.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/4.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/7.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/9.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/9.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End All -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/1.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/2.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/2.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End All -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/4.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/4.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/5.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End Item -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/5.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
                            </div>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-extra-link2">
                                <a class="addcart-link" href="#">Add to Cart</a>
                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End All -->
            </ul>
<!--            <div class="btn-loadmore"><a href="#"><i aria-hidden="true" class="fa fa-spinner fa-spin"></i></a></div>-->
        </div>
    </div>
</div>
<!-- End Content -->