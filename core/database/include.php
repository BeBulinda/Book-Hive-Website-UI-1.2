<?php
//Change host name, database type, database, username, password
require "Database.php";

Database::setUp(array(
	'dsn' => 'mysql:host=localhost;dbname=bookhive_v0.7;',
	'username' => 'root',
	'password' => 'sogoni1608'

    ));

                            