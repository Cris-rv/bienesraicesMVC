    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php if($mensaje) : ?>
            <p class='alerta exito'> <?php echo $mensaje; ?> </p>;
        <?php endif; ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen de contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario</h2>

        <form class="formulario" method="POST" action="/contacto">
            <?php include __DIR__ . '/formulario.php'; ?>
        </form>
    </main>