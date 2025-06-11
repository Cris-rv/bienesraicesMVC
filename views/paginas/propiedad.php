    <main class="contenedor seccion">
        <h1><?php echo $propiedad->titulo; ?></h1>

            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad" loading="lazy">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad->precio ?></p>
            <ul class="iconos-caracteristicas contenido-centrado">
                <li>
                    <img src="build/img/icono_wc.svg" alt="icono WC" loading="lazy">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>

                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="icono Estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>

                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="icono Dormitorio" loading="lazy">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore deleniti incidunt ullam pariatur esse eveniet ex hic, possimus aliquid ipsam repellat id aut dolor, nemo facilis excepturi laudantium dolorum sapiente. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae iure laboriosam numquam esse mollitia unde nisi aspernatur et doloremque voluptatibus doloribus consequuntur sit fugit maxime, eos adipisci praesentium obcaecati dolorum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum accusamus quisquam perspiciatis similique ad sequi cumque cupiditate temporibus? Fugiat quis voluptatibus, animi rem ullam cupiditate pariatur.</p>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore deleniti incidunt ullam pariatur esse eveniet ex hic, possimus aliquid ipsam repellat id aut dolor, nemo facilis excepturi laudantium dolorum sapiente. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae iure laboriosam numquam esse mollitia unde nisi aspernatur et doloremque voluptatibus doloribus consequuntur sit fugit maxime, eos adipisci praesentium obcaecati dolorum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum accusamus quisquam perspiciatis similique ad sequi cumque cupiditate temporibus? Fugiat quis voluptatibus, animi rem ullam cupiditate pariatur.</p>
        </div>
    </main>