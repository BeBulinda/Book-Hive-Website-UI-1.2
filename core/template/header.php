
<?php
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Books.php";
$books = new Books();
$system_administration = new System_Administration();
$users = new Users();

//if (isset($_SESSION['user'])) {
//    $details = $users->fetchSubscribedUserDetails($_SESSION['user']);
//}
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
    if ($_POST['action'] == "search") {
        $searched_books[] = $books->getAllSearchedBooks($_POST['search_value']);
        $_SESSION['searched_books'] = $searched_books;
        App::redirectTo("?searched_books");
    }
}
?>

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
                                    <li><a href="?register_self_publisher">Self Publisher Registration</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Register</a>
                                        <ul class="sub-menu">
                                            <h5><li><a href="?register_individual_user">As An Individual User</a></li>
                                                <li><a href="?register_book_seller">As A Book Seller</a></li>
                                                <li><a href="?register_school">As A School</a></li>
                                                <li><a href="?register_corporate">As A Corporate</a></li>
                                            </h5>
                                        </ul>
                                    </li>
                                </ul>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs">
                        <div class="currency-language">
                            <?php if (App::isLoggedIn()) { ?>
                                <div class="currency-box">
                                    <a href="#" class="currency-current">

                                        <?php
                                        if (App::isLoggedIn()) {
                                            $user_type_details = $users->fetchUserTypeDetails($_SESSION['login_user_type']);
                                            if ($user_type_details['name'] == "STAFF") {
                                                $profile_link = "?view_staff_individual&code=" . $_SESSION['userid'];
                                            } else if ($user_type_details['name'] == "PUBLISHER") {
                                                $profile_link = "?view_publishers_individual&code=" . $_SESSION['userid'];
                                            } else if ($user_type_details['name'] == "BOOK SELLER") {
                                                $profile_link = "?view_book_sellers_individual&code=" . $_SESSION['userid'];
                                            } else if ($user_type_details['name'] == "INDIVIDUAL USER") {
                                                $profile_link = "?view_individual_users_individual&code=" . $_SESSION['userid'];
                                            } else if ($user_type_details['name'] == "CORPORATE") {
                                                $profile_link = "?view_corporates_individual&code=" . $_SESSION['userid'];
                                            } else if ($user_type_details['name'] == "GUEST USER") {
                                                $profile_link = "?view_guest_users_individual&code=" . $_SESSION['userid'];
                                            }
                                            ?> 

<!--                                            <a data-toggle="modal" href="<?php // echo $profile_link; ?>">
                                                <i class="fa fa-user fa-fw pull-right"></i>
                                                Profile
                                            </a>-->
                                        <?php
                                        }

                                        if (isset($_SESSION['user'])) {
                                            echo $_SESSION['user'];
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="currency-box">
                                    <a href="?logout" class="currency-current">Logout</a>
                                </div>
                            <?php } else { ?>                            
                                <div class="currency-box">
                                    <a href="?login" class="currency-current">Login</a>
                                </div>
                            <?php } ?>
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
                            <a href="?"><img src="images/logo/logowhite.png" width="200" alt="" /></a>
                            <!--<p>One Stop Book Store</p>--> 
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
                                    <li><a href="?printed_books">Printed Books</a></li>
                                    <li><a href="?digital_books">Digital Books</a></li>
                                    <li><a href="?audio_books">Audio Books</a></li>
                                </ul>
                            </div>
                            <form class="smart-search-form ajax-search" method="post">
                                <input type="hidden" name="action" value="search"/>
                                <input type="text" name="search_value" onblur="if (this.value == '')
                                            this.value = this.defaultValue" onfocus="if (this.value == this.defaultValue)
                                                        this.value = ''" value="Search...">
                                <input type="submit" value="">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-9">
                        <div class="check-cart check-cart4">
                            <?php require_once 'mini-cart.php'; ?>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-3 col-xs-9">
                        <div>
                            <a href="?checkout" title="Proceed to checkout"><img src="images/logo/checkout1.jpg" width="60" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-3">
                        <nav class="main-nav main-nav4">
                            <ul>
                                <li class="menu-item-has-children">
                                    <a href="?">Home</a>
                                </li>
                                <li class="has-mega-menu">
                                    <a href="#">Featured Books</a>
                                    <!--Adds Pop up Menu with featured items.--> 
                                    <?php require_once 'modules/menu-inserts/featured-inserts.php'; ?>
                                </li>
                                <li><a href="?ecd_books">ECD</a></li>
                                <li class="menu-item-has-children">
                                    <a href="#">Primary</a>
                                    <ul class="sub-menu">
                                        <li><a href="?primary_books">All Books</a></li>
                                        <li><a href="?primary_revision_books">Revision Books</a></li>
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
                                        <li><a href="?secondary_revision_books">Revision Books</a></li>
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
                                    <?php
//                                    $publishers[] = $users->getAllPublishers();
//                                    if (isset($_SESSION['no_records']) AND $_SESSION['no_records'] == true) {
//                                        echo "<li><a href='?storymoja_books'>STORYMOJA</a></li>";
//                                        unset($_SESSION['no_records']);
//                                    } else if (isset($_SESSION['yes_records']) AND $_SESSION['yes_records'] == true) {
//                                        foreach ($publishers as $key => $value) {
//                                            $inner_array[$key] = json_decode($value, true); // this will give key val pair array
//                                            foreach ((array) $inner_array[$key] as $key2 => $value2) {
//                                                echo "<li><a href='?storymoja_books'>STORYMOJA</a></li>";
//                                            }
//                                        }
//                                        unset($_SESSION['yes_records']);
//                                    }
                                    ?>
                                    <ul class="sub-menu">
                                        <?php echo $users->menuPublishers(); ?>
<!--                                        <li><a href='?storymoja_books'>STORYMOJA</a></li>
                                        <li><a href="?klb_books">KLB</a></li>
                                        <li><a href="?phoenix_books">PHOENIX</a></li>
                                        <li><a href="?longhorn_books">LONGHORN</a></li>
                                        <li><a href="?moran_books">MORAN</a></li>
                                        <li><a href="?self_publisher_books">SELF PUBLISHERS</a></li>-->
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Print Type</a>
                                    <ul class="sub-menu">
                                        <li><a href="?printed_books">Printed Books</a></li>
                                        <li><a href="?digital_books">Digital Books</a></li>
                                        <li><a href="?audio_books">Audio Books</a></li>
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
    <?php //require_once 'top-menu.php'; ?>
</div>
<!-- End Header -->