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
        <?php include 'navbar.php' ?>
        <div class="container">
        <h2>Restaurant application</h2>
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
</p>
    
                <div class="image-slider">
                    <div class="slider-container">
                        <?php
                            // Array de imágenes disponibles
                            $images = array(
                                array('src' => 'images/restaurante.jfif', 'alt' => 'Restaurante 1'),
                                array('src' => 'images/empleados.avif', 'alt' => 'Restaurante 2')
                            );
                            
                            // Obtener la imagen actual según la sesión o parámetro
                            $currentImage = isset($_GET['slide']) ? intval($_GET['slide']) : 0;
                            if ($currentImage >= count($images)) {
                                $currentImage = 0;
                            }
                            
                            // Mostrar imagen actual
                            $image = $images[$currentImage];
                            echo '<img src="' . htmlspecialchars($image['src']) . '" alt="' . htmlspecialchars($image['alt']) . '" width="750px">';
                        ?>
                    </div>
                    
                    <!-- Botones de navegación -->
                    <div class="slider-controls">
                        <?php
                            $prevSlide = ($currentImage - 1 + count($images)) % count($images);
                            $nextSlide = ($currentImage + 1) % count($images);
                        ?>
                        <a href="?slide=<?php echo $prevSlide; ?>" class="slider-btn slider-btn-prev">&lsaquo;</a>
                        <a href="?slide=<?php echo $nextSlide; ?>" class="slider-btn slider-btn-next">&rsaquo;</a>
                    </div>
                    
                    <!-- Indicadores de diapositivas -->
                    <div class="slider-indicators">
                        <?php
                            for ($i = 0; $i < count($images); $i++) {
                                $class = ($i === $currentImage) ? 'active' : '';
                                echo '<a href="?slide=' . $i . '" class="indicator ' . $class . '"></a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </div>
        <?php include_once "footer.php";?>
    </div>
</html>