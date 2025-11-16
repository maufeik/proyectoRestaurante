<?php
session_start();
require_once './fn-php/fn-roles.php';
/**
 * @param string $filepath La ruta al archivo del menú.
 * @return array Un array asociativo donde la clave es la categoría y el valor es un array de ítems (nombre y precio).
 */
function getFullMenu(string $filepath): array {
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
 
        if (count($parts) === 4) {
            $category = trim($parts[1]);
            $name = trim($parts[2]);
            $price = trim($parts[3]);

            if (!isset($menu[$category])) {
                $menu[$category] = [];
            }
    
            $menu[$category][] = [
                'name' => $name,
                'price' => $price
            ];
        }
    }
    return $menu;
}


$fullMenu = getFullMenu('files/menu.txt');
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
        <?php include 'navbar.php'?>
        <div class="container">
        <h2>Full Menu</h2>
        
        <?php if (!empty($fullMenu)): ?>
            <?php foreach ($categories as $key => $title): ?>
                <?php if (isset($fullMenu[$key])): // Verifica si hay platos para esta categoría ?>
                    <h3><?php echo $title; ?></h3>
                    <ul class="list-group">
                        <?php foreach ($fullMenu[$key] as $item): ?>
                            <li class="list-group-item">
                                <span class="pull-right badge"><?php echo number_format((float)$item['price'], 2, ',', '.') . ' €'; ?></span>
                                <?php echo htmlspecialchars($item['name']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="alert alert-warning">No hay elementos disponibles en el menú completo (menu.txt).</p>
        <?php endif; ?>
        </div>
        <?php include_once "footer.php";?>
    </div>
    </body>
</html>