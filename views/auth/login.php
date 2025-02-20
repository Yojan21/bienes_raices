<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu email" id="email" novalidate>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu password" id="password" novalidate>

            <a href="/admin">
            <input type="submit" class="boton boton_verde" value="iniciar Sesión">
            </a>
        </fieldset>
    </form>
</main>