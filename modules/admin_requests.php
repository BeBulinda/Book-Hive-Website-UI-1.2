<?php

require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();

if (isset($_GET['request_type']) || isset($_POST['request_type'])) {
    $request_type = isset($_GET['request_type']) ? $_GET['request_type'] : $_POST['request_type'];
    if ($request_type == "upload_book_photo") {
        $tmp_name = isset($_GET['tmp_name']) ? $_GET['tmp_name'] : $_POST['tmp_name'];
        $location = isset($_GET['location']) ? $_GET['location'] : $_POST['location'];
        if (move_uploaded_file($tmp_name, $location)) {
            $response['status'] = 200;
            $response['message'] = "Request processed successfully";
        } else {
            $response['status'] = 500;
            $response['message'] = "Error processing request";
        }
        $json_response = json_encode($response);
        $transactions->deliverResponse($json_response);
    }
}


