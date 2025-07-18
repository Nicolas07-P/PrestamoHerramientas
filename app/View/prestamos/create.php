<?php 
/**
 * Vista: Creacion de Préstamos
 * Path: /app/View/prestamos/create.php
 *
 * Descripción: Muestra el formulario para registrar nuevos préstamos de herramientas en el sistema.
 *
 * Datos requeridos: 
 *
 * Acciones:
 * - Creación: Enlace a ?controller=herramientas&action=create
 * - Edición: Enlace a ?controller=herramientas&action=edit&id=[ID]
 * - Eliminación: Enlace a ?controller=herramientas&action=delete&id=[ID]
 * - Error: Muestra alerta si error='relacionada'
 */
include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="../public/assets/css/styles.css">

<div class="form-prestamo">
    <h2>Registrar Préstamo</h2>
    
    <form method="POST" action="?controller=prestamos&action=store">
        <div id="herramientas-container">
            <div class="herramienta-item">
                <label>Herramienta:</label>
                <select name="herramientas[]">
                    <?php foreach ($herramientas as $h): ?>
                        <option value="<?= $h['id'] ?>">
                            <?= $h['nombre'] ?> (Disponibles: <?= $h['cantidad_disponible'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <label>Cantidad:</label>
                <input type="number" name="cantidades[]" min="1" value="1" max="<?= $h['cantidad_disponible'] ?? '' ?>">
            </div>
        </div>
        
        <button type="button" onclick="agregarHerramienta()" class="btn-agregar">+ Añadir herramienta</button>
        
        <div class="fechas">
            <label>Fecha préstamo:</label>
            <input type="date" name="fecha_prestamo" required>
            
            <label>Fecha devolución estimada:</label>
            <input type="date" name="fecha_devolucion_estimada" required>
        </div>
        
        <div class="botones">
            <button type="submit" class="btn-guardar">Guardar préstamo</button>
            <a href="?controller=auth&action=login" class="btn-volver">Volver</a>
        </div>
    </form>
</div>

<script>
function agregarHerramienta() {
    const container = document.getElementById('herramientas-container');
    const clone = container.children[0].cloneNode(true);
    container.appendChild(clone);
}
</script>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>