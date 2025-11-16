<?php
$role = $_SESSION['role'] ?? '';
$isLoggedIn = !empty($role);
$userName = '';

if ($isLoggedIn && isset($_SESSION['name']) && isset($_SESSION['surname'])) {
    $userName = htmlspecialchars($_SESSION['name'] . ' ' . $_SESSION['surname']);
}
?>

<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <span class="glyphicon glyphicon-cutlery"></span> ProvenSoft
      </a>
    </div>
    
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        
        <?php if (!$isLoggedIn): ?>
          <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          
        <?php elseif ($isLoggedIn && $role !== 'admin'):?>
          <li><a href="daymenu.php"><span class="glyphicon glyphicon-list-alt"></span> Day Menu</a></li>
          <li><a href="viewmenus.php"><span class="glyphicon glyphicon-eye-open"></span> View Menus</a></li>
          
        <?php elseif ($role === 'admin'): ?>
          <li><a href="daymenu.php"><span class="glyphicon glyphicon-list-alt"></span> Day Menu</a></li>
          <li><a href="viewmenus.php"><span class="glyphicon glyphicon-eye-open"></span> View Menus</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-cog"></span> Admin <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="adminmenus.php"><span class="glyphicon glyphicon-cutlery"></span> Admin Menus</a></li>
              <li><a href="adminusers.php"><span class="glyphicon glyphicon-user"></span> Admin Users</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <?php if ($isLoggedIn): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle user-dropdown" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span> 
              <?php echo $userName; ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">
                <strong><?php echo $userName; ?></strong><br>
                <small class="text-muted"><?php echo ucfirst($role); ?></small>
              </li>
              <li class="divider"></li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>