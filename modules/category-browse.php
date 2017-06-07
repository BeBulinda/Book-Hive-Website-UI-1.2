<div id="content">
    <div class="content-page grid-ajax-infinite">
            <?php require_once 'modules/inc/breadcrumbs.php'; ?>
        <div class="container">
            <!-- End Bread Crumb -->
            <div class="sort-pagi-bar clearfix">
                <!--                <div class="view-type pull-left">
                                    <a href="grid-ajax-infinite-scroll.html" class="grid-view active"></a>
                                    <a href="list-full-width.html" class="list-view"></a>
                                </div>-->
                <div class="sort-paginav pull-right">

                    <?php if (is_menu_set('publisher_books') != "") { ?>
                        <!--<div class="smart-search smart-search4">-->
                        <div class="select-category">
                            <a class="category-toggle-link" href="#"><span>Filter By Book Category</span></a>
                            <ul class="list-category-toggle list-unstyled">
                                <li><a href="?ecd_books">ECD Books</a></li>
                                <li><a href="?primary_books">Primary Books</a></li>
                                <li><a href="?secondary_books">Secondary Books</a></li>
                                <li><a href="?adult_books">Adult Reader Books</a></li>
                                <li><a href="?english_books">English Books</a></li>
                                <li><a href="?kiswahili_books">Kiswahili Books</a></li>
                                <li><a href="?activity_books">Activity Books</a></li>
                            </ul>
                        </div>
                        <!--</div>-->
                    <?php } ?>

                    <?php
                    if (is_menu_set('english_books') != ""
                            OR is_menu_set('kiswahili_books') != ""
                            OR is_menu_set('activity_books') != ""
                    ) {
                        ?>
                        <!--<div class="smart-search smart-search4">-->
                        <div class="select-category">
                            <a class="category-toggle-link" href="#"><span>Filter By Book Level</span></a>
                            <ul class="list-category-toggle list-unstyled">
                                <li><a href="?ecd_books">ECD Books</a></li>
                                <li><a href="?primary_books">Primary Books</a></li>
                                <li><a href="?secondary_books">Secondary Books</a></li>
                                <li><a href="?adult_books">Adult Reader Books</a></li>
                            </ul>
                        </div>
                        <!--</div>-->
                    <?php } ?>

                    <?php
                    if (is_menu_set('ecd_books') != ""
                            OR is_menu_set('primary_books') != ""
                            OR is_menu_set('secondary_books') != ""
                            OR is_menu_set('adult_books') != ""
                    ) {
                        ?>
                        <!--<div class="smart-search smart-search4">-->
                        <div class="select-category">
                            <a class="category-toggle-link" href="#"><span>Filter By Book Type</span></a>
                            <ul class="list-category-toggle list-unstyled">
                                <li><a href="?english_books">English Books</a></li>
                                <li><a href="?kiswahili_books">Kiswahili Books</a></li>
                                <li><a href="?activity_books">Activity Books</a></li>
                            </ul>
                        </div>
                        <!--</div>-->
                    <?php } ?>

                    <div class="sort-bar select-box">
                        <label>Sort By:</label>
                        <select>
                            <option value="">position</option>
                            <option value="">price</option>
                        </select>
                    </div>
                    <div class="show-bar select-box">
                        <label>Show:</label>
                        <select>
                            <option value="">20</option>
                            <option value="">12</option>
                            <option value="">24</option>
                        </select>
                    </div>
                </div>
            </div>
            <div></div>
            <!-- End Sort PagiBar -->
            <ul class="grid-product-ajax list-unstyled clearfix">
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/6.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/8.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/10.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/10.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <!-- End All -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/5.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/4.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/7.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/9.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/9.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <!-- End All -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/1.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/2.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/2.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <!-- End All -->
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/3.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/sport/4.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <div class="product-label">
                                <span class="new-label">new</span>
                                <span class="sale-label">sale</span>
                            </div>
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/4.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/beauty/5.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <li>
                    <div class="item-pro-ajax">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="?product-page">
                                <img alt="" src="images/photos/electronics/5.jpg">
                            </a>
                            <a class="quickview-link fancybox.iframe" href="?quick-view"><span>quick view</span></a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><a href="?product-page">Book Title</a></h3>
                            <div class="product-price">
                                <ins><span>KES.360.00</span></ins>
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
                <!-- End All -->
            </ul>
            <div class="btn-loadmore"><a href="#"><i aria-hidden="true" class="fa fa-spinner fa-spin"></i></a></div>
        </div>
    </div>
</div>
<!-- End Content -->