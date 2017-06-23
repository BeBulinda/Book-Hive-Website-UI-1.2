
<?php
require_once WPATH . "modules/classes/Books.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$system_administration = new System_Administration();
$users = new Users();
$books = new Books();

if (!empty($_GET["cart_action"])) {
    switch ($_GET["cart_action"]) {
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            unset($_SESSION["item_total"]);
            break;
    }
}
?>

<div class="mini-cart-box">
    <a class="mini-cart-link" href="?cart" title="Click icon to view cart">
        <span class="mini-cart-icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
        <span class="mini-cart-number"><?php echo $_SESSION["cart_number_of_items"]; ?></span>
    </a>
    <?php
    if (isset($_SESSION["cart_item"])) {
        $item_total = 0;
        ?>
        <div class="mini-cart-content">
            <h2>(<?php echo $_SESSION["cart_number_of_items"]; ?>) ITEMS IN MY CART</h2>
            <ul class="list-mini-cart-item list-unstyled">
                <?php
                foreach ($_SESSION["cart_item"] as $item) {
                    $sub_item_total = ($item["price"] * $item["quantity"]);
                    $book_details = $books->fetchBookDetails($item["id"]);

                    if ($book_details['level_id'] == 1) {
                        $location = 'modules/images/books/ecd/';
                    } else if ($book_details['level_id'] == 2) {
                        $location = 'modules/images/books/primary/';
                    } else if ($book_details['level_id'] == 3) {
                        $location = 'modules/images/books/secondary/';
                    } else if ($book_details['level_id'] == 4) {
                        $location = 'modules/images/books/adult/';
                    }
                    ?>
                    <li>
                        <div class="mini-cart-edit">
                            <a class="delete-mini-cart-item" href="#"><i class="fa fa-trash-o"></i></a>
                            <a class="edit-mini-cart-item" href="#"><i class="fa fa-pencil"></i></a>
                        </div>
                        <div class="mini-cart-thumb">
                            <a href="#">  <img src="<?php echo $location . $book_details['cover_photo']; ?>" alt="<?php echo $book_details['title'] . " COVER PHOTO"; ?>"/>  <!--<img alt="" src="images/home1/mini-cart-thumb.png">--> </a>
                        </div>
                        <div class="mini-cart-info">
                            <h3><a href="#"><?php echo $book_details['title']; ?></a></h3>
                            <div class="">
                                <span><?php echo "QTY : " . $item["quantity"]; ?></span>
                            </div>
                            <div class="info-price">
                                <span><?php echo "KES " . $sub_item_total; ?></span>
                            </div>
                            
<!--                            <form role="form">
                                <div class="">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <input type="button" class="btn btn-secondary btn-danger" onclick="decrementValue()" value="-" />
                                        <input type="text" class="btn btn-secondary" name="quantity" value="1" maxlength="2" max="10" size="1" id="number" readonly="" />
                                        <input type="button" class="btn btn-secondary btn-info" onclick="incrementValue()" value="+" />
                                    </div>
                                </div>
                            </form>-->
                        </div>
                    </li>

                    <?php
                    $item_total += ($item["price"] * $item["quantity"]);
                }
                ?>

            </ul>
            <div class="mini-cart-total">
                <label>TOTAL</label>
                <span><?php echo "KES " . $item_total; ?></span>
            </div>
            <div class="mini-cart-button">
                <a class="mini-cart-view" href="?cart">view my cart </a>
                <a class="mini-cart-checkout" href="?checkout">Checkout</a>
            </div>
        </div>
    <?php } ?>
</div>
<!-- End Mini Cart -->