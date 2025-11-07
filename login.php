<?php
require_once './fn-php/fn-users.php';
$message = "";
if (filter_has_var(INPUT_POST, "loginsubmit")) {
    //TODO: improve validations
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    //search user
    $userinfo = searchUser($username);
    if (count($userinfo)!=0) {  //user found
        //check password
        if ($userinfo[1] === $password) {
        //start session
        session_start();
        //save data in session
        $_SESSION['role'] = $userinfo[2];
        $_SESSION['name'] = $userinfo[3];
        $_SESSION['surname'] = $userinfo[4];
        header("Location: index.php");            
        }
    } else {  //user not found
        $message = "Invalid credentials";
    }
} else {
    $username = "";
    $password = "";
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
   <?php include_once "topmenu.php";?>
  <h2>Login form</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="username">Email:</label>
      <input type="username" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo $username ?? ""; ?>">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" name="loginsubmit" class="btn btn-default">Submit</button>
  </form>
  <?php include_once "footer.php";?>
</div>
    <p class="error"><?php echo $message ?? ""; ?></p>
</body>
</html>