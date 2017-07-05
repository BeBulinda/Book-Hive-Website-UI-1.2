<?php
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Books.php";
$books = new Books();
$system_administration = new System_Administration();
$users = new Users();

$item_total = 0;


if (is_menu_set('ecd_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("level", "ecd_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('primary_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("level", "primary_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('secondary_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("level", "secondary_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('adult_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("level", "adult_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('english_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("type", "english_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('kiswahili_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("type", "kiswahili_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('activity_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("type", "activity_books");
    $_SESSION['category_books'] = $category_books;
}


//else if (is_menu_set('featured_books') != "") {
//    $category_books[] = $books->getAllCategoryBooks("ecd_books");
//    $_SESSION['category_books'] = $category_books;
//}
else if (is_menu_set('class_one_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_one_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_two_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_two_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_three_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_three_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_four_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_four_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_five_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_five_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_six_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_six_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_seven_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_seven_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_eight_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "class_eight_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('primary_revision_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("primary_class", "primary_revision_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('secondary_revision_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("secondary_class", "secondary_revision_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_one_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("secondary_class", "form_one_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_two_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("secondary_class", "form_two_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_three_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("secondary_class", "form_three_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_four_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("secondary_class", "form_four_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('publisher_books') != "") {
    $id = $_GET['id'];
    $category_books[] = $books->getAllCategoryBooks("publisher", $id);
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('printed_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("print_type", "printed_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('digital_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("print_type", "digital_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('audio_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("print_type", "audio_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('filtered_books') != "") {
    $_SESSION['category_books'] = $_SESSION['filtered_books'];
} else if (is_menu_set('searched_books') != "") {
    $_SESSION['category_books'] = $_SESSION['searched_books'];
}

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

$previous_url = $_SERVER['HTTP_REFERER'];
if (!empty($_POST)) {
    if ($_POST['action'] == "filter_books") {
        $filtered_books[] = $books->getAllFilteredBooks($_POST['publisher'], $_POST['book_level'], $_POST['book_type'], $_POST['print_type']);
        $_SESSION['filtered_books'] = $filtered_books;
    } else if ($_POST['action'] == "add") {
        $productByCode = $books->fetchBookDetails($_POST["code"]);
        $itemArray = array($productByCode["id"] => array('id' => $productByCode["id"], 'title' => $productByCode["title"], 'price' => $productByCode["price"], 'quantity' => $_POST["quantity"]));

        if (!empty($_SESSION["cart_item"])) {
            if (in_array($productByCode["id"], array_keys($_SESSION["cart_item"]))) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($productByCode["id"] == $v['id']) {
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
        App::redirectTo("{$previous_url}");
    }

//    App::redirectTo("?filtered_books");
}
?>

<div id="content">
    <div class="content-page grid-ajax-infinite">
        <?php //require_once 'modules/inc/breadcrumbs.php'; ?>
        <div class="container">
            <!-- End Bread Crumb -->            
            <div class="pull-left">
                <?php if (is_menu_set('storymoja_books') != "") { ?>
                    <a href="?"><img src="modules/images/logos/publishers/2843147YUO3FD5485628BEB798FF3ECF.png" width="150" alt="Publisher's Logo" /></a>
                <?php } else if (is_menu_set('klb_books') != "") { ?>
                    <a href="?"><img src="modules/images/logos/publishers/284331A7593FD5485628BEB798FF3ECF.jpg" width="150" alt="Publisher's Logo" /></a>
                <?php } else if (is_menu_set('phoenix_books') != "") { ?>
                    <a href="?"><img src="modules/images/logos/publishers/284ACF58993FD5485628BEB798FF3ECF.jpg" width="150" alt="Publisher's Logo" /></a>
                <?php } else if (is_menu_set('longhorn_books') != "") { ?>
                    <a href="?"><img src="modules/images/logos/publishers/112ERTA7593FD5485628BEB798FF3ECF.jpg" width="150" alt="Publisher's Logo" /></a>
                <?php } else if (is_menu_set('moran_books') != "") { ?>
                    <a href="?"><img src="modules/images/logos/publishers/284331A7593FD5485628BEB798ABC456.jpg" width="150" alt="Publisher's Logo" /></a>
                <?php }

//                else { 
                ?>
                <!--<a class="view-type" href="#" class="grid-view active"></a>-->
                <!--<a class="view-type" href="#" class="list-view"></a>-->
<?php // }  ?>                    
            </div>
            <div class="clearfix">
                <div class="pull-left">
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
                                <option value="AUDIO">AUDIO BOOKS</option>
                            </select>
                            <button type="submit" id="submitButton" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Sort PagiBar -->
            <ul class="grid-product-ajax list-unstyled clearfix">                
                <?php
                if (isset($_SESSION["category_books"])) {
                    if (isset($_SESSION['no_category_records']) AND $_SESSION['no_category_records'] == true) {
                        ?>
                        <div style="text-align:left"><strong>No book found in this category...</strong></div>
                        <?php
                        unset($_SESSION['no_category_records']);
                    } else if (isset($_SESSION['yes_category_records']) AND $_SESSION['yes_category_records'] == true) {
                        foreach ($_SESSION["category_books"] as $key => $value) {
                            $inner_array[$key] = $value; // json_decode($value, true); // this will give key val pair array
                            foreach ((array) $inner_array[$key] as $key2 => $value2) {
                                $publisher_details = $users->fetchPublisherDetails($value2['publisher']);

                                if ($value2['level_id'] == 1) {
                                    $location = 'modules/images/books/ecd/';
                                } else if ($value2['level_id'] == 2) {
                                    $location = 'modules/images/books/primary/';
                                } else if ($value2['level_id'] == 3) {
                                    $location = 'modules/images/books/secondary/';
                                } else if ($value2['level_id'] == 4) {
                                    $location = 'modules/images/books/adult/';
                                }
                                ?>

                                <li>
                                    <div class="item-pro-ajax">
                                        <div class="product-thumb">
                                            <a class="product-thumb-link" href="?product-page&code=<?php echo $value2['id']; ?>">
                                                <img src="<?php echo $location . $value2['cover_photo']; ?>" height="400" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                            </a>
                                            <a class="quickview-link fancybox.iframe" href="?quick-view&code=<?php echo $value2['id']; ?>"><span>quick view</span></a>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                            <div class="product-price">
                                                <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                            </div>
                                            <div class="product-rate">
                                                <div class="product-rating" style="width:90%"></div>
                                            </div>
                                            <div class="product-extra-link2">

                                                <form role="form" method="post">
                                                    <input type="hidden" name="action" value="add"/>
                                                    <input type="hidden" name="code" value="<?php echo $value2['id']; ?>"/>
                                                    <input type="hidden" name="quantity" value="1"/>
                                                    <input type="submit" class="addcart-link" value="Add to Cart" />
                                                </form>

                                                <!--                                                <a class="addcart-link" href="#">Add to Cart</a>
                                                                                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                                                                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>-->
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Item -->

                                <?php
                            }
                        }
//                        unset($_SESSION['yes_category_records']);
                    }
//                    unset($_SESSION['category_books']);
                }


//                if (isset($_SESSION["filtered_books"])) {
//                    if (isset($_SESSION['no_filtered_records']) AND $_SESSION['no_filtered_records'] == true) {
//                        
                ?>
                        <!--<div style="text-align:left"><strong>No book found in this category...</strong></div>-->
                <?php
//                        unset($_SESSION['no_filtered_records']);
//                    } else if (isset($_SESSION['yes_filtered_records']) AND $_SESSION['yes_filtered_records'] == true) {
//                        foreach ($_SESSION["filtered_books"] as $key => $value) {
//                            $inner_array[$key] = $value; // json_decode($value, true); // this will give key val pair array
//                            foreach ((array) $inner_array[$key] as $key2 => $value2) {
//                                $publisher_details = $users->fetchPublisherDetails($value2['publisher']);
//
//                                if ($value2['level_id'] == 1) {
//                                    $location = 'modules/images/books/ecd/';
//                                } else if ($value2['level_id'] == 2) {
//                                    $location = 'modules/images/books/primary/';
//                                } else if ($value2['level_id'] == 3) {
//                                    $location = 'modules/images/books/secondary/';
//                                } else if ($value2['level_id'] == 4) {
//                                    $location = 'modules/images/books/adult/';
//                                }
                ?>

                <!--                                <li>
                                                    <div class="item-pro-ajax">
                                                        <div class="product-thumb">
                                                            <a class="product-thumb-link" href="?product-page&code=//<?php // echo $value2['id'];  ?>">
                                                                <img src="<?php // echo $location . $value2['cover_photo'];  ?>" height="400" alt="<?php // echo $value2['title'] . " COVER PHOTO";  ?>"/>
                                                            </a>
                                                            <a class="quickview-link fancybox.iframe" href="?quick-view&code=//<?php // echo $value2['id'];  ?>"><span>quick view</span></a>
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-title"><a href="?product-page&code=//<?php // echo $value2['id'];  ?>"><?php // echo $value2['title'];  ?></a></h3>
                                                            <div class="product-price">
                                                                <ins><span><?php // echo "KES " . $value2['price'];  ?></span></ins>
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
                                                </li>-->
                <!-- End Item -->

                <?php
//                            }
//                        }
//                        unset($_SESSION['yes_filtered_records']);
//                    }
//                    unset($_SESSION['filtered_books']);
//                }
//
//                if (isset($_SESSION["searched_books"])) {
//                    if (isset($_SESSION['no_searched_records']) AND $_SESSION['no_searched_records'] == true) {
//                        
                ?>
                        <!--<div style="text-align:left"><strong>No book found in this category...</strong></div>-->
                <?php
//                        unset($_SESSION['no_searched_records']);
//                    } else if (isset($_SESSION['yes_searched_records']) AND $_SESSION['yes_searched_records'] == true) {
//                        foreach ($_SESSION["searched_books"] as $key => $value) {
//                            $inner_array[$key] = $value; // json_decode($value, true); // this will give key val pair array
//                            foreach ((array) $inner_array[$key] as $key2 => $value2) {
//                                $publisher_details = $users->fetchPublisherDetails($value2['publisher']);
//
//                                if ($value2['level_id'] == 1) {
//                                    $location = 'modules/images/books/ecd/';
//                                } else if ($value2['level_id'] == 2) {
//                                    $location = 'modules/images/books/primary/';
//                                } else if ($value2['level_id'] == 3) {
//                                    $location = 'modules/images/books/secondary/';
//                                } else if ($value2['level_id'] == 4) {
//                                    $location = 'modules/images/books/adult/';
//                                }
//                                
                ?>

                <!--                                <li>
                                                    <div class="item-pro-ajax">
                                                        <div class="product-thumb">
                                                            <a class="product-thumb-link" href="?product-page&code=//<?php // echo $value2['id'];  ?>">
                                                                <img src="//<?php // echo $location . $value2['cover_photo'];  ?>" height="400" alt="<?php // echo $value2['title'] . " COVER PHOTO";  ?>"/>
                                                            </a>
                                                            <a class="quickview-link fancybox.iframe" href="?quick-view&code=//<?php // echo $value2['id'];  ?>"><span>quick view</span></a>
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-title"><a href="?product-page&code=//<?php // echo $value2['id'];  ?>"><?php // echo $value2['title'];  ?></a></h3>
                                                            <div class="product-price">
                                                                <ins><span>//<?php // echo "KES " . $value2['price'];  ?></span></ins>
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
                                                </li>-->
                <!-- End Item -->

                <?php
//                            }
//                        }
//                        unset($_SESSION['yes_searched_records']);
//                    }
//                    unset($_SESSION['searched_books']);
//                }
                ?>

            </ul>
        </div>
    </div>
</div>
<!-- End Content -->