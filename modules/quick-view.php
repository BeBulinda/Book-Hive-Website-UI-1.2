
<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();
$books = new Books();

$code = $_GET['code'];
$_SESSION["selected_book_id"] = $code;
$book_details = $books->fetchBookDetails($code);
$book_type_details = $system_administration->fetchBookTypeDetails($book_details['type_id']);
$book_level_details = $system_administration->fetchBookLevelDetails($book_details['level_id']);
$book_publisher_details = $users->fetchPublisherDetails($book_details['publisher']);

if ($book_details['level_id'] == 1) {
    $location = 'modules/images/books/ecd/';
} else if ($book_details['level_id'] == 2) {
    $location = 'modules/images/books/primary/';
} else if ($book_details['level_id'] == 3) {
    $location = 'modules/images/books/secondary/';
} else if ($book_details['level_id'] == 4) {
    $location = 'modules/images/books/adult/';
}

//if (!empty($_POST) AND $_POST['action'] == "add") {
//    $productByCode = $books->fetchBookDetails($_POST["code"]);
//    $itemArray = array($productByCode["id"] => array('id' => $productByCode["id"], 'title' => $productByCode["title"], 'price' => $productByCode["price"], 'quantity' => $_POST["quantity"]));
//
//    if (!empty($_SESSION["cart_item"])) {
//        if (in_array($productByCode["id"], array_keys($_SESSION["cart_item"]))) {
//            foreach ($_SESSION["cart_item"] as $k => $v) {
//                if ($productByCode["id"] == $k) {
//                    if (empty($_SESSION["cart_item"][$k]["quantity"])) {
//                        $_SESSION["cart_item"][$k]["quantity"] = 0;
//                    }
//                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
//                }
//            }
//        } else {
//            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
//        }
//    } else {
//        $_SESSION["cart_item"] = $itemArray;
//    }
//}

?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="product-quickview">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="detail-gallery">
                            <div class="mid">
                                        <img src="<?php echo $location . $book_details['cover_photo']; ?>" alt="<?php echo $book_details['title'] . " COVER PHOTO"; ?>"/>
                            </div>
                        </div>
                        <!-- End Gallery -->
                        <?php require_once 'modules/inc/social-plug.php'; ?>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="detail-info">
                            <h2 class="title-detail"><?php echo $book_details['title']; ?></h2>
                            <div class="product-rate">
                                <div class="product-rating" style="width:90%"></div>
                            </div>
                            <div class="product-price">
                                <ins><span><?php echo "KES " . $book_details['price']; ?></span></ins>
                            </div>
                            <div class="available">
                                <strong>Availability: </strong>
                                <span class="in-stock">In Stock</span>
                            </div>
                            <!--<a class="mail-to-friend" href="mailto:">Email to a Friend</a>-->
                            <div class="attr-detail attr-color">
                                <div class="attr-title">
                                    <strong><sup>*</sup>Description:</strong>
                                </div>
                                <ul class="list-filter color-filter">
                                    <li><?php echo $book_details['description']; ?></li>
                                </ul>
                            </div>	
                            <div class="attr-detail attr-size">
                                <div class="attr-title">
                                    <strong><sup>*</sup>ISBN Number : <?php echo $book_details['isbn_number']; ?></strong>
                                    <br /><strong><sup>*</sup>Author : <?php echo $book_details['author']; ?></strong>
                                    <br /><strong><sup>*</sup>Publisher : <?php echo $book_publisher_details['company_name']; ?></strong>
                                </div>
                            </div>
                            <?php require_once 'modules/cart/increase-decrease.php'; ?>
                        </div>
                    </div>
                </div>	
            </div>	
        </div>	
    </div>
</div>
<!-- End Content -->