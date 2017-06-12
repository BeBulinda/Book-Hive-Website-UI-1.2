
<?php
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
?>

<form role="form" method="post">
    <input type="hidden" name="action" value="add"/>
    <input type="hidden" name="code" value="<?php echo $_SESSION["selected_book_id"]; ?>"/>
    <div class="">
        <div class="btn-group btn-group-sm" role="group">
            <input type="button" class="btn btn-secondary btn-danger" onclick="decrementValue()" value="-" />
            <input type="text" class="btn btn-secondary" name="quantity" value="1" maxlength="2" max="10" size="1" id="number" readonly="" />
            <input type="button" class="btn btn-secondary btn-info" onclick="incrementValue()" value="+" />
        </div>
        <input type="submit" class="btn btn-secondary btn-success addcart" value="Add to Cart" />
    </div>
</form>