    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <?php include 'iconos.php' ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
        <?php 
        include 'listado.php';
        ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">
                Ver Todas
            </a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor se pondra en contacto contigo a la brevedad</p>
        <a href="contacto" class="boton-amarillo">contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jprg">
                        <img src="build/img/blog1.jpg" alt="Texto Entrada Blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>1/05/2023</span> por: <span>Admin</span></p>
                        <p>Consejos para contruir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article> <!--.entrada-blog-->

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jprg">
                        <img src="build/img/blog2.jpg" alt="Imagen Blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>1/05/2023</span> por: <span>Admin</span></p>
                        <p> Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida tu espacio. </p>
                    </a>
                </div>
            </article> <!--.entrada-blog-->
        </section> <!--blog-->

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas
                </blockquote>
                <p>-Cristopher Rivas</p>
            </div>
        </section> <!--.Testimoniales-->
    </div> <!--.contenedor .seccion .seccion-inferior-->