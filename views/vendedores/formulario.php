<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombre del vendedor" 
        value="<?php echo s($vendedor->nombre) ?>">  <!--para guardar lo que el usuario ya ha escrito -->

    <label for="apellido">Apellido</label>
    <input 
        type="text" 
        id="apelllido" 
        name="vendedor[apellido]" 
        placeholder="Apellido del vendedor" 
        value="<?php echo s($vendedor->apellido) ?>">

    <label for="telefono">Telefono</label>
    <input 
        type="tel" 
        id="telefono" 
        name="vendedor[telefono]" 
        placeholder="Teléfono del vendedor" 
        value="<?php echo s($vendedor->telefono) ?>">
</fieldset>