
<?php

require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$books = new Books();

if (isset($_SESSION["transaction_status"])) {
    if ($_SESSION["transaction_status"] == "success") {
        ?>
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Your transaction was processed successfully. Kindly check your email for the invoice/receipt.</strong> 
        </div>
        <?php
    } else if ($_SESSION["transaction_status"] == "success") {
        ?>
        <div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error processing your transaction. Please try again.</strong>
        </div>
        <?php
    }
    unset($_SESSION['transaction_status']);
}

if (!empty($_POST) AND $_POST['action'] == "add") {
    $productByCode = $books->fetchBookDetails($_POST["code"]);
    $itemArray = array($productByCode["id"] => array('id' => $productByCode["id"], 'title' => $productByCode["title"], 'price' => $productByCode["price"], 'quantity' => $_POST["quantity"]));

    if (!empty($_SESSION["cart_item"])) {
        if (in_array($productByCode["id"], array_keys($_SESSION["cart_item"]))) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($productByCode["id"] == $k) {
                    if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                }
            }
        } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
        }
    } else {
        $_SESSION["cart_item"] = $itemArray;
    }
}
?>

<div id="content">
    <div class="container">
        <?php require_once ('modules/home/menu-slides.php'); ?>
        <?php //require_once ('modules/home/thumbs.php'); ?>
        <?php // require_once ('modules/home/best-sellers.php'); ?>
        <?php // require_once ('modules/home/advantage.php'); ?>
        <?php // require_once ('modules/home/new-arrivals.php'); ?>
        <?php //require_once ('modules/home/advantage-2.php'); ?>
        <?php // include ('modules/home/publisher_books.php'); ?>
        <?php include ('modules/home/ecd_books.php'); ?>
        <?php include ('modules/home/primary_books.php'); ?>
        <?php include ('modules/home/secondary_books.php'); ?>
        <?php include ('modules/home/adult_books.php'); ?>
        <?php // include_once ('modules/home/flagship-stores.php'); ?>
        <?php //require_once ('modules/home/advantage-3.php'); ?>
        <?php //require_once ('modules/home/fashion.php'); ?>
        <?php //require_once ('modules/home/electronics.php'); ?>
        <?php //require_once ('modules/home/homeware.php'); ?>
        <?php //require_once ('modules/home/beauty-&-health.php'); ?>
        <?php //require_once ('modules/home/sports.php'); ?>
        <?php //require_once ('modules/home/more-category.php'); ?>
    </div>
</div>
<!-- End Content -->
