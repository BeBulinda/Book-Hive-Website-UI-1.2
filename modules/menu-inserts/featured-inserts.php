<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$books = new Books();

$main_featured_book[] = $books->getMainFeaturedBook();
$featured_books[] = $books->getAllFeaturedBooks();
?>
<div class="mega-menu">
    <div class="row">        
        <div class="col-md-5 col-sm-4 col-xs-12">
            <div class="mega-adv">

                <?php
                foreach ($main_featured_book as $key => $value) {
                    $inner_array[$key] = json_decode($value, true); // this will give key val pair array
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

                        <div class="banner-image">
                            <a href="?product-page&code=<?php echo $value2['id']; ?>"><img src="<?php echo $location . $value2['cover_photo']; ?>" width="300" height="200" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/></a>
                        </div>
                        <div class="mega-adv-info">
                            <h3 class="title18"><a href="?quick-view&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                            <p class="desc"><?php echo $value2['description']; ?></p>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-7 col-sm-8 col-xs-12">
            <div class="mega-new-arrival">
                <h2 class="mega-menu-title">Featured Books</h2>
                <div class="mega-new-arrival-slider">
                    <div class="wrap-item" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[768,2]]">

                        <?php
                        foreach ($featured_books as $key => $value) {
                            $inner_array[$key] = json_decode($value, true); // this will give key val pair array
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

                                <div class="item">
                                    <div class="item-product-ajax item-product">
                                        <div class="product-thumb">
                                            <a href="?product-page&code=<?php echo $value2['id']; ?>" class="product-thumb-link">
                                                <img src="<?php echo $location . $value2['cover_photo']; ?>" height="200" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                            </a>
                                            <a href="?quick-view&code=<?php echo $value2['id']; ?>" class="quickview-link plus fancybox.iframe">quick view</a>
                                            <div class="product-extra-link">
                                                <!--<a href="?quick-view&code=<?php // echo $value2['id']; ?>" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>-->
                                                <!--<a href="?product-page&code=<?php // echo $value2['id']; ?>" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>-->
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                            <div class="product-price">
                                                <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Mega Menu -->