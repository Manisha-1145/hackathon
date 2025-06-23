<?php
function connectToDatabase(){
    $host= "localhost";
    $username = "root";//default
    $password = NULL;//value 
    $dbname ="hackathon";

    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username, $password);
        $conn->setAttribute( PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e)
    {
      echo "Connection failed". $e->getMessage();
    }
}
// try catch error handling--if error catch runs error
function createTable($tableName, $conn){
     $query ="CREATE TABLE IF NOT EXISTS $tableName( 
    --  query error shown in execute -->
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(50) NOT NULL,
      email VARCHAR(50) NOT NULL,
      password VARCHAR(250) NOT NULL);";
      try{
       $createaTable = $conn->prepare($query);
       $createaTable->execute();
      }catch(PDOException $e){
        echo"table not created". $e->getMessage();//boolean return  not echo value return
      }
}
function insertUser($tableName,$firstName, $lastName, $username, $email, $password,$conn) {
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO $tableName (firstname, lastname, username, email, password) 
    VALUES ('$firstName','$lastName','$username', '$email' , '$hashedpassword')";
    try {
        $insertTable= $conn->prepare($query);
       
        if( $insertTable->execute()){
             // Redirect to login page after successful insertion
            header("Location: sample.php");
        }
        // echo "</br>"."Data inserted successfully";
    } catch (PDOException $e) {
        echo "</br>"."failed to insert data".$e->getMessage(); 
    }
}
function getData($tableName, $email,$password,$conn){
    $query = "SELECT * FROM $tableName WHERE email = :email";
    try {
        $get = $conn->prepare($query);
        $get->bindParam(':email', $email, PDO::PARAM_STR);
        $get->execute();
        $user = $get->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password,$user['password'])) {
            header("Location: sample.php");
            echo "Login successful!"; 
            exit();
        } else {
            echo "Invalid username or password";
        }
    } catch (PDOException $e) {
        echo "Login failed" . $e->getMessage();
    }
}
?>