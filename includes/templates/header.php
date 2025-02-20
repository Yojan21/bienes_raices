<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    
    $auth = $_SESSION['login'] ?? false;
    $inicio = $inicio ?? false;
    $link = $auth ? "/admin" : "/login.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''?>">
        <div class="contenedor contenido_header">
            <div class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="logotipo de bienes raices">
                </a>
                <div class="mobile_menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsived">
                </div>
                <div class="derecha">
                    <img class="dark_mode_boton" src="/build/img/dark-mode.svg" alt="dark mode">
                    <nav class="navegacion">
                        <a href= '<?php echo $link;?>'>Admin</a>
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($auth === true): ?>
                            <a href="/cerrar_sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php 
                if($inicio){
                    echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
                }
            ?>
        </div>
    </header>