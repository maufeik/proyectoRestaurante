<nav class="navbar navbar-default">
<div class="container col-md-10">
<div class="navbar-header">
<a class="navbar-brand" href="https://www.proven.cat">ProvenSoft</a>
</div>
<ul class="nav navbar-nav">
<li><a href='index.php'>Home</a></li>
<li><a href='daymenu.php'>Day Menu</a></li>
<li><a href='viewmenus.php'>View Menus</a></li>
<li><a href='adminmenus.php'>Admin Menus</a></li>
<li><a href='adminusers.php'>Admin users</a></li>
<li><a href='register.php'>Register</a></li>
<li><a href='login.php'>Login</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul>
</div>
<span class="userinfo">
<?php 
if (isset($_SESSION['name']) and $_SESSION['surname']) { 
    echo $_SESSION['name'] . " " . $_SESSION['surname'];
}
 ?>
</span>
</nav>
