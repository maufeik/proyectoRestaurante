<?php
session_start();
require_once './fn-php/fn-roles.php'
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DAWBI-M07-Pt11</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container-fluid">
        <?php
        // 1. Obtener el rol, usando '' si la sesión no lo tiene.
        $user_role = $_SESSION['role'] ?? '';

        // 2. Determinar qué menú mostrar con la lógica clara.
        if (isGranted($user_role, 'index')) {
            // Si tiene permiso (ej. es 'admin'), muestra el menú de administrador
            include_once "topmenuadmi.php";
        } elseif ($user_role === '') {
            // Si NO tiene permiso Y el rol está vacío, muestra el menú de invitado/público
            include_once "topmenu.php";
        } else {
            // Para cualquier otro caso donde NO tiene permiso (ej. rol 'user' sin permiso), muestra el menú de usuario logueado
            include_once "topmenuloged.php";
        }
        ?>
        <div class="container">
        <h2>Restaurant application</h2>
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
</p>
        </div>
        <?php include_once "footer.php";?>
    </div>
    </body>
</html>