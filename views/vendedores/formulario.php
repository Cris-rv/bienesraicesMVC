<fieldset>
            <legend>Informacion General</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
</fieldset>

<fieldset>
            <legend>Informacion Extra</legend>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
            
            <label for="email">E-mail:</label>
            <input type="tel" id="email" name="vendedor[email]" placeholder="E-mail Vendedor(a)" value="<?php echo s($vendedor->email); ?>">  
</fieldset>

<!-- <fieldset>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]">

            <?php if($vendedor->imagen) :  ?>
                <img class="Imagen-small" src="/imagenes/<?php echo $vendedor->imagen ?>">
             <?php endif;?>
</fieldset> -->