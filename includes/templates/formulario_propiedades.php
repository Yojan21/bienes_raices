

<fieldset>
    <legend>Información general</legend>

    <label for="titulo">Titulo</label>
    <input 
        type="text" 
        id="titulo" 
        name="propiedad[titulo]" 
        placeholder="Titulo Propiedad" 
        value="<?php echo s($propiedad->titulo) ?>">  <!--para guardar lo que el usuario ya ha escrito -->

    <label for="precio">Precio</label>
    <input 
        type="number" 
        id="precio" 
        name="propiedad[precio]" 
        placeholder="Precio Propiedad" 
        value="<?php echo s($propiedad->precio) ?>">

    <label for="imagen">Imagen</label>
    <input 
        type="file" 
        id="imagen" 
        name="propiedad[imagen]" 
        accept="image/jpeg, image/png">

    <?php if($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo $propiedad->imagen?>" class="imagen_small">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion) ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input 
        type="number" 
        id="habitaciones" 
        name="propiedad[habitaciones]" 
        placeholder="Ej: 3" 
        min="1" 
        value="<?php echo s($propiedad->habitaciones) ?>">

    <label for="wc">wc</label>
    <input 
        type="number" 
        id="wc" 
        name="propiedad[wc]" 
        placeholder="Ej: 3" 
        min="1" 
        value="<?php echo s($propiedad->wc) ?>">

    <label for="estacionamiento">Estacionamientos</label>
    <input 
        type="number" 
        id="estacionamiento" 
        name="propiedad[estacionamiento]" 
        placeholder="Ej: 3" 
        min="1" 
        value="<?php echo s($propiedad->estacionamiento) ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor_id">Vendedor</label>

    <select name="propiedad[vendedor_id]" id="vendedor_id">
        <option value="">--Seleccione--</option>
        <?php foreach ($vendedores as $vendedor): ?>
            <option 
            <?php echo ($propiedad->vendedor_id == $vendedor->id) ? 'selected' : ''; ?>
            value="<?php echo s($vendedor->id); ?>">
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option>
        <?php endforeach; ?>
    </select>
</fieldset>
