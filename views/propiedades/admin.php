<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <?php 
        if($resultado){
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje){ 
    ?>
            <p class="alerta exito"> <?php echo s($mensaje); ?> </p>
    <?php 
    }    
    }
    ?>

    <a href="propiedades/crear" class="boton boton_verde">Nueva Propiedad</a>
    <a href="vendedores/crear" class="boton boton_amarillo">Nuevo Vendedor</a>
    <?php if($_SESSION['usuario'] === 'correo@correo.com'):?>
        <a href="auth/usuarios" class="boton boton_amarillo">Nuevo Usuario</a>
    <?php endif; ?>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id;?></td>
                <td><?php echo $propiedad->titulo;?></td>
                <td><img src="/imagenes/<?php echo $propiedad->imagen;?>" class="imagen_tabla"></td>
                <td>$<?php echo $propiedad->precio;?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id"  value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo"  value="propiedad">
                        <input type="submit" class="boton_rojo_block" value="Eliminar">
                    </form>
                    <a class="boton_amarillo_block" href="/propiedades/actualizar?id=<?php echo $propiedad->id  ?>">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id;?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido;?></td>
                <td><?php echo $vendedor->telefono;?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <input type="hidden" name="id"  value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo"  value="vendedor">
                        <input type="submit" class="boton_rojo_block" value="Eliminar">
                    </form>
                    <a class="boton_amarillo_block" href="vendedores/actualizar?id=<?php echo $vendedor->id  ?>">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>