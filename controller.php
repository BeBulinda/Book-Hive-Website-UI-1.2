<?php

require WPATH . "core/include.php";
$currentPage = "";

if ( is_menu_set('logout') != "" ) 
    App::logOut();

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

else if ( is_menu_set('detail') != ""){
    $currentPage = WPATH . "modules/detail.php";
    set_title("Site Title | Product Details");
}

else if ( is_menu_set('about') != ""){
    $currentPage = WPATH . "modules/about.php";
    set_title("Site Title | About Us");
}

else if ( is_menu_set('404') != ""){
    $currentPage = WPATH . "modules/404.php";
    set_title("Site Title | Ooops Sorry");
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