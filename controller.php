<?php

require WPATH . "core/include.php";
$currentPage = "";

if (is_menu_set('logout') != "") {
    App::logOut();
//    header("Location: {$_SERVER['HTTP_REFERER']}");
//    exit();
}

if (is_menu_set('home') != "") {
    $currentPage = WPATH . "modules/home.php";
    set_title("Bookhive | Home");
} else if (is_menu_set('?') != "") {
    $currentPage = WPATH . "modules/home.php";
    set_title("Bookhive | Home");
} else if (is_menu_set('cart') != "") {
    $currentPage = WPATH . "modules/cart.php";
    set_title("Bookhive | My Cart");
} else if (is_menu_set('checkout') != "") {
    $currentPage = WPATH . "modules/checkout.php";
    set_title("Bookhive | Checkout");
} else if (is_menu_set('contact') != "") {
    $currentPage = WPATH . "modules/contact.php";
    set_title("Bookhive | Contact Us");
} else if (is_menu_set('report_piracy') != "") {
    $currentPage = WPATH . "modules/report_piracy.php";
    set_title("Bookhive | Report Piracy");
} else if (is_menu_set('tac') != "") {
    $currentPage = WPATH . "modules/tac.php";
    set_title("Bookhive | Terms & Conditions");
} else if (is_menu_set('privacy_policy') != "") {
    $currentPage = WPATH . "modules/privacy_policy.php";
    set_title("Bookhive | Privacy Policy");
} else if (is_menu_set('confirm_delivery') != "") {
    $currentPage = WPATH . "modules/confirm_delivery.php";
    set_title("Bookhive | Confirm Delivery");
} else if (is_menu_set('registering') != "") {
    $currentPage = WPATH . "modules/registering.php";
    set_title("Bookhive | Registration");
} else if (is_menu_set('registering_self_publisher') != "") {
    $currentPage = WPATH . "modules/registering_self_publisher.php";
    set_title("Bookhive | Self Publisher Registration");
} else if (is_menu_set('registering_individual_user') != "") {
    $currentPage = WPATH . "modules/registering_individual_user.php";
    set_title("Bookhive | Individual Registration");
} else if (is_menu_set('registering_book_seller') != "") {
    $currentPage = WPATH . "modules/registering_book_seller.php";
    set_title("Bookhive | Book Seller Registration");
} else if (is_menu_set('registering_corporate') != "") {
    $currentPage = WPATH . "modules/registering_corporate.php";
    set_title("Bookhive | Corporate Registration");
} else if (is_menu_set('registering_school') != "") {
    $currentPage = WPATH . "modules/registering_school.php";
    set_title("Bookhive | School Registration");
} 


/** An alternative to product page * */
//else if ( is_menu_set('detail') != ""){
//    $currentPage = WPATH . "modules/detail.php";
//    set_title("Bookhive | Product Details");
//}
else if (is_menu_set('about') != "") {
    $currentPage = WPATH . "modules/about.php";
    set_title("Bookhive | About Us");
} else if (is_menu_set('404') != "") {
    $currentPage = WPATH . "modules/404.php";
    set_title("Bookhive | Ooops Sorry");
} else if (is_menu_set('profile') != "") {
    $currentPage = WPATH . "modules/profile.php";
    set_title("Bookhive | My Profile");
} else if (is_menu_set('wishlist') != "") {
    $currentPage = WPATH . "modules/wishlist.php";
    set_title("Bookhive | My Wishlist");
} else if (is_menu_set('compare') != "") {
    $currentPage = WPATH . "modules/compare.php";
    set_title("Bookhive | Compare");
} else if (is_menu_set('login') != "") {
    $currentPage = WPATH . "modules/login.php";
    set_title("Bookhive | Sign In");
} else if (is_menu_set('forgot_password') != "") {
    $currentPage = WPATH . "modules/forgot_password.php";
    set_title("StaqPesa | Update Password");
} else if (is_menu_set('forgot_password_next') != "") {
    $currentPage = WPATH . "modules/forgot_password_next.php";
    set_title("StaqPesa | Update Password");
} else if (is_menu_set('product-page') != "") {
    $currentPage = WPATH . "modules/product-page.php";
    set_title("Bookhive | Product Pages");
} else if (is_menu_set('quick-view') != "") {
    $currentPage = WPATH . "modules/quick-view.php";
    set_title("Bookhive | Product Pages");
} else if (is_menu_set('category-browse') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Category");
} else if (is_menu_set('filtered_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Filtered Books");
} else if (is_menu_set('searched_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Searched Books");
} else if (is_menu_set('ecd_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | ECD Books");
} else if (is_menu_set('primary_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Primary Books");
} else if (is_menu_set('secondary_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Secondary Books");
} else if (is_menu_set('adult_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Adult Books");
} else if (is_menu_set('english_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | English Books");
} else if (is_menu_set('kiswahili_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Kiswahili Books");
} else if (is_menu_set('activity_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Activity Books");
} else if (is_menu_set('featured_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Featured Books");
} else if (is_menu_set('class_one_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class One Books");
} else if (is_menu_set('class_two_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Two Books");
} else if (is_menu_set('class_three_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Three Books");
} else if (is_menu_set('class_four_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Four Books");
} else if (is_menu_set('class_five_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Five Books");
} else if (is_menu_set('class_six_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Six Books");
} else if (is_menu_set('class_seven_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Seven Books");
} else if (is_menu_set('class_eight_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Class Eight Books");
} else if (is_menu_set('primary_revision_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Primary Revision Books");
} else if (is_menu_set('secondary_revision_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Secondary Revision Books");
} else if (is_menu_set('form_one_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Form One Books");
} else if (is_menu_set('form_two_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Form Two Books");
} else if (is_menu_set('form_three_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Form Three Books");
} else if (is_menu_set('form_four_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Form Four Books");
} else if (is_menu_set('publisher_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Publisher Books");
} else if (is_menu_set('self_publisher_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Self Publisher Books");
} else if (is_menu_set('printed_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Printed Books");
} else if (is_menu_set('digital_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Digital Books");
} else if (is_menu_set('audio_books') != "") {
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Bookhive | Audio Books");
} else if (is_menu_set('faq') != "") {
    $currentPage = WPATH . "modules/faq.php";
    set_title("Bookhive | FAQs");
} else if (is_menu_set('register') != "") {
    $currentPage = WPATH . "modules/register.php";
    set_title("Bookhive | Register");
} else if (is_menu_set('register_book_seller') != "") {
    $currentPage = WPATH . "modules/register_book_seller.php";
    set_title("Bookhive | Seller Registration");
} else if (is_menu_set('register_school') != "") {
    $currentPage = WPATH . "modules/register_school.php";
    set_title("Bookhive | School Registration");
} else if (is_menu_set('register_corporate') != "") {
    $currentPage = WPATH . "modules/register_corporate.php";
    set_title("Bookhive | Corporate Registration");
} else if (is_menu_set('register_individual_user') != "") {
    $currentPage = WPATH . "modules/register_individual_user.php";
    set_title("Bookhive | User Registration");
} else if (is_menu_set('register_self_publisher') != "") {
    $currentPage = WPATH . "modules/register_self_publisher.php";
    set_title("Bookhive | Publisher Registration");
} else if (is_menu_set('add_system_administrator') != "") {
    $currentPage = WPATH . "modules/add_system_administrator.php";
    set_title("Bookhive | Administrator Registration");
} else if (is_menu_set('verify_book') != "") {
    $currentPage = WPATH . "modules/verify_book.php";
    set_title("Bookhive | Verify Book");
} else if (is_menu_set('process_feedback') != "") {
    $currentPage = WPATH . "modules/process_feedback.php";
    set_title("Bookhive | Feedback");
} else if (is_menu_set('admin_requests') != "") {
    $currentPage = WPATH . "modules/admin_requests.php";
    set_title("Bookhive | External Requests");
} else if (!empty($_GET)) {
    App::redirectTo("?");
} else {
    $currentPage = WPATH . "modules/home.php";
    if (App::isLoggedIn()) {
        set_title("Bookhive | Home");
    }
}

if (App::isAjaxRequest())
    include $currentPage;
else {
    require WPATH . "core/template/layout.php";
}
?>