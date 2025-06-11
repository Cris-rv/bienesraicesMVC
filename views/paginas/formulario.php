            <fieldset>
                <legend>Informacion Personal</legend>
                
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu nombre" name="contacto[nombre]" id="nombre" required>
                
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Sobre la Propiedad</legend>

                <label for="opciones">Vende o Compra:</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" name="contacto[precio]" id="presupuesto" required>

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto[contacto]" type="radio" value="email" id="contactar-email">
                </div>

                <div id="contacto"></div>
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">