<?php
require_once './fn-php/fn-users.php';
//test search user that exists
echo "test: search user that exists";
$result = searchUser("user2");
//echo "<pre>";
print_r($result);
//echo "</pre>";
//test search user that does not exist
echo "test: search user that does not exist";
$result = searchUser("user9");
//echo "<pre>";
print_r($result);
//echo "</pre>";
//test insert user that does not exist
echo "\ntest: insert user that does not exist\n";
$success = insertUser("user7", "pass7", "registered", "name7", "surname7");
echo $success ? "inserted": "not inserted";
//test insert user that exists
echo "\ntest: insert user that exists\n";
$success = insertUser("user2", "pass7", "registered", "name7", "surname7");
echo $success ? "inserted": "not inserted";
