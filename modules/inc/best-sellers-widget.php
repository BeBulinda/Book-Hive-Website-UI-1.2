<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$books = new Books();

$best_seller_books[] = $books->getAllBestSellerBooks();
?>

<div class="widget widget-seller">
    <h2 class="widget-title title14">best sellers</h2>
    <div class="widget-content">
        <div class="wrap-item" data-pagination="false" data-navigation="true" data-items="[[0,1]]">
            <div class="list-pro-seller">

                <?php
                foreach ($best_seller_books as $key => $value) {
                    $inner_array[$key] = json_decode($value, true); // this will give key val pair array
                    foreach ((array) $inner_array[$key] as $key2 => $value2) {

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
                        <div class="item-pro-seller">
                            <div class="product-thumb">
                                <a href="?product-page&code=<?php echo $value2['id']; ?>" class="product-thumb-link"><img src="<?php echo $location . $value2['cover_photo']; ?>" alt="<?php echo $value2['title'] . " COVER PHOTO"; ?>"/></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="?product-page&code=<?php echo $value2['id']; ?>"><?php echo $value2['title']; ?></a></h3>
                                <div class="product-price">
                                    <ins><span><?php echo "KES " . $value2['price']; ?></span></ins>
                                    <del><span><?php echo "KES " . ($value2['price'] + ($value2['price'] * 0.20)); ?></span></del>
                                </div>
                                <div class="product-rate">
                                    <div style="width:90%" class="product-rating"></div>
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