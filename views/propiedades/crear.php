<main class="contenedor seccion">
    <h1>Crear</h1>
    <!-- Visualización de errores en la interfaz usando PHP -->
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error?>
        </div>
    <?php endforeach; ?>
    <a href="/admin" class="boton boton_verde">Volver</a>
    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php 
            include __DIR__ . '/formulario.php';
        ?>
    <input type="submit" value="Crear Propiedad" class="boton boton_verde">
    </form>
</main>