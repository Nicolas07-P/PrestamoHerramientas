<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<div class="historial">
    <h2>Historial de Préstamos</h2>
    
    <table class="tabla-historial">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Herramienta</th>
                <th>Cantidad</th>
                <th>Préstamo</th>
                <th>Estimada</th>
                <th>Devuelto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamos as $p): ?>
            <tr>
                <td><?= $p['nombre'] . ' ' . $p['apellido'] ?></td>
                <td><?= $p['herramienta'] ?></td>
                <td><?= $p['cantidad'] ?></td>
                <td><?= date('d/m/Y', strtotime($p['fecha_prestamo'])) ?></td>
                <td><?= date('d/m/Y', strtotime($p['fecha_devolucion_estimada'])) ?></td>
                <td><?= $p['fecha_devolucion_real'] ? date('d/m/Y', strtotime($p['fecha_devolucion_real'])) : 'Pendiente' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="volver">
        <a href="?controller=auth&action=login">Volver al inicio</a>
    </div>
</div>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>