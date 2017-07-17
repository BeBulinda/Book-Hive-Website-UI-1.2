<?php
//if (!App::isLoggedIn())
//    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$code = $_GET['code'];
$update_type = $_GET['update_type'];
$item = $_GET['item'];

if ($update_type == "approve") {
    if ($item == 'delivery') {
        $success = $transactions->approveItemDelivery($code);
        App::redirectTo("?home");
    }
} else if ($update_type == "reject") {
    if ($item == 'delivery') {
        $success = $transactions->rejectItemDelivery($code);
        App::redirectTo("?home");
    }
}
?>
