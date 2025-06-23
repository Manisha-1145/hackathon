<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <title>Login & Register</title>
</head>

<body>
  <div class="container" id="container">
    
    <!-- Registration Form -->
    <div class="form-container sign-in">
      <form method="post" action="">
        <h1>Register</h1>
        <br>
        <input type="text" name="firstname" placeholder="First Name" required />
        <input type="text" name="lastname" placeholder="Last Name" required />
        <input type="text" name="username" placeholder="Username" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Sign Up</button>
      </form>
    </div>

    <!-- Sign In Form -->
    <div class="form-container sign-up">
      <form method="post" action="">
        <h1>Sign In</h1>
        <br>
        <input type="email" name="loginEmail" placeholder="Email" required />
        <input type="password" name="loginPassword" placeholder="Password" required />
        <button type="submit">Sign In</button>
      </form>
    </div>

    <!-- Toggle Panels -->
    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-right">
          <h1> Hello, Friend ツ</h1>
          <p>Welcome to our website!!! Create an account to access all the features. But if you already have an account, just sign in ↓</p>
          <button class="hidden" id="register">Sign In</button>
        </div>
        <div class="toggle-panel toggle-left">
          <h1>Welcome Back :)</h1>
          <p>It's great to see you again... Please log in to continue. If you dont have an account, just create one ↓</p>
          <button class="hidden" id="login">Sign Up</button>
        </div>
      </div>
    </div>

  </div>

  <script src="script.js"></script>
</body>
</html>

<!-- login&register.php -->
<?php
include"./db_operation.php";
$connString = connectToDatabase();
$tableName = 'userDetails';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['firstname']))  {
      insertUser($tableName, $_POST['firstname'], $_POST["lastname"], $_POST['username'],$_POST['email'], $_POST['password'],$connString);
    } else if (isset($_POST['loginEmail'], $_POST['loginPassword'])){
         getData($tableName, $_POST['loginEmail'], $_POST['loginPassword'], $connString);
    }
}
?>