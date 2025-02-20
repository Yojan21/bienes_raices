<main class="contenedor seccion">
        <h1>Crear Usuarios</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
            <?php echo $error?>
            </div>
        <?php endforeach; ?>
        <!--Creación del formulario -->
        <form class="formulario" method="POST" action="/auth/usuarios" enctype="multipart/form-data">
            <fieldset>
                <legend>Completa los campos</legend>

                <label for="Nombre">Correo</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Email" 
                    value="<?php echo $email ?>">  <!--para guardar lo que el usuario ya ha escrito -->

                <label for="Apellido">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Password" 
                    value="<?php echo $password ?>">
            </fieldset>
            <a href="/admin">
                <input type="submit" value="Crear Usuario" class="boton boton_verde">
            </a>
        </form>
    </main>