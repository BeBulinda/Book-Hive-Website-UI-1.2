<?php

date_default_timezone_set("Africa/Nairobi");

/** Mail Script * */
//require WPATH . "modules/phpmailer/PHPMailerAutoload.php";
//
//$mail = new PHPMailer;
//
////$mail->SMTPDebug = 3;                               // Enable verbose debug output
////$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'mail.staqpesa.com;smtp.staqpesa.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'do@staqpesa.com';                 // SMTP username
//$mail->Password = '#do@1234';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 465;                                    // TCP port to connect to
//
//$mail->setFrom('do@staqpesa.com', 'Staqpesa Information');

/** Mail Script END * */
class Users extends Database {

    public function execute() {
        if ($_POST['action'] == "login") {
            return $this->loginSystem();
        }


//           else if ($_POST['action'] == "update_password") {
//            return $this->updatePassword();
//        } 
//        
//        
        else if ($_POST['action'] == "forgot_password") {
            return $this->forgotPassword();
        }
//        
//        
//        else 
//        if ($_POST['action'] == "add_publisher") {
//            return $this->addPublisher();
//        } else if ($_POST['action'] == "edit_publisher") {
//            return $this->editPublisher();
//        } else 



        if ($_POST['action'] == "register_corporate") {
            return $this->addCorporate();
        } elseif ($_POST['action'] == "register_school") {
            return $this->addSchool();
        } else if ($_POST['action'] == "register_corporate") {
            return $this->editCorporate();
        } else if ($_POST['action'] == "register_book_seller") {
            return $this->addBookSeller();
        } else if ($_POST['action'] == "edit_book_seller") {
            return $this->editBookSeller();
        } else if ($_POST['action'] == "add_individual_user") {
            return $this->addIndividualUser();
        } else if ($_POST['action'] == "edit_individual_user") {
            return $this->editIndividualUser();
        } else if ($_POST['action'] == "add_self_publisher") {
            return $this->addSelfPublisher();
        } else if ($_POST['action'] == "add_system_administrator") {
            return $this->addSystemAdministrator();
        } else if ($_POST['action'] == "edit_system_administrator") {
            return $this->editSystemAdministrator();
        } else if ($_POST['action'] == "add_guest_user") {
            return $this->addGuestUser();
        } else if ($_POST['action'] == "edit_guest_user") {
            return $this->editGuestUser();
        } else if ($_POST['action'] == "add_contact") {
            return $this->addContact();
        } else if ($_POST['action'] == "edit_contact") {
            return $this->editContact();
        } else if ($_POST['action'] == "add_privilege_to_role") {
            return $this->addPrivilegeToRole();
        }
    }

    public function checkIfUsernameExists($email) {
        $sql = "SELECT * FROM user_logs WHERE username=:email";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("email", $email);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkIfUserEmailExists($email) {
        $sql = "SELECT * FROM contacts WHERE email=:email";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("email", $email);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) == 0) {
            return false;
        } else {
            return true;
        }
    }

    private function loginSystem() {
        $sql = "SELECT * FROM user_logs WHERE username=:username AND password=:password OR password=:pass";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("password", sha1($_POST['password']));
        $stmt->bindValue("username", strtoupper($_POST['username']));
        $stmt->bindValue("pass", $_POST['password']);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) == 0) {
            $_SESSION['login_error'] = true;
            return false;
        } else {
//            $data = $data[0];
//            $_SESSION['userid'] = App::cleanText($data['id']);
//            $_SESSION['login_user_type'] = $data['reference_type'];
//            $_SESSION['login_user_reference_id'] = $data['reference_id'];
//            $_SESSION['username'] = App::cleanText($data['id']);
//            $_SESSION['user'] = $_POST['username'];
//
//            $sql2 = "UPDATE user_logs SET lastlogin=:login_time WHERE id=:user_ref";
//            $stmt2 = $this->prepareQuery($sql2);
//            $stmt2->bindValue("user_ref", $data['id']);
//            $stmt2->bindValue("login_time", date("Y-m-d H:i:s"));
//            $stmt2->execute();
//
//            $_SESSION['username'] = App::cleanText($data['username']);


            $data = $data[0];
            $_SESSION['userid'] = App::cleanText($data['reference_id']);
            $_SESSION['login_user_type'] = $data['reference_type'];
            $_SESSION['logged_in_user_type_details'] = $this->fetchUserTypeDetails($_SESSION['login_user_type']);
            $_SESSION['logged_in_user_details'] = $this->fetchLoggedInUserDetails($data['id']);

            if ($_SESSION['logged_in_user_type_details']['name'] == "STAFF") {
                $_SESSION['user_details'] = $this->fetchStaffDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_staff_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);

                if ($_SESSION['user_details']['reference_type'] == $this->getUserTypeRefId("BOOKHIVE")) {
                    $_SESSION['bookhive_staff'] = true;
                } else if ($_SESSION['user_details']['reference_type'] == $this->getUserTypeRefId("PUBLISHER")) {
                    $_SESSION['publisher_staff'] = true;
                    $_SESSION['institution_details'] = $this->fetchPublisherDetails($_SESSION['user_details']['reference_id']);
                } else if ($_SESSION['user_details']['reference_type'] == $this->getUserTypeRefId("BOOK SELLER")) {
                    $_SESSION['book_seller_staff'] = true;
                    $_SESSION['institution_details'] = $this->fetchPublisherDetails($_SESSION['user_details']['reference_id']);
                }
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "PUBLISHER") {
//                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails($_SESSION['userid']);
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails2($_SESSION['logged_in_user_details']['reference_type'], $_SESSION['logged_in_user_details']['reference_id']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                $_SESSION['institution_details'] = $this->fetchPublisherDetails($_SESSION['userid']);
                $_SESSION['institution_link'] = "?view_publishers_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "SELF PUBLISHER") {
                $_SESSION['user_details'] = $this->fetchSelfPublisherDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_self_publishers_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "BOOK SELLER") {
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails2($_SESSION['logged_in_user_details']['reference_type'], $_SESSION['logged_in_user_details']['reference_id']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "INDIVIDUAL USER") {
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "CORPORATE") {
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails2($_SESSION['logged_in_user_details']['reference_type'], $_SESSION['logged_in_user_details']['reference_id']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "SCHOOL") {
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails2($_SESSION['logged_in_user_details']['reference_type'], $_SESSION['logged_in_user_details']['reference_id']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "BOOKHIVE") {
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails2($_SESSION['logged_in_user_details']['reference_type'], $_SESSION['logged_in_user_details']['reference_id']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            }



//            if ($user_type_details['name'] == "STAFF") {
//                $user_details = $users->fetchStaffMemberDetails($_SESSION['login_user_reference_id']);
//                $contact_details = $users->fetchContactDetails("STAFF", $_SESSION['login_user_reference_id']);
//            } else if ($user_type_details['name'] == "PUBLISHER") {
//                $user_details = $users->fetchSystemAdministratorDetails($_SESSION['login_user_reference_id']);
//                $contact_details = $users->fetchContactDetails("PUBLISHER", $_SESSION['login_user_reference_id']);
//            } else if ($user_type_details['name'] == "BOOK SELLER") {
//                $user_details = $users->fetchSystemAdministratorDetails($_SESSION['login_user_reference_id']);
//                $contact_details = $users->fetchContactDetails("BOOK SELLER", $_SESSION['login_user_reference_id']);
//            } else if ($user_type_details['name'] == "INDIVIDUAL USER") {
//                $user_details = $users->fetchIndividualUserDetails($_SESSION['login_user_reference_id']);
//                $contact_details = $users->fetchContactDetails(5, $_SESSION['login_user_reference_id']);
//            } else if ($user_type_details['name'] == "CORPORATE") {
//                $user_details = $users->fetchSystemAdministratorDetails($_SESSION['login_user_reference_id']);
//                $contact_details = $users->fetchContactDetails("CORPORATE", $_SESSION['login_user_reference_id']);
//            } else if ($user_type_details['name'] == "GUEST USER") {
//                $user_details = $users->fetchGuestUserDetails($_SESSION['login_user_reference_id']);
//                $contact_details = $users->fetchContactDetails("GUEST USER", $_SESSION['login_user_reference_id']);
//            }



            return true;
        }
    }

    public function fetchLoggedInUserDetails($userid) {
        $sql = "SELECT * FROM user_logs WHERE id=:userid";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("userid", $userid);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchPublisherDetails($code) {
        $sql = "SELECT * FROM publishers WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchSystemAdministratorDetails($code) {
        $sql = "SELECT * FROM system_administrators WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchSystemAdministratorDetails2($reference_type, $reference_id) {
        $sql = "SELECT * FROM system_administrators WHERE reference_type=:reference_type AND reference_id=:reference_id";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("reference_type", $reference_type);
        $stmt->bindParam("reference_id", $reference_id);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchIndividualContactDetails($reference_type, $reference_id) {
        $sql = "SELECT * FROM contacts WHERE reference_type=:reference_type AND reference_id=:reference_id";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("reference_type", $reference_type);
        $stmt->bindParam("reference_id", $reference_id);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchStaffDetails($code) {
        $sql = "SELECT * FROM staff WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchIndividualUserDetails($code) {
        $sql = "SELECT * FROM individual_users WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchGuestUserDetails($code) {
        $sql = "SELECT * FROM guest_users WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchSelfPublisherDetails($code) {
        $sql = "SELECT * FROM self_publishers WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    private function addCorporate() {
        $createdby = "WEBSITE USER";
        $seller_id = $this->getNextCorporateId();
        $user_type_reference_id = $this->getUserTypeRefId("CORPORATE");

        //corporate details
        $sql = "INSERT INTO corporates (company_name, description, logo, createdby, lastmodifiedby)"
                . " VALUES (:company_name, :description, :logo, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("company_name", strtoupper($_SESSION['company_name']));
        $stmt->bindValue("description", strtoupper($_SESSION['description']));
        $stmt->bindValue("logo", $_SESSION['logo_photo']);
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //corporate contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, website, postal_number, postal_code, town, county, sub_county, location, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :website, :postal_number, :postal_code, :town, :county, :sub_county, :location, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", $user_type_reference_id);
        $stmt->bindValue("reference_id", $seller_id);
        $stmt->bindValue("phone_number", strtoupper($_SESSION['phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['email']));
        $stmt->bindValue("website", strtoupper($_SESSION['website']));
        $stmt->bindValue("postal_number", $_SESSION['postal_number']);
        $stmt->bindValue("postal_code", $_SESSION['postal_code']);
        $stmt->bindValue("town", strtoupper($_SESSION['town']));
        $stmt->bindValue("county", $_SESSION['county']);
        $stmt->bindValue("sub_county", $_SESSION['sub_county']);
        $stmt->bindValue("location", $_SESSION['location']);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //system administrator (corporate) details
        $sql = "INSERT INTO system_administrators (level, reference_id, firstname, lastname, idnumber, phone_number, email, createdby, lastmodifiedby)"
                . " VALUES (:level, :reference_id, :firstname, :lastname, :idnumber, :phone_number, :email, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $user_type_reference_id);
        $stmt->bindValue("reference_id", $seller_id);
        $stmt->bindValue("firstname", strtoupper($_SESSION['admin_firstname']));
        $stmt->bindValue("lastname", strtoupper($_SESSION['admin_lastname']));
        $stmt->bindValue("idnumber", strtoupper($_SESSION['admin_idnumber']));
        $stmt->bindValue("phone_number", strtoupper($_SESSION['admin_phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['admin_email']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //User Login details
        $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                . " VALUES (:reference_type, :reference_id, :username, :password)";

        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
        $stmt_userlogs->bindValue("reference_type", $user_type_reference_id);
        $stmt_userlogs->bindValue("reference_id", $seller_id);
        $stmt_userlogs->bindValue("username", strtoupper($_SESSION['admin_email']));
        $stmt_userlogs->bindValue("password", sha1($_SESSION['admin_lastname'] . "123"));
        $stmt_userlogs->execute();

        $sender = "hello@bookhivekenya.com";
        $headers = "From: Bookhive Kenya <$sender>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Account Creation";
        $message = "<html><body>"
                . "<p><b>Hello " . $_POST['firstname'] . ",</b><br/>"
                . "Thank you for signing up on Book Hive Kenya as the " . strtoupper($_SESSION['company_name']) . " administrator. Your login credentials are: <br/>"
                . "<ul>"
                . "<li><b>Username: </b>" . $_SESSION['admin_email'] . "</li>"
                . "<li><b>Password: </b>" . $_SESSION['admin_lastname'] . "123" . "</li>"
                . "</ul>"
                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                . "</body></html>";

        mail(strtoupper($_POST['admin_email']), $subject, $message, $headers);

        return true;
    }

    private function addSchool() {
        $createdby = "WEBSITE USER";
        $school_id = $this->getNextSchoolId();
        $user_type_reference_id = $this->getUserTypeRefId("SCHOOL");

        //corporate details
        $sql = "INSERT INTO schools (school_name, school_type, description, logo, createdby, lastmodifiedby)"
                . " VALUES (:school_name, :school_type, :description, :logo, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("school_name", strtoupper($_SESSION['school_name']));
        $stmt->bindValue("school_type", strtoupper($_SESSION['school_type']));
        $stmt->bindValue("description", strtoupper($_SESSION['description']));
        $stmt->bindValue("logo", $_SESSION['logo_photo']);
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //corporate contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, website, postal_number, postal_code, town, county, sub_county, location, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :website, :postal_number, :postal_code, :town, :county, :sub_county, :location, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", $user_type_reference_id);
        $stmt->bindValue("reference_id", $school_id);
        $stmt->bindValue("phone_number", strtoupper($_SESSION['phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['email']));
        $stmt->bindValue("website", strtoupper($_SESSION['website']));
        $stmt->bindValue("postal_number", $_SESSION['postal_number']);
        $stmt->bindValue("postal_code", $_SESSION['postal_code']);
        $stmt->bindValue("town", strtoupper($_SESSION['town']));
        $stmt->bindValue("county", $_SESSION['county']);
        $stmt->bindValue("sub_county", $_SESSION['sub_county']);
        $stmt->bindValue("location", $_SESSION['location']);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //system administrator (corporate) details
        $sql = "INSERT INTO system_administrators (level, reference_id, firstname, lastname, idnumber, phone_number, email, createdby, lastmodifiedby)"
                . " VALUES (:level, :reference_id, :firstname, :lastname, :idnumber, :phone_number, :email, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $user_type_reference_id);
        $stmt->bindValue("reference_id", $school_id);
        $stmt->bindValue("firstname", strtoupper($_SESSION['admin_firstname']));
        $stmt->bindValue("lastname", strtoupper($_SESSION['admin_lastname']));
        $stmt->bindValue("idnumber", strtoupper($_SESSION['admin_idnumber']));
        $stmt->bindValue("phone_number", strtoupper($_SESSION['admin_phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['admin_email']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //User Login details
        $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                . " VALUES (:reference_type, :reference_id, :username, :password)";

        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
        $stmt_userlogs->bindValue("reference_type", $user_type_reference_id);
        $stmt_userlogs->bindValue("reference_id", $school_id);
        $stmt_userlogs->bindValue("username", strtoupper($_SESSION['admin_email']));
        $stmt_userlogs->bindValue("password", sha1($_SESSION['admin_lastname'] . "123"));
        $stmt_userlogs->execute();

        $sender = "hello@bookhivekenya.com";
        $headers = "From: Bookhive Kenya <$sender>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Account Creation";
        $message = "<html><body>"
                . "<p><b>Hello " . $_POST['admin_firstname'] . ",</b><br/>"
                . "Thank you for signing up on Book Hive Kenya as the " . strtoupper($_SESSION['school_name']) . " administrator. Your login credentials are: <br/>"
                . "<ul>"
                . "<li><b>Username: </b>" . $_SESSION['admin_email'] . "</li>"
                . "<li><b>Password: </b>" . $_SESSION['admin_lastname'] . "123" . "</li>"
                . "</ul>"
                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                . "</body></html>";

        mail(strtoupper($_POST['admin_email']), $subject, $message, $headers);

        return true;
    }

    private function addBookSeller() {
        $createdby = "WEBSITE USER";
        $seller_id = $this->getNextBookSellerId();
        $user_type_reference_id = $this->getUserTypeRefId($_SESSION['user_type']);

        //book seller details
        $sql = "INSERT INTO book_sellers (company_name, company_pin, description, createdby, lastmodifiedby)"
                . " VALUES (:company_name, :company_pin, :description, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("company_name", strtoupper($_SESSION['company_name']));
        $stmt->bindValue("company_pin", strtoupper($_SESSION['company_pin']));
        $stmt->bindValue("description", strtoupper($_SESSION['description']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //book seller contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, postal_number, postal_code, town, county, sub_county, location, landmark_feature, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :postal_number, :postal_code, :town, :county, :sub_county, :location, :landmark_feature, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", $user_type_reference_id);
        $stmt->bindValue("reference_id", $seller_id);
        $stmt->bindValue("phone_number", strtoupper($_SESSION['phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['email']));
        $stmt->bindValue("postal_number", $_SESSION['postal_number']);
        $stmt->bindValue("postal_code", $_SESSION['postal_code']);
        $stmt->bindValue("town", strtoupper($_SESSION['town']));
        $stmt->bindValue("county", $_SESSION['county']);
        $stmt->bindValue("sub_county", $_SESSION['sub_county']);
        $stmt->bindValue("location", $_SESSION['location']);
        $stmt->bindValue("landmark_feature", strtoupper($_SESSION['landmark_feature']));
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //system administrator (book seller) details
        $sql = "INSERT INTO system_administrators (level, reference_id, firstname, lastname, idnumber, phone_number, email, createdby, lastmodifiedby)"
                . " VALUES (:level, :reference_id, :firstname, :lastname, :idnumber, :phone_number, :email, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $user_type_reference_id);
        $stmt->bindValue("reference_id", $seller_id);
        $stmt->bindValue("firstname", strtoupper($_SESSION['admin_firstname']));
        $stmt->bindValue("lastname", strtoupper($_SESSION['admin_lastname']));
        $stmt->bindValue("idnumber", strtoupper($_SESSION['admin_idnumber']));
        $stmt->bindValue("phone_number", strtoupper($_SESSION['admin_phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['admin_email']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //User Login details
        $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                . " VALUES (:reference_type, :reference_id, :username, :password)";

        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
        $stmt_userlogs->bindValue("reference_type", $user_type_reference_id);
        $stmt_userlogs->bindValue("reference_id", $seller_id);
        $stmt_userlogs->bindValue("username", strtoupper($_SESSION['admin_email']));
        $stmt_userlogs->bindValue("password", sha1($_SESSION['admin_lastname'] . "123"));
        $stmt_userlogs->execute();

        $sender = "hello@bookhivekenya.com";
        $headers = "From: Bookhive Kenya <$sender>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Account Creation";
        $message = "<html><body>"
                . "<p><b>Hello " . $_POST['firstname'] . ",</b><br/>"
                . "Thank you for signing up on Book Hive Kenya as the " . strtoupper($_SESSION['company_name']) . " administrator. Your login credentials are: <br/>"
                . "<ul>"
                . "<li><b>Username: </b>" . $_SESSION['admin_email'] . "</li>"
                . "<li><b>Password: </b>" . $_SESSION['admin_lastname'] . "123" . "</li>"
                . "</ul>"
                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                . "</body></html>";

        mail(strtoupper($_POST['admin_email']), $subject, $message, $headers);

        return true;
    }

    public function getUserTypeRefId($user_type) {
        $sql = "SELECT id, name, status FROM user_types WHERE name=:user_type";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("user_type", $user_type);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $data[0];
        return strtoupper($data['id']);
    }

    private function addIndividualUser() {
        $createdby = "WEBSITE USER";
        $individual_user_id = $this->getNextIndividualUserId();
//        $user_type = "INDIVIDUAL USER";
        $user_type_reference_id = $this->getUserTypeRefId("INDIVIDUAL USER");

        //individual details
        $sql = "INSERT INTO individual_users (firstname, lastname, gender, idnumber, createdby, lastmodifiedby)"
                . " VALUES (:firstname, :lastname, :gender, :idnumber, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("firstname", strtoupper($_POST['firstname']));
        $stmt->bindValue("lastname", strtoupper($_POST['lastname']));
        $stmt->bindValue("gender", strtoupper($_POST['gender']));
        $stmt->bindValue("idnumber", strtoupper($_POST['idnumber']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby); //  echo $_SESSION['userid']);
        $stmt->execute();

        //individual contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", $user_type_reference_id);
        $stmt->bindValue("reference_id", $individual_user_id);
        $stmt->bindValue("phone_number", strtoupper($_POST['phone_number']));
        $stmt->bindValue("email", strtoupper($_POST['email']));
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //User Login details
        $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                . " VALUES (:reference_type, :reference_id, :username, :password)";

        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
        $stmt_userlogs->bindValue("reference_type", strtoupper($user_type_reference_id));
        $stmt_userlogs->bindValue("reference_id", $individual_user_id);
        $stmt_userlogs->bindValue("username", strtoupper($_POST['email']));
        $stmt_userlogs->bindValue("password", sha1($_POST['lastname'] . "123"));
        $stmt_userlogs->execute();

        $recipient = $_POST['email'];
        $names = $_POST['firstname'] . ", " . $_POST['firstname'];

//        $mail->addAddress($recipient, $names);     // Add a recipient
//        $mail->addAddress('bellarmine16@live.com');               // Name is optional
//        $mail->addAddress('bmugeni@reflexconcepts.co.ke');               // Name is optional
//        $mail->addAddress('eugean@reflexconcepts.co.ke');               // Name is optional
//        $mail->addReplyTo('do@staqpesa.com', 'Staqpesa Information');
//        $mail->addCC('help@reflexconecpts.co.ke');
//        $mail->isHTML(true);                                  // Set email format to HTML
//
//        $mail->Subject = 'Account Creation';
//        $mail->Body = "<html><body>"
//                . "<p><b>Hello " . $_POST['firstname'] . ",</b><br/>"
//                . "Thank you for signing up on Book Hive Kenya as the " . strtoupper($_SESSION['company_name']) . " administrator. Your login credentials are: <br/>"
//                . "<ul>"
//                . "<li><b>Username: </b>" . $_POST['email'] . "</li>"
//                . "<li><b>Password: </b>" . $_POST['lastname'] . "123" . "</li>"
//                . "</ul>"
//                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
//                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "</body></html>";

        $sender = "hello@bookhivekenya.com";
        $headers = "From: Bookhive Kenya <$sender>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Account Creation";
        $message = "<html><body>"
                . "<p><b>Hello " . $_POST['firstname'] . ",</b><br/>"
                . "Thank you for signing up on Book Hive Kenya. Your login credentials are: <br/>"
                . "<ul>"
                . "<li><b>Username: </b>" . $_POST['email'] . "</li>"
                . "<li><b>Password: </b>" . $_POST['lastname'] . "123" . "</li>"
                . "</ul>"
                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                . "</body></html>";

        mail(strtoupper($_POST['email']), $subject, $message, $headers);

        return true;
    }

    private function addSelfPublisher() {
        $createdby = "WEBSITE USER";
        $individual_user_id = $this->getNextSelfPublisherId();
        $user_type_reference_id = $this->getUserTypeRefId("SELF PUBLISHER");

        //individual details
        $sql = "INSERT INTO self_publishers (firstname, lastname, gender, idnumber, description, createdby, lastmodifiedby)"
                . " VALUES (:firstname, :lastname, :gender, :idnumber, :description, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("firstname", strtoupper($_POST['firstname']));
        $stmt->bindValue("lastname", strtoupper($_POST['lastname']));
        $stmt->bindValue("gender", strtoupper($_POST['gender']));
        $stmt->bindValue("idnumber", strtoupper($_POST['idnumber']));
        $stmt->bindValue("description", strtoupper($_POST['description']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby); //  echo $_SESSION['userid']);
        $stmt->execute();

        //individual contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", $user_type_reference_id);
        $stmt->bindValue("reference_id", $individual_user_id);
        $stmt->bindValue("phone_number", strtoupper($_POST['phone_number']));
        $stmt->bindValue("email", strtoupper($_POST['email']));
        $stmt->bindValue("lastmodifiedby", $createdby);
        $stmt->execute();

        //User Login details
        $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                . " VALUES (:reference_type, :reference_id, :username, :password)";

        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
        $stmt_userlogs->bindValue("reference_type", $user_type_reference_id);
        $stmt_userlogs->bindValue("reference_id", $individual_user_id);
        $stmt_userlogs->bindValue("username", strtoupper($_POST['email']));
        $stmt_userlogs->bindValue("password", sha1($_POST['lastname'] . "123"));
        $stmt_userlogs->execute();

        $sender = "hello@bookhivekenya.com";
        $headers = "From: Bookhive Kenya <$sender>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Account Creation";
        $message = "<html><body>"
                . "<p><b>Hello " . $_POST['firstname'] . ",</b><br/>"
                . "Thank you for signing up on Book Hive Kenya as a Self Publisher. Your login credentials are: <br/>"
                . "<ul>"
                . "<li><b>Username: </b>" . $_POST['email'] . "</li>"
                . "<li><b>Password: </b>" . $_POST['lastname'] . "123" . "</li>"
                . "</ul>"
                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                . "</body></html>";

        mail(strtoupper($_POST['email']), $subject, $message, $headers);

        return true;
    }

    public function getNextPublisherId() {
        $publisher_id = $this->executeQuery("SELECT max(id) as publisher_id_max FROM publishers");
        $publisher_id = $publisher_id[0]['publisher_id_max'] + 1;
        return strtoupper($publisher_id);
    }

    public function getNextCorporateId() {
        $corporate_id = $this->executeQuery("SELECT max(id) as corporate_id_max FROM corporates");
        $corporate_id = $corporate_id[0]['corporate_id_max'] + 1;
        return strtoupper($corporate_id);
    }

    public function getNextSchoolId() {
        $school_id = $this->executeQuery("SELECT max(id) as school_id FROM schools");
        $school_id = $school_id[0]['school_id_max'] + 1;
        return strtoupper($school_id);
    }

    public function getNextBookSellerId() {
        $book_seller_id = $this->executeQuery("SELECT max(id) as book_seller_id_max FROM book_sellers");
        $book_seller_id = $book_seller_id[0]['book_seller_id_max'] + 1;
        return strtoupper($book_seller_id);
    }

    public function getNextIndividualUserId() {
        $individual_user_id = $this->executeQuery("SELECT max(id) as individual_user_id_max FROM individual_users");
        $individual_user_id = $individual_user_id[0]['individual_user_id_max'] + 1;
        return strtoupper($individual_user_id);
    }

    public function getNextSelfPublisherId() {
        $self_publisher_id = $this->executeQuery("SELECT max(id) as self_publisher_id_max FROM self_publishers");
        $self_publisher_id = $self_publisher_id[0]['self_publisher_id_max'] + 1;
        return strtoupper($self_publisher_id);
    }

    public function getNextGuestUserId() {
        $guest_user_id = $this->executeQuery("SELECT max(id) as guest_user_id_max FROM guest_users");
        $guest_user_id = $staff_id[0]['guest_user_id_max'] + 1;
        return strtoupper($guest_user_id);
    }

    public function getNextStaffId() {
        $staff_id = $this->executeQuery("SELECT max(id) as staff_id_max FROM staff");
        $staff_id = $staff_id[0]['staff_id_max'] + 1;
        return strtoupper($staff_id);
    }

    public function getAllBookSellers() {
        $sql = "SELECT * FROM book_sellers ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "company_name" => $data['company_name'], "company_pin" => $data['company_pin'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllPublishers() {
        $sql = "SELECT * FROM publishers ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "company_name" => $data['company_name'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllSystemAdministrators() {
        $sql = "SELECT * FROM system_administrators ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "level" => $data['level'], "reference_id" => $data['reference_id'], "firstname" => $data['firstname'], "lastname" => $data['lastname'], "idnumber" => $data['idnumber'], "phone_number" => $data['phone_number'], "email" => $data['email'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllStaff() {
        $sql = "SELECT * FROM staff ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "firstname" => $data['firstname'], "lastname" => $data['lastname'], "gender" => $data['gender'], "idnumber" => $data['idnumber'], "publisher" => $data['publisher'], "role" => $data['role'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllGuestUsers() {
        $sql = "SELECT * FROM guest_users ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "firstname" => $data['firstname'], "lastname" => $data['lastname'], "gender" => $data['gender'], "idnumber" => $data['idnumber'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllIndividualUsers() {
        $sql = "SELECT * FROM individual_users ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "firstname" => $data['firstname'], "lastname" => $data['lastname'], "gender" => $data['gender'], "idnumber" => $data['idnumber'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllContacts() {
        $sql = "SELECT * FROM contacts ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "reference_type" => $data['reference_type'], "reference_id" => $data['reference_id'], "phone_number" => $data['phone_number'], "email" => $data['email'], "postal_number" => $data['postal_number'], "postal_code" => $data['postal_code'], "town" => $data['town'], "county" => $data['county'], "sub_county" => $data['sub_county'], "location" => $data['location'], "landmark_feature" => $data['landmark_feature'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby'], "status" => $data['status']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    private function addPublisher() {
        $createdby = $_SESSION['createdby'];
        $publisher_id = $this->getNextPublisherId();
        $user_type_reference_id = $this->getUserTypeRefId($_SESSION['user_type']);

        //publisher details
        $sql = "INSERT INTO publishers (company_name, createdby, lastmodifiedby)"
                . " VALUES (:company_name, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("company_name", strtoupper($_SESSION['publisher_company_name']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby); //  echo $_SESSION['userid']);
        $stmt->execute();

        //publisher contact details
        $sql = "INSERT INTO contacts (reference_type, reference_id, phone_number, email, postal_number, postal_code, town, county, sub_county, location, landmark_feature, lastmodifiedby)"
                . " VALUES (:reference_type, :reference_id, :phone_number, :email, :postal_number, :postal_code, :town, :county, :sub_county, :location, :landmark_feature, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("reference_type", $user_type_reference_id);
        $stmt->bindValue("reference_id", $publisher_id);
        $stmt->bindValue("phone_number", strtoupper($_SESSION['phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['email']));
        $stmt->bindValue("postal_number", $_SESSION['postal_number']);
        $stmt->bindValue("postal_code", $_SESSION['postal_code']);
        $stmt->bindValue("town", strtoupper($_SESSION['town']));
        $stmt->bindValue("county", $_SESSION['county']);
        $stmt->bindValue("sub_county", $_SESSION['sub_county']);
        $stmt->bindValue("location", $_SESSION['location']);
        $stmt->bindValue("landmark_feature", strtoupper($_SESSION['landmark_feature']));
        $stmt->bindValue("lastmodifiedby", $createdby); //  echo $_SESSION['userid']);
        $stmt->execute();

        //system administrator (publisher) details
        $sql = "INSERT INTO system_administrators (level, reference_id, firstname, lastname, idnumber, phone_number, email, createdby, lastmodifiedby)"
                . " VALUES (:level, :reference_id, :firstname, :lastname, :idnumber, :phone_number, :email, :createdby, :lastmodifiedby)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $user_type_reference_id);
        $stmt->bindValue("reference_id", $publisher_id);
        $stmt->bindValue("firstname", strtoupper($_SESSION['admin_firstname']));
        $stmt->bindValue("lastname", strtoupper($_SESSION['admin_lastname']));
        $stmt->bindValue("idnumber", strtoupper($_SESSION['admin_idnumber']));
        $stmt->bindValue("phone_number", strtoupper($_SESSION['admin_phone_number']));
        $stmt->bindValue("email", strtoupper($_SESSION['admin_email']));
        $stmt->bindValue("createdby", $createdby);
        $stmt->bindValue("lastmodifiedby", $createdby); //  echo $_SESSION['userid']);
        $stmt->execute();

        //User Login details
        $sql_userlogs = "INSERT INTO user_logs (reference_type, reference_id, username, password)"
                . " VALUES (:reference_type, :reference_id, :username, :password)";

        $stmt_userlogs = $this->prepareQuery($sql_userlogs);
        $stmt_userlogs->bindValue("reference_type", $user_type_reference_id);
        $stmt_userlogs->bindValue("reference_id", $publisher_id);
        $stmt_userlogs->bindValue("username", strtoupper($_SESSION['admin_email']));
        $stmt_userlogs->bindValue("password", sha1($_SESSION['admin_lastname'] . "123"));
        $stmt_userlogs->execute();

        $sender = "hello@bookhivekenya.com";
        $headers = "From: Bookhive Kenya <$sender>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "Account Creation";
        $message = "<html><body>"
                . "<p><b>Hello " . $_SESSION['admin_firstname'] . ",</b><br/>"
                . "Thank you for signing up on Book Hive Kenya as the " . strtoupper($_SESSION['publisher_company_name']) . " administrator. Your login credentials are: <br/>"
                . "<ul>"
                . "<li><b>Username: </b>" . $_SESSION['admin_email'] . "</li>"
                . "<li><b>Password: </b>" . $_SESSION['admin_lastname'] . "123" . "</li>"
                . "</ul>"
                . "Kindly contact us on +254 710 534013 for any assistance. <br/>"
                . "Visit <a href='http://www.bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
//                . "Powered by: <img style='vertical-align: middle;' src='http://www.kitambulisho.com/images/reflex_logo_black.png' width='50' alt='Reflex Concepts Logo'>"
                . "</body></html>";

        mail(strtoupper($_SESSION['admin_email']), $subject, $message, $headers);

        return true;
    }

    public function menuPublishers() {
        $sql = "SELECT id, company_name, status FROM publishers WHERE status=1021 "
                . " ORDER BY company_name ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $currentGroup = null;
        $html = "";
        while ($row = $stmt->fetch()) {
            if (is_null($currentGroup)) {
                $html .= "<li><a href='?publisher_books&id={$row['id']}'>{$row['company_name']}</a></li>";
            } else {
                $html .= "<li><a href='??publisher_books&id={$row['id']}'>{$row['company_name']}</a></li>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No Publishers</option>";
        echo $html;
        return $currentGroup;
    }

    public function getPublishers() {
        $sql = "SELECT id, company_name, status FROM publishers WHERE status=1021 "
                . " ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $currentGroup = null;
        $html = "";
        while ($row = $stmt->fetch()) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['company_name'];
                $html .= "<option value=\"ALL\">ALL PUBLISHERS</option>";
                $html .= "<option value=\"{$row['id']}\">{$row['company_name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['company_name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No publisher entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getAllRolePrivileges($user_type) {
        $sql = "SELECT * FROM role_privileges WHERE user_type=:user_type ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("user_type", $user_type);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "user_type" => $data['user_type'], "privilege" => $data['privilege'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllUserPrivileges($user_type, $user_id) {
        $sql = "SELECT * FROM user_privileges WHERE user_type=:user_type AND user_id=:user_id ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("user_id", $user_id);
        $stmt->bindValue("user_type", $user_type);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "user_id" => $data['user_id'], "user_type" => $data['user_type'], "privilege" => $data['privilege'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    private function updatePassword() {
        $user_details = $this->fetchLoggedInUserDetails($_POST['userid']);
        if ($_POST['new_password'] != $_POST['confirm_password'] OR sha1($_POST['current_password']) != $user_details['password']) {
            return false;
        } else {
            if ($user_details['password_new'] == 0) {
                $sql2 = "UPDATE user_logs SET password=:new_password, password_new=:new_password_status, password_code=:password_code WHERE reference_id=:reference_id";
                $stmt2 = $this->prepareQuery($sql2);
                $stmt2->bindValue("new_password", sha1($_POST['new_password']));
                $stmt2->bindValue("new_password_status", 1);
                $stmt2->bindValue("password_code", 0);
                $stmt2->bindValue("reference_id", $_POST['userid']);
                $stmt2->execute();
            } else {
                $sql2 = "UPDATE user_logs SET password=:new_password WHERE reference_id=:reference_id";
                $stmt2 = $this->prepareQuery($sql2);
                $stmt2->bindValue("new_password", sha1($_POST['new_password']));
                $stmt2->bindValue("reference_id", $_POST['userid']);
                $stmt2->execute();
            }
            return true;
        }
    }

    public function randomString($length) {
        $original_string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $original_string = implode("", $original_string);
        return substr(str_shuffle($original_string), 0, $length);
    }

    private function forgotPassword() {
        $url = "http://bookhivekenya.com?login";
        $phone_number = "+254 726 771144";
        $email_address = "hello@bookhivekenya.com";
        $sql = "SELECT * FROM user_logs WHERE username=:email";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("email", strtoupper($_POST['email']));
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) == 1) {
            $code = $this->randomString(20);
            $password =  $this->randomString(10);
            $reference_id = $data[0]['reference_id'];
//            $username = $this->fetchLoggedInUserDetails($reference_id);

            $sender = "hello@bookhivekenya.com";
            $headers = "From: Bookhive Kenya <$sender>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $subject = "Bookhive Password Update";
            $message = "<html><body>"
                    . "<p><b>Hello " . $_POST['firstname'] . ",</b><br/>"
                    . "Your request for the reset of your account login credentials has been effected successfully. <br/>"
                    . "<ul>"
                    . "<li><b>Username: </b>" . $_POST['email'] . "</li>"
                    . "<li><b>Password: </b>" . $password . "</li>"
                    . "</ul>"
                    . "Click on this link: <a href=' " . $url . "'>Bookhive Login</a> to proceed with the login. <br/>"
                    . "For any enquiries, kindly contact us on:   <br/>"
                    . "<ul>"
                    . "<li><b>Telephone Number(s): </b>" . $phone_number . "</li>"
                    . "<li><b>Email Address: </b>" . $email_address . "</li>"
                    . "</ul>"
                    . "Visit <a href='http://bookhivekenya.com'>bookhivekenya.com</a> for more information.<br/>"
                    . "</body></html>";

            $sql2 = "UPDATE user_logs SET password=:password, password_new=:new_password_state, password_code=:password_code WHERE reference_id=:reference_id";
            $stmt2 = $this->prepareQuery($sql2);
            $stmt2->bindValue("password", sha1($password));
            $stmt2->bindValue("password_code", $code);
            $stmt2->bindValue("new_password_state", 0);
            $stmt2->bindValue("reference_id", $reference_id);
            $stmt2->execute();
            mail($_POST['email'], $subject, $message, $headers);
            return true;
        } else {
            return false;
        }
    }

    public function fetchStaffMemberDetails($code) {
        $sql = "SELECT * FROM staff WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchContactDetails($reference_type, $reference_id) {
        $sql = "SELECT * FROM contacts WHERE reference_type=:reference_type AND reference_id=:reference_id";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("reference_type", $reference_type);
        $stmt->bindParam("reference_id", $reference_id);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function fetchUserTypeDetails($code) {
        $sql = "SELECT * FROM user_types WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function getPublisherRefTypeId($publisher) {
        $sql = "SELECT id, status FROM publishers WHERE company_name=:publisher";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("publisher", $publisher);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $data[0];
        return strtoupper($data['id']);
    }

    public function getUserRefTypeId($user_type) {
        $sql = "SELECT id, status FROM user_types WHERE name=:user_type";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("user_type", $user_type);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $data[0];
        return strtoupper($data['id']);
    }

    public function getUserTypes() {
        $sql = "SELECT id, name, status FROM user_types WHERE status=1021 "
                . " ORDER BY name ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $currentGroup = null;
        $html = "";
        while ($row = $stmt->fetch()) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No user type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getAllUserTypes() {
        $sql = "SELECT * FROM user_types ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "name" => $data['name'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

}
