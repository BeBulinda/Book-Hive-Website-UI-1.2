<?php

require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();


if(isset($_FILES['cover_photo']['tmp_name'])) {
    if ($_POST['book_level'] == 1) {
        $location = 'modules/images/books/ecd/';
    } else if ($_POST['book_level'] == 2) {
        $location = 'modules/images/books/primary/';
    } else if ($_POST['book_level'] == 3) {
        $location = 'modules/images/books/secondary/';
    } else if ($_POST['book_level'] == 4) {
        $location = 'modules/images/books/adult/';
    }

    move_uploaded_file($_FILES['cover_photo']['tmp_name'], $location . $_POST['cover_name']);
}
