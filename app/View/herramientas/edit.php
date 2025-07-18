<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<h2>Editar Herramienta</h2>

<form class="form-herramienta" method="POST" action="?controller=herramientas&action=update&id=<?= $herramienta['id'] ?>">
    <div class="campo">
        <input name="nombre" value="<?= $herramienta['nombre'] ?>" placeholder="Nombre" required>
    </div>
    
    <div class="campo">
        <textarea name="descripcion" placeholder="Descripción"><?= $herramienta['descripcion'] ?></textarea>
    </div>
    
    <div class="campo">
        <input name="cantidad_disponible" type="number" value="<?= $herramienta['cantidad_disponible'] ?>" placeholder="Cantidad" required>
    </div>
    
    <div class="botones">
        <button type="submit">Guardar Cambios</button>
        <a href="?controller=auth&action=login" class="boton-volver">Volver al inicio</a>
    </div>
</form>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>