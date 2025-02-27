<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if($mensaje): ?>
            <p class="alerta exito"><?php echo $mensaje;?></p>
    <?php endif;?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>
    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>


            <label for="mensaje">Mensaje</label>
            <textarea id="nombre" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>  
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra:</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option> 
            </select>
            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu precio opciones presupuesto" id="presupuesto" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Información sobre contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma_contacto">
                <label for="contactar_telefono">Teléfono</label>
                <input type="radio" value="telefono" id=contactar_telefono name="contacto[contacto]" required>

                <label for="contactar_email">Email</label>
                <input type="radio" value="email" id="contactar_email" name="contacto[contacto]" required>
            </div>

            <div id="contacto">

            </div>
            
        </fieldset>
        <input type="submit" value="Enviar" class="boton_verde">
    </form>
</main>