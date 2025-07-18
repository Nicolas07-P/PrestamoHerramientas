/**
 * Vista: Crear Herramienta
 * Path: /app/View/herramientas/create.php
 * Descripción: Muestra el formulario para registrar nuevas herramientas en el sistema.
 * 
 * Datos requeridos:
 * - $herramientas: Array de herramientas disponibles para préstamo
 * 
 * Acciones:
 * - POST a ?controller=herramientas&action=store
 */
<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<div class="form-herramienta">
    <h2 class="titulo-centrado">Crear Herramienta</h2>
    
    <form method="POST" action="?controller=herramientas&action=store">
        <label>Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre" required>
        
        <label>Descripción:</label>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
        
        <label>Cantidad:</label>
        <input type="number" name="cantidad_disponible" min="0" required>
        
        <div class="botones">
            <button type="submit">Guardar</button>
            <a href="?controller=herramientas" class="boton">Ver herramientas</a>
            <a href="?controller=auth&action=login" class="boton">Inicio</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>