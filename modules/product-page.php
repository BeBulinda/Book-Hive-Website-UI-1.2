
<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();
$books = new Books();

$code = $_GET['code'];
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

require_once "core/template/header.php";
?>

<div id="content">
    <div class="content-page">
        <div class="container">
            <?php //require_once 'modules/inc/breadcrumbs.php'; ?>
            <!-- End Bread Crumb -->
            <div class="row">
                <div class="col-md-12">
                    <div class="product-detail detail-without-sidebar border radius">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="slider flexslider">
                                        <img src="<?php echo $location . $book_details['cover_photo']; ?>" alt="<?php echo $book_details['title'] . " COVER PHOTO"; ?>"/>
                                    </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail"><?php echo $book_details['title']; ?></h2>
                                    <div class="product-rate">
                                        <div style="width:90%" class="product-rating"></div>
                                    </div>
                                    <p class="desc"><?php echo $book_details['description']; ?></p>
                                    <div class="product-price">
                                        <ins><span><?php echo "KES. " . $book_details['price']; ?></span></ins>
                                    </div>	
                                    <div class="available">
                                        <strong>Availability: </strong>
                                        <span class="in-stock">In Stock</span>
                                    </div>
                                    <!--                                    <a href="#" class="mail-to-friend">Email to a Friend</a>-->
                                    <?php require_once 'modules/cart/increase-decrease.php'; ?>
                                </div>
                                <!-- Detail Info -->
                                <?php require_once 'modules/inc/social-plug.php'; ?>
                            </div>
                        </div>
                        <div class="tab-detal hoz-tab-detail">
                            <div class="hoz-tab-title">
                                <ul>
                                    <li class="active"><a href="#hoz1" data-toggle="tab">About Book</a></li>
                                    <li><a href="#hoz2" data-toggle="tab">Book Category</a></li>
                                    <li><a href="#hoz3" data-toggle="tab">Publication Details</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="hoz1" class="tab-pane active">
                                    <div class="hoz-tab-content">
                                        <div class="content-detail-tab">
                                            <div class="detail-tab-thumb">
                                                <img src="<?php echo $location . $book_details['cover_photo']; ?>" alt="<?php echo $book_details['title'] . " COVER PHOTO"; ?>"/>
                                            </div>
                                            <div class="detail-tab-info">
                                                <ul>
                                                    <li>ISBN Number - <?php echo $book_details['isbn_number']; ?></li>
                                                    <li>Title - <?php echo $book_details['title']; ?></li>
                                                </ul>
                                                <p class="desc"><?php echo $book_details['description']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="hoz2" class="tab-pane">
                                    <div class="hoz-tab-content">
                                        <div class="content-detail-tab">
                                            <div class="detail-tab-thumb">
                                                <img src="<?php echo $location . $book_details['cover_photo']; ?>" alt="<?php echo $book_details['title'] . " COVER PHOTO"; ?>"/>
                                            </div>
                                            <div class="detail-tab-info">
                                                <ul>
                                                    <li>Book Type - <?php echo $book_type_details['name']; ?></li>
                                                    <li>Book Level - <?php echo $book_level_details['name']; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="hoz3" class="tab-pane">
                                    <div class="hoz-tab-content">
                                        <div class="content-detail-tab">
                                            <div class="detail-tab-thumb">
                                                <img src="<?php echo $location . $book_details['cover_photo']; ?>" alt="<?php echo $book_details['title'] . " COVER PHOTO"; ?>"/>
                                            </div>
                                            <div class="detail-tab-info">
                                                <ul>
                                                    <li>Author - <?php echo $book_details['author']; ?></li>
                                                    <li>Publisher - <?php echo $book_publisher_details['company_name']; ?></li>
                                                    <li>Publication Year - <?php echo $book_details['publication_year']; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Main Detail -->
                    <div class="product-related border radius">
                        <h2 class="title18">ALSO PURCHASED</h2>
                        <div class="product-related-slider">
                            <div class="wrap-item" data-itemscustom="[[0,1],[480,2],[768,3],[980,4],[1200,5]]" data-pagination="false" data-navigation="true">
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/5.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/9.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/4.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/10.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/6.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/15.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/16.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                                <div class="item-pro-ajax">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link">
                                            <img src="images/photos/electronics/7.jpg" alt="">
                                        </a>
                                        <a href="?quick-view" class="quickview-link fancybox.iframe"><span>quick view</span></a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-price">
                                            <ins><span>KES.360.00</span></ins>
                                        </div>
                                        <h3 class="product-title"><a href="detail.html">Book Title by Author</a></h3>
                                        <div class="product-rate">
                                            <div style="width:90%" class="product-rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                            </div>
                        </div>
                    </div>
                    <!-- End Product Related -->
                </div>
            </div>
        </div>	
    </div>
</div>