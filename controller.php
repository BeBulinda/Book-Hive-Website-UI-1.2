<?php

require WPATH . "core/include.php";
$currentPage = "";

if ( is_menu_set('logout') != "" ) 
    App::logOut();

if ( is_menu_set('home') != ""){
    $currentPage = WPATH . "modules/home.php";
    set_title("Bookhive Kenya | Home");
}

else if ( is_menu_set('?') != ""){
    $currentPage = WPATH . "modules/home.php";
    set_title("Site Title | Home");
}

else if ( is_menu_set('cart') != ""){
    $currentPage = WPATH . "modules/cart.php";
    set_title("Site Title | My Cart");
}

else if ( is_menu_set('checkout') != ""){
    $currentPage = WPATH . "modules/checkout.php";
    set_title("Site Title | Checkout");
}

else if ( is_menu_set('contact') != ""){
    $currentPage = WPATH . "modules/contact.php";
    set_title("Site Title | Contact Us");
}

else if ( is_menu_set('report-piracy') != ""){
    $currentPage = WPATH . "modules/report-piracy.php";
    set_title("Site Title | Report Piracy");
}

else if ( is_menu_set('tac') != ""){
    $currentPage = WPATH . "modules/tac.php";
    set_title("Site Title | Term & Conditions");
}

/** An alternative to product page **/
//else if ( is_menu_set('detail') != ""){
//    $currentPage = WPATH . "modules/detail.php";
//    set_title("Site Title | Product Details");
//}

else if ( is_menu_set('about') != ""){
    $currentPage = WPATH . "modules/about.php";
    set_title("Site Title | About Us");
}

else if ( is_menu_set('404') != ""){
    $currentPage = WPATH . "modules/404.php";
    set_title("Site Title | Ooops Sorry");
}

else if ( is_menu_set('profile') != ""){
    $currentPage = WPATH . "modules/profile.php";
    set_title("Site Title | My Profile");
}

else if ( is_menu_set('wishlist') != ""){
    $currentPage = WPATH . "modules/wishlist.php";
    set_title("Site Title | My Wishlist");
}

else if ( is_menu_set('compare') != ""){
    $currentPage = WPATH . "modules/compare.php";
    set_title("Site Title | Compare");
}

else if ( is_menu_set('login') != ""){
    $currentPage = WPATH . "modules/login.php";
    set_title("Site Title | Sign In");
}

else if ( is_menu_set('ecd') != ""){
    $currentPage = WPATH . "modules/ecd.php";
    set_title("Site Title | ECD Books");
}

else if ( is_menu_set('featured') != ""){
    $currentPage = WPATH . "modules/featured.php";
    set_title("Site Title | Featured Books");
}

else if ( is_menu_set('primary') != ""){
    $currentPage = WPATH . "modules/primary.php";
    set_title("Site Title | Primary Books");
}

else if ( is_menu_set('secondary') != ""){
    $currentPage = WPATH . "modules/secondary.php";
    set_title("Site Title | Secondary Books");
}

else if ( is_menu_set('lifestyle') != ""){
    $currentPage = WPATH . "modules/lifestyle.php";
    set_title("Site Title | Lifestyle Books");
}

else if ( is_menu_set('religious') != ""){
    $currentPage = WPATH . "modules/religious.php";
    set_title("Site Title | Religious Books");
}

else if ( is_menu_set('product-page') != ""){
    $currentPage = WPATH . "modules/product-page.php";
    set_title("Site Title | Product Pages");
}

else if ( is_menu_set('quick-view') != ""){
    $currentPage = WPATH . "modules/quick-view.php";
    set_title("Site Title | Product Pages");
}

else if ( is_menu_set('category-browse') != ""){
    $currentPage = WPATH . "modules/category-browse.php";
    set_title("Site Title | Category");
}

else if ( is_menu_set('faq') != ""){
    $currentPage = WPATH . "modules/faq.php";
    set_title("Site Title | FAQs");
}

else if ( is_menu_set('register') != ""){
    $currentPage = WPATH . "modules/register.php";
    set_title("Site Title | Register");
}

else if (!empty($_GET)) {
    App::redirectTo("?");
}

else{
    $currentPage = WPATH . "modules/home.php";
    if ( App::isLoggedIn() ) {
		set_title("Home | Site Title");                
	}        
}

if (App::isAjaxRequest())
    include $currentPage;
else {
    require WPATH . "core/template/layout.php";
}
?>