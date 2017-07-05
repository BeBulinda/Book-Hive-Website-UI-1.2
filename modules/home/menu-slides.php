<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$books = new Books();

$special_books[] = $books->getAllSpecialBooks();
?>

<div class="content-top4">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="content-top-left4">
                <div class="cat-icon4">
                    <div class="wrap-cat-icon">
                        <ul class="list-cat-icon">
<!--                            <li class="has-cat-mega">
                                <a href="#"><img src="images/cat-icon/cat2.png" alt=""><span>Special Books</span></a>
                                <div class="cat-mega-menu cat-mega-style2">
                                    <h2 class="title-cat-mega-menu">Special Books</h2>
                                    <div class="row">


                                        <?php
//                                        foreach ($special_books as $key => $value) {
//                                            $inner_array[$key] = json_decode($value, true); // this will give key val pair array
//                                            foreach ((array) $inner_array[$key] as $key2 => $value2) {
//                                                $publisher_details = $users->fetchPublisherDetails($value2['publisher']);
//
//                                                if ($value2['level_id'] == 1) {
//                                                    $location = 'modules/images/books/ecd/';
//                                                } else if ($value2['level_id'] == 2) {
//                                                    $location = 'modules/images/books/primary/';
//                                                } else if ($value2['level_id'] == 3) {
//                                                    $location = 'modules/images/books/secondary/';
//                                                } else if ($value2['level_id'] == 4) {
//                                                    $location = 'modules/images/books/adult/';
//                                                }
                                                ?>

                                                <div class="col-md-4 col-sm-3">
                                                    <div class="item-product-ajax item-product first-item">
                                                        <div class="product-thumb">
                                                            <a class="product-thumb-link" href="?product-page&code=<?php // echo $value2['id']; ?>">
                                                                <img src="<?php // echo $location . $value2['cover_photo']; ?>" height="200" alt="<?php // echo $value2['title'] . " COVER PHOTO"; ?>"/>
                                                            </a>
                                                            <a class="quickview-link plus fancybox.iframe" href="?quick-view&code=<?php // echo $value2['id']; ?>">quick view</a>
                                                            <div class="product-extra-link">
                                                                <a href="?quick-view&code=<?php // echo $value2['id'];    ?>" class="addcart-link"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                                                <a href="?product-page&code=<?php // echo $value2['id'];    ?>" class="wishlist-link"><i class="fa fa-heart" aria-hidden="true"></i></a>

                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-title"><a href="?product-page&code=<?php // echo $value2['id']; ?>"><?php // echo $value2['title']; ?></a></h3>
                                                            <div class="product-price">
                                                                <ins><span><?php // echo "KES " . $value2['price']; ?></span></ins>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
//                                            }
//                                        }
                                        ?>

                                    </div>
                                </div>
                            </li>-->
                            <!--<li><a href="?english_books"><img src="images/cat-icon/cat3.png" alt="" /><span>English Books</span></a></li>-->
                            <!--<li><a href="?kiswahili_books"><img src="images/cat-icon/cat4.png" alt="" /><span>Kiswahili Books</span></a></li>-->
                            <li><a href="?digital_books"><img src="images/cat-icon/cat2.png" alt="" /><span>Digital Books</span></a></li>
                            <li><a href="?audio_books"><img src="images/cat-icon/cat3.png" alt="" /><span>Audio Books</span></a></li>
                            <li><a href="?kiswahili_books"><img src="images/cat-icon/cat4.png" alt="" /><span>Kiswahili Books</span></a></li>
                            <li><a href="?activity_books"><img src="images/cat-icon/cat6.png" alt="" /><span>Activity Books</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="banner-slider banner-slider4 banner-direct-nav">
                    <div class="wrap-item" data-pagination="false" data-autoplay="true" data-navigation="true" data-itemscustom="[[0,1]]" data-transition="fade">
                        <div class="item-banner4">
                            <div class="banner-thumb">
                                <a href="http://localhost:8081/bookhive_v1.2_ui/?product-page&code=7"><img src="modules/images/carousel/1.png" height="400" width="950" alt=""/></a>
                            </div>
                        </div>
                        <div class="item-banner4">
                            <div class="banner-thumb">
                                <a href="http://localhost:8081/bookhive_v1.2_ui/?product-page&code=8"><img src="modules/images/carousel/2.png" height="400" width="950" alt=""/></a>
                            </div>
                        </div>
                        <div class="item-banner4">
                            <div class="banner-thumb">
                                <a href="http://localhost:8081/bookhive_v1.2_ui/?product-page&code=13"><img src="modules/images/carousel/3.png" height="400" width="950" alt=""/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="content-top-right4">
                <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-6">
                        <div class="item-adv item-adv4">
                            <div class="adv-thumb">
                                <a href="#"><img src="modules/images/logos/publishers/112ERTA7593FD5485628BEB798FF3ECF.jpg" alt="" /></a>
                            </div>
                            <div class="adv-info">
                                <!--<h2>Longhorn<br>Publishers</h2>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                        <div class="item-adv item-adv4">
                            <div class="adv-thumb">
                                <a href="#"><img src="modules/images/logos/publishers/284331A7593FD5485628BEB798ABC456.jpg" alt="" /></a>
                            </div>
                            <div class="adv-info">
                                <!--<h2>Moran <br>Publishers</h2>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content Top -->
