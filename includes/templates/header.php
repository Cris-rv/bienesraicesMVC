<?php 
    // Si no esta definida o no existe entonces inicia sesion para ver los datos del usuario, pero no para proteger la url
    if(!isset($_SESSION)) {
        session_start();
    } 
    
    $auth = $_SESSION['login'] ?? false;
    // var_dump($auth);
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
    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="boton modo oscuro" class="dark-mode-btn">

                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                    <?php if($auth) : ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                    <?php if(!$auth) : ?>
                        <a href="login.php">Iniciar Sesión</a>
                    <?php endif; ?>
                    </nav>
                </div>
            </div> <!--Barra-->

            <div class="oculto">
                <img class="close" src="/build/img/x.svg" alt="Remover">

                <nav class="navegacion">
                    <a href="/index.php">Inicio</a>
                    <a href="/nosotros.php">Nosotros</a>
                    <a href="/anuncios.php">Anuncios</a>
                    <a href="/blog.php">Blog</a>
                    <a href="/contacto.php">Contacto</a>
                    <?php if($auth) : ?> <!-- si el usuario inicio sesion o sea retorna $_SESSION['login] = true; muestra lo siguiente -->
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                    <?php if(!$auth) : ?> <!-- caso contrario no inicia sesion como no hay nada en $_SESSION el default es false; muestra lo siguiente -->
                        <a href="login.php">Iniciar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>

            <?php echo $inicio ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : ''; ?>
        </div>
    </header>