<?php

date_default_timezone_set("Africa/Nairobi");
require_once WPATH . "modules/classes/Users.php";

class Transactions extends Database {

    public function execute() {
        if ($_POST['action'] == "add_piracy_report") {
            return $this->addPiracyReport();
        } else if ($_POST['action'] == "contact_us") {
            return $this->sendMessage();
        }
    }

    public function getTransactionId($payment_option, $transactedby, $total_amount) {
        $transaction_id = md5($payment_option . $transactedby . $total_amount . time());
        return strtoupper($transaction_id);
    }

    public function addTransaction() {
        $sql = "INSERT INTO transactions (id, transaction_type, amount, transactedby, payment_option)"
                . " VALUES (:transaction_id, :transaction_type, :amount, :transactedby, :payment_option)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("transaction_id", $_SESSION["transaction_id"]);
        $stmt->bindValue("transaction_type", 01);
        $stmt->bindValue("amount", $_SESSION["cart_total_cost"]);
        $stmt->bindValue("transactedby", $_SESSION["transactedby"]);
        $stmt->bindValue("payment_option", $_SESSION['payment_option']);
        $stmt->execute();

        //Add individual user
        $createdby = "WEBSITE USER";
        $users = new Users();
        $individual_user_id = $users->getNextIndividualUserId();
        $user_type = 'INDIVIDUAL USER';

        //individual details
        $sql = "INSERT INTO individual_users (firstname, lastname, gender, idnumber, createdby, lastmodifiedby)"
                . " VALUES (:firstname, :lastname, :gender, :idnumber, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("firstname", strtoupper($_SESSION["billing_firstname"]));
        $stmt->bindValue("lastname", strtoupper($_SESSION["billing_lastname"]));
        $stmt->bindValue("gender", strtoupper($_SESSION["billing_gender"]));
        $stmt->bindValue("idnumber", strtoupper($_SESSION["billing_id_passport_number"]));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby); //  echo $_SESSION['userid']);
        $stmt->execute();

        //individual contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", strtoupper($user_type));
        $stmt->bindValue("reference_id", $individual_user_id);
        $stmt->bindValue("phone_number", strtoupper($_SESSION["billing_phone_number"]));
        $stmt->bindValue("email", strtoupper($_SESSION["billing_email_address"]));
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //user login details
        //        $sql_userlogs = "INSERT INTO user_logs (ref_type, ref_id, username, password, lastmodifiedat, lastmodifiedby)"
//                . " VALUES (:ref_type, :ref_id, :username, :password, :lastmodifiedat, :lastmodifiedby)";
//
//        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
//        $stmt_userlogs->bindValue("ref_type", strtoupper($_POST['user_type']));
//        $stmt_userlogs->bindValue("ref_id", $user_id);
//        $stmt_userlogs->bindValue("username", $_POST['firstname']);
//        $stmt_userlogs->bindValue("password", sha1($_POST['lastname']));
//        $stmt_userlogs->bindValue("lastmodifiedby", $_POST['createdby']); //  echo $_SESSION['userid']);
//        $stmt_userlogs->bindValue("lastmodifiedat", date("Y-m-d H:i:s"));
//        $stmt_userlogs->execute();
//
//        $this->addUserToRole(strtoupper($_POST['user_type']), $user_id);
//        $this->addPrivilegesToUser(strtoupper($_POST['user_type']), $user_id);

        return true;
    }

    public function addTransactionDetails() {
        $sql = "INSERT INTO transaction_details (transaction_id, book_id, quantity, unit_price, book_version)"
                . " VALUES (:transaction_id, :book_id, :quantity, :unit_price, :book_version)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("transaction_id", $_SESSION["transaction_id"]);
        $stmt->bindValue("book_id", $_SESSION["book_id"]);
        $stmt->bindValue("quantity", $_SESSION["quantity"]);
        $stmt->bindValue("unit_price", $_SESSION['unit_price']);
        $stmt->bindValue("book_version", $_SESSION['book_version']);
        $stmt->execute();
        return true;
    }

    private function addPiracyReport() {
        $sql = "INSERT INTO piracy_reports (reporter_type, reported_by, seller_type, seller_name, book_title, book_photo, receipt_photo, description)"
                . " VALUES (:reporter_type, :reported_by, :seller_type, :seller_name, :book_title, :book_photo, :receipt_photo, :description)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reporter_type", strtoupper($_POST['reporter_type']));
        $stmt->bindValue("reported_by", strtoupper($_POST['reported_by']));
        $stmt->bindValue("seller_type", strtoupper($_POST['seller_type']));
        $stmt->bindValue("seller_name", strtoupper($_POST['seller_name']));
        $stmt->bindValue("book_title", strtoupper($_POST['book_title']));
        $stmt->bindValue("book_photo", $_SESSION['book_photo']);
        $stmt->bindValue("receipt_photo", $_SESSION['receipt_photo']);
        $stmt->bindValue("description", strtoupper($_POST['description']));
        $stmt->execute();
        return true;
    }

    private function sendMessage() {
        $sql = "INSERT INTO inbox_messages (name, email, subject, message) VALUES(:name, :email, :subject, :message)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("name", strtoupper($_POST['name']));
        $stmt->bindValue("email", strtoupper($_POST['email']));
        $stmt->bindValue("subject", strtoupper($_POST['subject']));
        $stmt->bindValue("message", strtoupper($_POST['message']));
        $stmt->execute();
        return true;
    }

//    
//    public function getAllPiracyReports() {
//        $sql = "SELECT * FROM piracy_reports ORDER BY id ASC";
//        $stmt = $this->prepareQuery($sql);
//        $stmt->execute();
//        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        if (count($info) == 0) {
//            $_SESSION['no_records'] = true;
//        } else {
//            $_SESSION['yes_records'] = true;
//            $values2 = array();
//            foreach ($info as $data) {
//                $values = array("id" => $data['id'], "reporter_type" => $data['reporter_type'], "reported_by" => $data['reported_by'], "seller_name" => $data['seller_name'], "book_photo" => $data['book_photo'], "receipt_photo" => $data['receipt_photo'], "description" => $data['description'], "createdat" => $data['createdat'], "reviewedat" => $data['reviewedat'], "reviewedby" => $data['reviewedby'], "status" => $data['status']);
//                array_push($values2, $values);
//            }
//            return json_encode($values2);
//        }
//    }
//
//    public function getAllTransactions() {
//        $sql = "SELECT * FROM transactions ORDER BY id ASC";
//        $stmt = $this->prepareQuery($sql);
//        $stmt->execute();
//        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        if (count($info) == 0) {
//            $_SESSION['no_records'] = true;
//        } else {
//            $_SESSION['yes_records'] = true;
//            $values2 = array();
//            foreach ($info as $data) {
//                $values = array("id" => $data['id'], "transaction_type" => $data['transaction_type'], "amount" => $data['amount'], "transactedby" => $data['transactedby'], "payment_option" => $data['payment_option'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "authorizedat" => $data['authorizedat'], "authorizedby" => $data['authorizedby'], "status" => $data['status']);
//                array_push($values2, $values);
//            }
//            return json_encode($values2);
//        }
//    }
//
//    public function getAllTransactionDetails() {
//        $sql = "SELECT * FROM transaction_details ORDER BY id ASC";
//        $stmt = $this->prepareQuery($sql);
//        $stmt->execute();
//        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        if (count($info) == 0) {
//            $_SESSION['no_records'] = true;
//        } else {
//            $_SESSION['yes_records'] = true;
//            $values2 = array();
//            foreach ($info as $data) {
//                $values = array("id" => $data['id'], "transaction_id" => $data['transaction_id'], "book_id" => $data['book_id'], "quantity" => $data['quantity'], "unit_price" => $data['unit_price']);
//                array_push($values2, $values);
//            }
//            return json_encode($values2);
//        }
//    }
}
