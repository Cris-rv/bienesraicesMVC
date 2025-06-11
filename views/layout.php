<?php 
    // Si no esta definida o no existe entonces inicia sesion para ver los datos del usuario, pero no para proteger la url
    if(!isset($_SESSION)) {
        session_start();
    } 
    
    $auth = $_SESSION['login'] ?? false;
    
    if(!isset($inicio)) {
        $inicio = false;
    }
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
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="boton modo oscuro" class="dark-mode-btn">

                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                    <?php if($auth) : ?>
                        <a href="/admin">Administrar</a>
                        <a href="/logout">Cerrar Sesión</a>
                    <?php endif; ?>
                    <?php if(!$auth) : ?>
                        <a href="/login">Iniciar Sesión</a>
                    <?php endif; ?>
                    </nav>
                </div>
            </div> <!--Barra-->

            <div class="oculto">
                <img class="close" src="../build/img/x.svg" alt="Remover">

                <nav class="navegacion">
                    <a href="/">Inicio</a>
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Propiedades</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <?php if($auth) : ?>
                        <a href="/admin">Administrar</a>
                        <a href="/logout">Cerrar Sesión</a>
                    <?php endif; ?>
                    <?php if(!$auth) : ?>
                        <a href="login.php">Iniciar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>

            <?php echo $inicio ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : ''; ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Propiedades</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>
            <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy</p>
    </footer>

<script src="/build/js/bundle.min.js"></script>
</body>
</html>