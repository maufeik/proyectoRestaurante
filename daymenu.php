<?php
session_start();
require_once './fn-php/fn-roles.php';
if (!isGranted($_SESSION['role'] ?? '', 'daymenu')) {
    header("Location: index.php");
    exit();
}

/**
 * @param string $filepath La ruta al archivo del menú.
 * @return array Un array asociativo donde la clave es la categoría y el valor es un array de nombres de ítems.
 */
function getDayMenu(string $filepath): array {
    $menu = [];
    if (!file_exists($filepath)) {
        return $menu;
    }
    
    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false || count($lines) < 2) {
        return $menu; 
    }

    $dataLines = array_slice($lines, 1);

    foreach ($dataLines as $line) {
        $parts = explode(';', $line);
        if (count($parts) === 3) {
            $category = trim($parts[1]);
            $name = trim($parts[2]);

            if (!isset($menu[$category])) {
                $menu[$category] = [];
            }
            $menu[$category][] = $name;
        }
    }
    return $menu;
}

$dayMenu = getDayMenu('files/daymenu.txt');
$categories = [
    'appetiser' => 'Appetiser',
    'firstcourse' => 'Firstcourse',
    'maincourse' => 'Maincourse',
    'dessert' => 'Dessert',
    'drink' => 'Drink'
];

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
            <?php include 'includes/navbar.php'?>
            <div class="container">
                <h2>Day Menu</h2>

                <?php if (!empty($dayMenu)): ?>
                    <?php foreach ($categories as $key => $title): ?>
                        <?php if (isset($dayMenu[$key])):?>
                            <h3><?php echo $title; ?></h3>
                            <ul class="list-group">
                                <?php foreach ($dayMenu[$key] as $name): ?>
                                    <li class="list-group-item">
                                        <?php echo htmlspecialchars($name); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="alert alert-warning">No hay elementos disponibles en el menú diario.</p>
                <?php endif; ?>
            </div>
            <?php include_once "includes/footer.php";?>
        </div>
    </body>
</html>