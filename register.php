<?php
session_start();
require_once './fn-php/fn-users.php';
require_once './fn-php/fn-roles.php';
$message = "";
if (filter_has_var(INPUT_POST, "registersubmit")) {

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
$name = filter_input(INPUT_POST, "name");
$surname = filter_input(INPUT_POST, "surname");

$userinfo = searchUser($username);

if(count($userinfo)!=0){
   $message = "Existing user";
}else{
  insertUser($username,$password,'Registered',$name, $surname);
  $message = "User created successfully";
}

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid"> 

 <?php include 'navbar.php' ;?>

  <h2>Registration form</h2>
    <p class="error"><?php echo $message ?? ""; ?></p>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="surname">Surname:</label>
      <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname">
    </div>
    <button type="submit" name="registersubmit" class="btn btn-default">Submit</button>
  </form>

  <?php include_once "footer.php";?>
</div>

</body>
</html>