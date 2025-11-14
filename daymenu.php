<?php
session_start();
require_once './fn-php/fn-roles.php';

// --- LÓGICA PARA LEER Y PROCESAR EL MENÚ (AJUSTADA) ---

/**
 * Lee y procesa el archivo del menú diario.
 * Asume el formato: id;category;name
 * @param string $filepath La ruta al archivo del menú.
 * @return array Un array asociativo donde la clave es la categoría y el valor es un array de nombres de ítems.
 */
function getDayMenu(string $filepath): array {
    $menu = [];
    // Asegúrate de que el archivo existe antes de intentar leerlo
    if (!file_exists($filepath)) {
        return $menu;
    }
    
    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false || count($lines) < 2) {
        return $menu; // Devuelve un array vacío si hay un problema o solo el encabezado
    }

    // El primer elemento es el encabezado, lo ignoramos para los datos
    $dataLines = array_slice($lines, 1);

    foreach ($dataLines as $line) {
        $parts = explode(';', $line);
        // Esperamos exactamente 3 partes: id, category, name
        if (count($parts) === 3) {
            $category = trim($parts[1]);
            $name = trim($parts[2]);

            if (!isset($menu[$category])) {
                $menu[$category] = [];
            }
            // Añade el nombre del plato a su categoría
            $menu[$category][] = $name;
        }
    }
    return $menu;
}

// Obtiene el menú procesado
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
        <?php if (isGranted($_SESSION['role']??'', 'daymenu')): include_once "topmenuadmi.php";?> 
        <?php else: include_once "topmenuloged.php"; ?> 
        <?php endif; ?>
        <div class="container">
        <h2>Day Menu</h2>

        <?php if (!empty($dayMenu)): ?>
            <?php foreach ($categories as $key => $title): ?>
                <?php if (isset($dayMenu[$key])): // Verifica si hay platos para esta categoría ?>
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
        <?php include_once "footer.php";?>
    </div>
    </body>
</html>