<h2>Historial de Préstamos</h2>
<table border="1">
    <tr>
        <th>Usuario</th>
        <th>Herramienta</th>
        <th>Cantidad</th>
        <th>Fecha Préstamo</th>
        <th>Fecha Estimada</th>
        <th>Fecha Real Devolución</th>
    </tr>
    <?php foreach ($prestamos as $p): ?>
    <tr>
        <td><?= $p['nombre'] . ' ' . $p['apellido'] ?></td>
        <td><?= $p['herramienta'] ?></td>
        <td><?= $p['cantidad'] ?></td>
        <td><?= $p['fecha_prestamo'] ?></td>
        <td><?= $p['fecha_devolucion_estimada'] ?></td>
        <td><?= $p['fecha_devolucion_real'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="?controller=auth&action=login">Inicio</a>
