<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$books = new Books();
?>

<div class="flagship-store">
    <h2 class="title18">PUBLISHER BOOKS</h2>
    <div class="list-flagship-box">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="flagship-box">
                    <div class="flagship-header">
                        <div class="flagship-brand">
                            <a href="#"><img src="images/home4/pn1.png" alt="" /></a>
                        </div>
                        <div class="flagship-info">
                            <h2><span style="color:#00a7cd">Publisher's Name</span> Publisher's Slogan</h2>
                            <p>Brief promo text</p>
                        </div>
                        <div class="flagship-link">
                            <a href="#">Website</a>
                        </div>
                    </div>

                    <div class="flagship-content">
                        <div class="wrap-item" data-itemscustom="[[0,1],[480,2],[768,3],[1024,2],[1200,3]]" data-pagination="false">


                            <?php
                            if (!empty($_POST) AND $_POST['action'] == "filter_books") {
                                $one_books_data[] = $books->execute();
                            } else {
                                $one_books_data[] = $books->getAllPublisherBooks("STORY MOJA");
                            }
                            if (isset($_SESSION['no_1_records']) AND $_SESSION['no_1_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_1_records']);
                            } else if (isset($_SESSION['yes_1_records']) AND $_SESSION['yes_1_records'] == true) {
                                foreach ($one_books_data as $key => $value) {
                                    $inner_array[$key] = json_decode($value, true); // this will give key val pair array
                                    foreach ((array) $inner_array[$key] as $key2 => $value2) {
                                        $publisher_details = $users->fetchPublisherDetails($value2['publisher']);

                                        $url = "http://localhost/bookhive_ui/";
//                              $url = "http://live_url/bookhive_ui/"; 

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
                                        <div class="item-product4 item-product">
                                            <div class="product-thumb">
                                                <a href="?product-page&code=<?php echo $value2['id']; ?>" class="product-thumb-link">
                                                    <img src="images/photos/fashion/15.jpg" alt="" />
                                                </a>
                                                <a href="?quick-view" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>">book title</a></h3>
                                                <div class="product-price">
                                                    <ins><span>KES.360.00</span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_1_records']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flagship-box">
                    <div class="flagship-content">
                        <div class="wrap-item" data-itemscustom="[[0,1],[480,2],[768,3],[1024,2],[1200,3]]" data-pagination="false">

                            <?php
                            if (!empty($_POST) AND $_POST['action'] == "filter_books") {
                                $two_books_data[] = $books->execute();
                            } else {
                                $two_books_data[] = $books->getAllPublisherBooks("KENYA LITERATURE BUREAU");
                            }
                            if (isset($_SESSION['no_2_records']) AND $_SESSION['no_2_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_2_records']);
                            } else if (isset($_SESSION['yes_2_records']) AND $_SESSION['yes_2_records'] == true) {
                                foreach ($two_books_data as $key => $value) {
                                    $inner_array[$key] = json_decode($value, true); // this will give key val pair array
                                    foreach ((array) $inner_array[$key] as $key2 => $value2) {
                                        $publisher_details = $users->fetchPublisherDetails($value2['publisher']);

                                        $url = "http://localhost/bookhive_ui/";
//                              $url = "http://live_url/bookhive_ui/"; 

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
                                        <div class="item-product4 item-product">
                                            <div class="product-thumb">
                                                <a href="?product-page&code=<?php echo $value2['id']; ?>" class="product-thumb-link">
                                                    <img src="images/photos/fashion/15.jpg" alt="" />
                                                </a>
                                                <a href="?quick-view" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>">book title</a></h3>
                                                <div class="product-price">
                                                    <ins><span>KES.360.00</span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_2_records']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="flagship-box">
                    <div class="flagship-header">
                        <div class="flagship-brand">
                            <a href="#"><img src="images/home4/pn2.png" alt="" /></a>
                        </div>
                        <div class="flagship-info">
                            <h2><span style="color:#00a7cd">Publisher's Name</span> Publisher's Slogan</h2>
                            <p>Brief promo text</p>
                        </div>
                        <div class="flagship-link">
                            <a href="#">Website</a>
                        </div>
                    </div>
                    <div class="flagship-content">
                        <div class="wrap-item" data-itemscustom="[[0,1],[480,2],[768,3],[1024,2],[1200,3]]" data-pagination="false">


                            <?php
                            if (!empty($_POST) AND $_POST['action'] == "filter_books") {
                                $three_books_data[] = $books->execute();
                            } else {
                                $three_books_data[] = $books->getAllPublisherBooks("LONGHORN");
                            }
                            if (isset($_SESSION['no_3_records']) AND $_SESSION['no_3_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_3_records']);
                            } else if (isset($_SESSION['yes_3_records']) AND $_SESSION['yes_3_records'] == true) {
                                foreach ($three_books_data as $key => $value) {
                                    $inner_array[$key] = json_decode($value, true); // this will give key val pair array
                                    foreach ((array) $inner_array[$key] as $key2 => $value2) {
                                        $publisher_details = $users->fetchPublisherDetails($value2['publisher']);

                                        $url = "http://localhost/bookhive_ui/";
//                              $url = "http://live_url/bookhive_ui/"; 

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
                                        <div class="item-product4 item-product">
                                            <div class="product-thumb">
                                                <a href="?product-page&code=<?php echo $value2['id']; ?>" class="product-thumb-link">
                                                    <img src="images/photos/fashion/15.jpg" alt="" />
                                                </a>
                                                <a href="?quick-view" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>">book title</a></h3>
                                                <div class="product-price">
                                                    <ins><span>KES.360.00</span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_3_records']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flagship-box">
                    <div class="flagship-content">
                        <div class="wrap-item" data-itemscustom="[[0,1],[480,2],[768,3],[1024,2],[1200,3]]" data-pagination="false">

                            <?php
                            if (!empty($_POST) AND $_POST['action'] == "filter_books") {
                                $four_books_data[] = $books->execute();
                            } else {
                                $four_books_data[] = $books->getAllPublisherBooks("MORAN");
                            }
                            if (isset($_SESSION['no_4_records']) AND $_SESSION['no_4_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_4_records']);
                            } else if (isset($_SESSION['yes_4_records']) AND $_SESSION['yes_4_records'] == true) {
                                foreach ($four_books_data as $key => $value) {
                                    $inner_array[$key] = json_decode($value, true); // this will give key val pair array
                                    foreach ((array) $inner_array[$key] as $key2 => $value2) {
                                        $publisher_details = $users->fetchPublisherDetails($value2['publisher']);

                                        $url = "http://localhost/bookhive_ui/";
//                              $url = "http://live_url/bookhive_ui/"; 

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
                                        <div class="item-product4 item-product">
                                            <div class="product-thumb">
                                                <a href="?product-page&code=<?php echo $value2['id']; ?>" class="product-thumb-link">
                                                    <img src="images/photos/fashion/15.jpg" alt="" />
                                                </a>
                                                <a href="?quick-view" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>">book title</a></h3>
                                                <div class="product-price">
                                                    <ins><span>KES.360.00</span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_4_records']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Flag Ship -->