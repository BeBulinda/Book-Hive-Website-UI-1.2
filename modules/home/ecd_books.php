<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$books = new Books();
?>

<div class="flagship-store">
    <h2 class="title18">ECD BOOKS</h2>
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
                                $ecd_books_data[] = $books->execute();
                            } else {
                                $ecd_books_data[] = $books->getAllLevelBooks("ECD");
                            }
                            if (isset($_SESSION['no_ecd_records']) AND $_SESSION['no_ecd_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_ecd_records']);
                            } else if (isset($_SESSION['yes_ecd_records']) AND $_SESSION['yes_ecd_records'] == true) {
                                foreach ($ecd_books_data as $key => $value) {
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
                                                    <img src="<?php echo $location . $value2['cover_photo']; ?>" height="250" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                                </a>
                                                <a href="?quick-view&code=<?php echo $value2['id']; ?>" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                                <div class="product-price">
                                                    <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_ecd_records']);
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
                                $ecd_books_data[] = $books->execute();
                            } else {
                                $ecd_books_data[] = $books->getAllLevelBooks("ECD");
                            }
                            if (isset($_SESSION['no_ecd_records']) AND $_SESSION['no_ecd_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_ecd_records']);
                            } else if (isset($_SESSION['yes_ecd_records']) AND $_SESSION['yes_ecd_records'] == true) {
                                foreach ($ecd_books_data as $key => $value) {
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
                                                    <img src="<?php echo $location . $value2['cover_photo']; ?>" height="250" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                                </a>
                                                <a href="?quick-view&code=<?php echo $value2['id']; ?>" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                                <div class="product-price">
                                                    <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_ecd_records']);
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
                                $ecd_books_data[] = $books->execute();
                            } else {
                                $ecd_books_data[] = $books->getAllLevelBooks("ECD");
                            }
                            if (isset($_SESSION['no_ecd_records']) AND $_SESSION['no_ecd_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_ecd_records']);
                            } else if (isset($_SESSION['yes_ecd_records']) AND $_SESSION['yes_ecd_records'] == true) {
                                foreach ($ecd_books_data as $key => $value) {
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
                                                    <img src="<?php echo $location . $value2['cover_photo']; ?>" height="250" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                                </a>
                                                <a href="?quick-view&code=<?php echo $value2['id']; ?>" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                                <div class="product-price">
                                                    <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_ecd_records']);
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
                                $ecd_books_data[] = $books->execute();
                            } else {
                                $ecd_books_data[] = $books->getAllLevelBooks("ECD");
                            }
                            if (isset($_SESSION['no_ecd_records']) AND $_SESSION['no_ecd_records'] == true) {
                                ?>
                                <div style="text-align:left"><strong>No book found in this category...</strong></div>
                                <?php
                                unset($_SESSION['no_ecd_records']);
                            } else if (isset($_SESSION['yes_ecd_records']) AND $_SESSION['yes_ecd_records'] == true) {
                                foreach ($ecd_books_data as $key => $value) {
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
                                                    <img src="<?php echo $location . $value2['cover_photo']; ?>" height="250" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                                </a>
                                                <a href="?quick-view&code=<?php echo $value2['id']; ?>" class="quickview-link plus fancybox.iframe">quick view</a>
                                                <div class="product-extra-link">
                                                    <a href="#" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="compare-link"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                                <div class="product-price">
                                                    <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                unset($_SESSION['yes_ecd_records']);
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