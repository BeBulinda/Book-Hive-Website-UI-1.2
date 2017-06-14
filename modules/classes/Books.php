<?php

date_default_timezone_set("Africa/Nairobi");
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Users.php";

class Books extends Database {

    public function fetchBookDetails($code) {
        $sql = "SELECT * FROM books WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    public function getAllSearchedBooks($search_value) {

        $sql = "SELECT * FROM books WHERE title LIKE '%{$search_value}%' "
                . "OR description LIKE '%{$search_value}%' "
                . "OR author LIKE '%{$search_value}%' "
                . "OR publisher LIKE '%{$search_value}%' "
                . "OR publication_year LIKE '%{$search_value}%' "
                . "OR isbn_number LIKE '%{$search_value}%' "
                . "OR type_id LIKE '%{$search_value}%' "
                . "OR level_id LIKE '%{$search_value}%' "
                . "OR price LIKE '%{$search_value}%' "
                . " ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_searched_records'] = true;
        } else {
            $_SESSION['yes_searched_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return $values2;
        }
    }

    public function getAllFilteredBooks($publisher, $book_level, $book_type, $print_type) {

//        if ($publisher === "ALL" AND $book_level === "ALL" AND $book_type === "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level === "ALL" AND $book_type === "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level === "ALL" AND $book_type !== "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE type_id=:type_id ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level === "ALL" AND $book_type !== "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level !== "ALL" AND $book_type === "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE level_id=:level_id ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level !== "ALL" AND $book_type === "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE level_id=:level_id AND print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level !== "ALL" AND $book_type !== "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE level_id=:level_id AND type_id=:type_id ORDER BY id ASC";
//        } else if ($publisher === "ALL" AND $book_level !== "ALL" AND $book_type !== "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE level_id=:level_id AND type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level === "ALL" AND $book_type === "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level === "ALL" AND $book_type === "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level === "ALL" AND $book_type !== "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND type_id=:type_id ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level === "ALL" AND $book_type !== "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level !== "ALL" AND $book_type === "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level !== "ALL" AND $book_type === "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id AND print_type=:print_type ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level !== "ALL" AND $book_type !== "ALL" AND $print_type === "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id AND type_id=:type_id ORDER BY id ASC";
//        } else if ($publisher !== "ALL" AND $book_level !== "ALL" AND $book_type !== "ALL" AND $print_type !== "ALL") {
//            $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id AND type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
//        }


        if ($publisher === "ALL") {
            if ($book_level === "ALL") {
                if ($book_type === "ALL") {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE print_type=:print_type ORDER BY id ASC";
                    }
                } else {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE type_id=:type_id ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
                    }
                }
            } else {
                if ($book_type === "ALL") {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE level_id=:level_id ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE level_id=:level_id AND print_type=:print_type ORDER BY id ASC";
                    }
                } else {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE level_id=:level_id AND type_id=:type_id ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE level_id=:level_id AND type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
                    }
                }
            }
        } else {
            if ($book_level === "ALL") {
                if ($book_type === "ALL") {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND print_type=:print_type ORDER BY id ASC";
                    }
                } else {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND type_id=:type_id ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
                    }
                }
            } else {
                if ($book_type === "ALL") {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id AND print_type=:print_type ORDER BY id ASC";
                    }
                } else {
                    if ($print_type === "ALL") {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id AND type_id=:type_id ORDER BY id ASC";
                    } else {
                        $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level_id AND type_id=:type_id AND print_type=:print_type ORDER BY id ASC";
                    }
                }
            }
        }

        $stmt = $this->prepareQuery($sql);
        if ($publisher !== "ALL") {
            $stmt->bindParam("publisher", $publisher);
        }
        if ($book_level !== "ALL") {
            $stmt->bindParam("level_id", $book_level);
        }
        if ($book_type !== "ALL") {
            $stmt->bindParam("type_id", $book_type);
        }
        if ($print_type !== "ALL") {
            $stmt->bindParam("print_type", $print_type);
        }

        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_filtered_records'] = true;
        } else {
            $_SESSION['yes_filtered_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return $values2;
        }
    }

    public function getAllCategoryBooks($category_type, $category_value) {
        if ($category_type === "level") {
            if ($category_value === "ecd_books") {
                $category_code = $this->getBookLevelRefTypeId("ECD");
            } else if ($category_value === "primary_books") {
                $category_code = $this->getBookLevelRefTypeId("PRIMARY LEVEL");
            } else if ($category_value === "secondary_books") {
                $category_code = $this->getBookLevelRefTypeId("SECONDARY LEVEL");
            } else if ($category_value === "adult_books") {
                $category_code = $this->getBookLevelRefTypeId("ADULT READER");
            }
            $category = $category_type;
            $value = $category_code;
            $sql = "SELECT * FROM books WHERE level_id=:category_value ORDER BY id ASC";
        }

        if ($category_type === "type") {
            if ($category_value === "english_books") {
                $category_code = $this->getBookTypeRefTypeId("ENGLISH READER");
            } else if ($category_value === "kiswahili_books") {
                $category_code = $this->getBookTypeRefTypeId("KISWAHILI READER");
            } else if ($category_value === "activity_books") {
                $category_code = $this->getBookTypeRefTypeId("ACTIVITY");
            }
            $category = $category_type;
            $value = $category_code;
            $sql = "SELECT * FROM books WHERE type_id=:category_value ORDER BY id ASC";
        }

        if ($category_type === "publisher") {
            if ($category_value === "storymoja_books") {
                $category_code = $this->getBookPublisherRefTypeId("STORYMOJA");
            } else if ($category_value === "klb_books") {
                $category_code = $this->getBookPublisherRefTypeId("KENYA LITERATURE BUREAU");
            } else if ($category_value === "longhorn_books") {
                $category_code = $this->getBookPublisherRefTypeId("LONGHORN");
            } else if ($category_value === "phoenix_books") {
                $category_code = $this->getBookPublisherRefTypeId("PHOENIX");
            } else if ($category_value === "moran_books") {
                $category_code = $this->getBookPublisherRefTypeId("MORAN");
            } else if ($category_value === "self_publisher_books") {
                $category_code = $this->getBookPublisherRefTypeId("SELF PUBLISHER");
            }
            $category = $category_type;
            $value = $category_code;
            $sql = "SELECT * FROM books WHERE publisher=:category_value ORDER BY id ASC";
        }

        if ($category_type === "print_type") {
            if ($category_value === "printed_books") {
                $category_code = "PRINTED";
            } else if ($category_value === "digital_books") {
                $category_code = "DIGITAL";
            }
            $category = $category_type;
            $value = $category_code;
            $sql = "SELECT * FROM books WHERE print_type=:category_value ORDER BY id ASC";
        }

        if ($category_type === "primary_class") {
            $category_code = $this->getBookLevelRefTypeId("PRIMARY LEVEL");
            if ($category_value === "class_one_books") {
                $class_code = 1;
            } else if ($category_value === "class_two_books") {
                $class_code = 2;
            } else if ($category_value === "class_three_books") {
                $class_code = 3;
            } else if ($category_value === "class_four_books") {
                $class_code = 4;
            } else if ($category_value === "class_five_books") {
                $class_code = 5;
            } else if ($category_value === "class_six_books") {
                $class_code = 6;
            } else if ($category_value === "class_seven_books") {
                $class_code = 7;
            } else if ($category_value === "class_eight_books") {
                $class_code = 8;
            }
            $category = $category_code;
            $value = $class_code;
            $sql = "SELECT * FROM books WHERE level_id=:category_type AND class=:category_value ORDER BY id ASC";
        }

        if ($category_type === "secondary_class") {
            $category_code = $this->getBookLevelRefTypeId("SECONDARY LEVEL");
            if ($category_value === "form_one_books") {
                $class_code = 1;
            } else if ($category_value === "form_two_books") {
                $class_code = 2;
            } else if ($category_value === "form_three_books") {
                $class_code = 3;
            } else if ($category_value === "form_four_books") {
                $class_code = 4;
            }
            $category = $category_code;
            $value = $class_code;
            $sql = "SELECT * FROM books WHERE level_id=:category_type AND class=:category_value ORDER BY id ASC";
        }

        $stmt = $this->prepareQuery($sql);
        if ($category_type === "primary_class" OR $category_type === "secondary_class") {
            $stmt->bindParam("category_type", $category);
        }
        $stmt->bindParam("category_value", $value);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_category_records'] = true;
        } else {
            $_SESSION['yes_category_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return $values2;
        }
    }

    public function getBookLevelRefTypeId($level) {
        $sql = "SELECT id, status FROM book_levels WHERE name=:level";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $level);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $data[0];
        return strtoupper($data['id']);
    }

    public function getBookTypeRefTypeId($type) {
        $sql = "SELECT id, status FROM book_types WHERE name=:type";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("type", $type);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $data[0];
        return strtoupper($data['id']);
    }

    public function getAllLevelBooks($level) {

        $level_code = $this->getBookLevelRefTypeId($level);

        $sql = "SELECT * FROM books WHERE level_id=:level ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $level_code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            if ($level === "ECD") {
                $_SESSION['no_ecd_records'] = true;
            } else if ($level === "PRIMARY LEVEL") {
                $_SESSION['no_primary_records'] = true;
            } else if ($level === "SECONDARY LEVEL") {
                $_SESSION['no_secondary_records'] = true;
            } else if ($level === "ADULT READER") {
                $_SESSION['no_adult_records'] = true;
            }
        } else {
            if ($level === "ECD") {
                $_SESSION['yes_ecd_records'] = true;
            } else if ($level === "PRIMARY LEVEL") {
                $_SESSION['yes_primary_records'] = true;
            } else if ($level === "SECONDARY LEVEL") {
                $_SESSION['yes_secondary_records'] = true;
            } else if ($level === "ADULT READER") {
                $_SESSION['yes_adult_records'] = true;
            }
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getBookPublisherRefTypeId($publisher) {
        $users = new Users();
        return $users->getPublisherRefTypeId($publisher);
    }

    public function getAllPublisherBooks($publisher) {

        $publisher_code = $this->getBookPublisherRefTypeId($publisher);

        $sql = "SELECT * FROM books WHERE publisher=:publisher ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("publisher", $publisher);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            if ($publisher === "STORY MOJA") {
                $_SESSION['no_1_records'] = true;
            } else if ($publisher === "KENYA LITERATURE BUREAU") {
                $_SESSION['no_2_records'] = true;
            } else if ($publisher === "LONGHORN") {
                $_SESSION['no_3_records'] = true;
            } else if ($publisher === "MORAN") {
                $_SESSION['no_4_records'] = true;
            }
        } else {
            if ($publisher === "STORY MOJA") {
                $_SESSION['yes_1_records'] = true;
            } else if ($publisher === "KENYA LITERATURE BUREAU") {
                $_SESSION['yes_2_records'] = true;
            } else if ($publisher === "LONGHORN") {
                $_SESSION['yes_3_records'] = true;
            } else if ($publisher === "MORAN") {
                $_SESSION['yes_4_records'] = true;
            }
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getPublisherLevelBooks($publisher, $level) {

        $level_code = $this->getBookLevelRefTypeId($level);

        $sql = "SELECT * FROM books WHERE publisher=:publisher AND level_id=:level ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("level", $level_code);
        $stmt->bindValue("publisher", $publisher);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            if ($level === "ECD") {
                $_SESSION['no_ecd_records'] = true;
            } else if ($level === "PRIMARY LEVEL") {
                $_SESSION['no_primary_records'] = true;
            } else if ($level === "SECONDARY LEVEL") {
                $_SESSION['no_secondary_records'] = true;
            } else if ($level === "ADULT READER") {
                $_SESSION['no_adult_records'] = true;
            }
        } else {
            if ($level === "ECD") {
                $_SESSION['yes_ecd_records'] = true;
            } else if ($level === "PRIMARY LEVEL") {
                $_SESSION['yes_primary_records'] = true;
            } else if ($level === "SECONDARY LEVEL") {
                $_SESSION['yes_secondary_records'] = true;
            } else if ($level === "ADULT READER") {
                $_SESSION['yes_adult_records'] = true;
            }
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllTypeBooks($type) {

        $type_code = $this->getBookTypeRefTypeId($type);

        $sql = "SELECT * FROM books WHERE type_id=:type ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("type", $type_code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            if ($type === "ENGLISH READER") {
                $_SESSION['no_english_records'] = true;
            } else if ($type === "KISWAHILI READER") {
                $_SESSION['no_kiswahili_records'] = true;
            } else if ($type === "POETRY") {
                $_SESSION['no_poetry_records'] = true;
            } else if ($type === "LIFESTYLE") {
                $_SESSION['no_lifestyle_records'] = true;
            }
        } else {
            if ($type === "ENGLISH READER") {
                $_SESSION['yes_english_records'] = true;
            } else if ($type === "KISWAHILI READER") {
                $_SESSION['yes_kiswahili_records'] = true;
            } else if ($type === "POETRY") {
                $_SESSION['yes_poetry_records'] = true;
            } else if ($type === "LIFESTYLE") {
                $_SESSION['yes_lifestyle_records'] = true;
            }
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getAllBooks() {
        $sql = "SELECT * FROM books ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "publisher_type" => $data['publisher_type'], "publisher" => $data['publisher'], "type_id" => $data['type_id'], "level_id" => $data['level_id'], "price" => $data['price'], "cover_photo" => $data['cover_photo'], "status" => $data['status'], "createdat" => $data['createdat'], "createdby" => $data['createdby'], "lastmodifiedat" => $data['lastmodifiedat'], "lastmodifiedby" => $data['lastmodifiedby']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

}
