<?php
session_start();
if (isset($_SESSION['role'])) {  //session exists
    session_destroy();
    header("Location: index.php");    
} else {

    echo "<p>You must login before logout</p>";
    header("Location: index.php");    
}
