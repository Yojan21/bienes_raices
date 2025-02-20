<main class="contenedor seccion">
    <h1>Registrar vendedor</h1>
    <!-- Visualización de errores en la interfaz usando PHP -->
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error?>
        </div>
    <?php endforeach; ?>
    <a href="/admin" class="boton boton_verde">Volver</a>
    <!--Creación del formulario -->
    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include 'formulario.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton_verde">
    </form>
</main>