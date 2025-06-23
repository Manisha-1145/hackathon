<?php
include './db_operation.php';
include './index.php';
$tableName ="userDetails";
$connString = connectToDatabase();
createTable($tableName, $connString);
if(isset($_POST['username'])){ 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    insertUser($tableName,$username, $email, $password,$connString);
}
?>