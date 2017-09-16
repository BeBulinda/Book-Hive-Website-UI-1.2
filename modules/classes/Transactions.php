<?php

date_default_timezone_set("Africa/Nairobi");
require_once WPATH . "modules/classes/Users.php";

class Transactions extends Database {

    public function execute() {
        if ($_POST['action'] == "add_piracy_report") {
            return $this->addPiracyReport();
        } else if ($_POST['action'] == "contact_us") {
            return $this->sendMessage();
        } else if ($_POST['action'] == "verify_book") {
            return $this->verifyBook();
        }
    }

    private function verifyBook() {
//        $sql = "SELECT * FROM book_codes WHERE publisher=:publisher AND number=:number AND status=:status";
        $sql = "SELECT * FROM book_codes WHERE publisher_name=:publisher_name AND code=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("publisher_name", strtoupper($_POST['publisher_name']));
        $stmt->bindValue("code", strtoupper($_POST['code']));
//        $stmt->bindValue("status", 1021);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) == 0) {
            return false;
        } else {
            $data = $data[0];
            $sql2 = "UPDATE book_codes SET status=:status WHERE id=:code_id";
            $stmt2 = $this->prepareQuery($sql2);
            $stmt2->bindValue("code_id", $data['id']);
            $stmt2->bindValue("status", 1002);
            $stmt2->execute();
            return true;
        }
    }

    public function approveItemDelivery($code) {
        $sql = "UPDATE transaction_details SET delivery_status=1031, deliveredat=:deliveredat WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("code", $code);
        $stmt->bindValue("deliveredat", date("Y-m-d H:i:s"));
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    public function rejectItemDelivery($code) {
        $sql = "UPDATE transaction_details SET delivery_status=1030, deliveredat=:deliveredat WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("code", $code);
        $stmt->bindValue("deliveredat", date("Y-m-d H:i:s"));
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    public function deliverResponse($response) {
        header("HTTP/1.1 $response");
        echo $response;
    }

    public function getTransactionId($payment_option, $transactedby, $total_amount) {
        $transaction_id = md5($payment_option . $transactedby . $total_amount . time());
        return strtoupper($transaction_id);
    }

    public function addTransaction() {
        if (!App::isLoggedIn()) {
            $users = new Users();
            $username_check = $users->checkIfUsernameExists(strtoupper($_SESSION["billing_email_address"]));
            $email_check = $users->checkIfUserEmailExists(strtoupper($_SESSION["billing_email_address"]));

            if ($username_check == false && $email_check == false) {
                //Add individual user
                $createdby = "WEBSITE USER";
                $individual_user_id = $users->getNextIndividualUserId();
                $user_type_reference_id = $users->getUserTypeRefId("INDIVIDUAL USER");

                $buyer_type = $user_type_reference_id;
                $buyer_id = $individual_user_id;

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
                $stmt->bindValue("reference_type", $user_type_reference_id);
                $stmt->bindValue("reference_id", $individual_user_id);
                $stmt->bindValue("phone_number", strtoupper($_SESSION["billing_phone_number"]));
                $stmt->bindValue("email", strtoupper($_SESSION["billing_email_address"]));
                $stmt->bindValue("lastmodifiedby", $createdby);
                $stmt->execute();

                //User Login details
                $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                        . " VALUES (:reference_type, :reference_id, :username, :password)";

                $stmt_userlogs = $this->prepareQuery($sql_userlogs);
                $stmt_userlogs->bindValue("reference_type", strtoupper($user_type_reference_id));
                $stmt_userlogs->bindValue("reference_id", $individual_user_id);
                $stmt_userlogs->bindValue("username", strtoupper($_SESSION["billing_email_address"]));
                $stmt_userlogs->bindValue("password", sha1($_SESSION["billing_lastname"] . "123"));
                $stmt_userlogs->execute();

                $sender = "hello@bookhivekenya.com";
                $headers = "From: Bookhive Kenya <$sender>\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $subject = "Account Creation";
                $message = "<html><body>"
                        . "<p><b>Hello " . $_SESSION["billing_firstname"] . ",</b><br/>"
                        . "Thank you for signing up on Book Hive Kenya. Your login credentials are: <br/>"
                        . "<ul>"
                        . "<li><b>Username: </b>" . $_SESSION["billing_email_address"] . "</li>"
                        . "<li><b>Password: </b>" . $_SESSION["billing_lastname"] . "123" . "</li>"
                        . "</ul>"
                        . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                        . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                        . "</body></html>";
                mail(strtoupper($_SESSION["billing_email_address"]), $subject, $message, $headers);
            } else {
                $users = new Users();
                $user_login_details = $users->fetchUserLoginDetails(strtoupper($_SESSION["billing_email_address"]));
                $buyer_type = $user_login_details['reference_type'];
                $buyer_id = $user_login_details['reference_id'];
            }
        } else {
            $buyer_type = $_SESSION['login_user_type'];
            $buyer_id = $_SESSION['userid'];
        }

        $sql = "INSERT INTO transactions (id, amount, buyer_type, buyer_id, different_address, payment_option)"
                . " VALUES (:transaction_id, :amount, :buyer_type, :buyer_id, :different_address, :payment_option)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("transaction_id", $_SESSION["transaction_id"]);
        $stmt->bindValue("amount", $_SESSION["cart_total_cost"]);
        $stmt->bindValue("buyer_type", $buyer_type);
        $stmt->bindValue("buyer_id", $buyer_id);
        $stmt->bindValue("different_address", strtoupper($_SESSION["billing_different_address_value"]));
        $stmt->bindValue("payment_option", strtoupper($_SESSION['payment_option']));
        $stmt->execute();

        return true;
    }

    public function addTransactionDetails() {
        $sql = "INSERT INTO transaction_details (transaction_id, book_id, quantity, unit_price, print_type, publisher_type, publisher)"
                . " VALUES (:transaction_id, :book_id, :quantity, :unit_price, :print_type, :publisher_type, :publisher)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("transaction_id", $_SESSION["transaction_id"]);
        $stmt->bindValue("book_id", $_SESSION["book_id"]);
        $stmt->bindValue("quantity", $_SESSION["quantity"]);
        $stmt->bindValue("unit_price", $_SESSION['unit_price']);
        $stmt->bindValue("print_type", $_SESSION['book_details']['print_type']);
        $stmt->bindValue("publisher_type", $_SESSION['book_details']['publisher_type']);
        $stmt->bindValue("publisher", $_SESSION['book_details']['publisher']);
        $stmt->execute();
        return true;
    }

    private function addPiracyReport() {
        $sql = "INSERT INTO piracy_reports (reporter_type, reported_by, seller_type, seller_name, book_title, book_photo, receipt_photo, county, sub_county, location, description)"
                . " VALUES (:reporter_type, :reported_by, :seller_type, :seller_name, :book_title, :book_photo, :receipt_photo, :county, :sub_county, :location, :description)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reporter_type", strtoupper($_POST['reporter_type']));
        $stmt->bindValue("reported_by", strtoupper($_POST['reported_by']));
        $stmt->bindValue("seller_type", strtoupper($_POST['seller_type']));
        $stmt->bindValue("seller_name", strtoupper($_POST['seller_name']));
        $stmt->bindValue("book_title", strtoupper($_POST['book_title']));
        $stmt->bindValue("book_photo", $_SESSION['book_photo']);
        $stmt->bindValue("receipt_photo", $_SESSION['receipt_photo']);
        $stmt->bindValue("county", $_POST['county']);
        $stmt->bindValue("sub_county", $_POST['sub_county']);
        $stmt->bindValue("location", $_POST['location']);
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
