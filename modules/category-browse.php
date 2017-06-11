<?php
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Books.php";
$books = new Books();
$system_administration = new System_Administration();
$users = new Users();

$item_total = 0;


if (is_menu_set('ecd_books') != "") {
    $category_books[] = $books->getAllCategoryLevelBooks("ecd_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('primary_books') != "") {
    $category_books[] = $books->getAllCategoryLevelBooks("primary_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('secondary_books') != "") {
    $category_books[] = $books->getAllCategoryLevelBooks("secondary_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('adult_books') != "") {
    $category_books[] = $books->getAllCategoryLevelBooks("adult_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('english_books') != "") {
    $category_books[] = $books->getAllCategoryTypeBooks("english_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('kiswahili_books') != "") {
    $category_books[] = $books->getAllCategoryTypeBooks("kiswahili_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('activity_books') != "") {
    $category_books[] = $books->getAllCategoryTypeBooks("activity_books");
    $_SESSION['category_books'] = $category_books;
}


//else if (is_menu_set('featured_books') != "") {
//    $category_books[] = $books->getAllCategoryBooks("ecd_books");
//    $_SESSION['category_books'] = $category_books;
//}


else if (is_menu_set('class_one_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_one_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_two_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_two_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_three_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_three_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_four_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_four_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_five_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_five_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_six_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_six_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_seven_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_seven_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('class_eight_books') != "") {
    $category_books[] = $books->getAllPrimaryCategoryBooks("class_eight_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_one_books') != "") {
    $category_books[] = $books->getAllSecondaryCategoryBooks("form_one_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_two_books') != "") {
    $category_books[] = $books->getAllSecondaryCategoryBooks("form_two_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_three_books') != "") {
    $category_books[] = $books->getAllSecondaryCategoryBooks("form_three_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('form_four_books') != "") {
    $category_books[] = $books->getAllSecondaryCategoryBooks("form_four_books");
    $_SESSION['category_books'] = $category_books;
} else if (is_menu_set('publisher_books') != "") {
    $category_books[] = $books->getAllCategoryBooks("publisher_books");
    $_SESSION['category_books'] = $category_books;
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

if (!empty($_POST)) {
    if ($_POST['action'] == "filter_books") {
        $filtered_books[] = $books->getAllFilteredBooks($_POST['publisher'], $_POST['book_level'], $_POST['book_type'], $_POST['print_type']);
        $_SESSION['filtered_books'] = $filtered_books;
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
                                                <a class="addcart-link" href="#">Add to Cart</a>
                                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Item -->

                                <?php
                            }
                        }
                        unset($_SESSION['yes_category_records']);
                    }
                    unset($_SESSION['category_books']);
                }
                
                
                if (isset($_SESSION["filtered_books"])) {
                    if (isset($_SESSION['no_filtered_records']) AND $_SESSION['no_filtered_records'] == true) {
                        ?>
                        <div style="text-align:left"><strong>No book found in this category...</strong></div>
                        <?php
                        unset($_SESSION['no_filtered_records']);
                    } else if (isset($_SESSION['yes_filtered_records']) AND $_SESSION['yes_filtered_records'] == true) {
                        foreach ($_SESSION["filtered_books"] as $key => $value) {
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
                                                <a class="addcart-link" href="#">Add to Cart</a>
                                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Item -->

                                <?php
                            }
                        }
                        unset($_SESSION['yes_filtered_records']);
                    }
                    unset($_SESSION['filtered_books']);
                }

                if (isset($_SESSION["searched_books"])) {
                    if (isset($_SESSION['no_searched_records']) AND $_SESSION['no_searched_records'] == true) {
                        ?>
                        <div style="text-align:left"><strong>No book found in this category...</strong></div>
                        <?php
                        unset($_SESSION['no_searched_records']);
                    } else if (isset($_SESSION['yes_searched_records']) AND $_SESSION['yes_searched_records'] == true) {
                        foreach ($_SESSION["searched_books"] as $key => $value) {
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
                                                <a class="addcart-link" href="#">Add to Cart</a>
                                                <a class="wishlist-link" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a>
                                                <a class="compare-link" href="#"><i aria-hidden="true" class="fa fa-refresh"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Item -->

                                <?php
                            }
                        }
                        unset($_SESSION['yes_searched_records']);
                    }
                    unset($_SESSION['searched_books']);
                }
                ?>

            </ul>
        </div>
    </div>
</div>
<!-- End Content -->