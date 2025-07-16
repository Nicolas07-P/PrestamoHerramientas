<h2>Préstamos Activos</h2>
<a href="?controller=prestamos&action=create">Nuevo Préstamo</a>


<table border="1">
    <tr>
        <th>Usuario</th>
        <th>Herramienta</th>
        <th>Cantidad</th>
        <th>Fecha Préstamo</th>
        <th>Acción</th>
    </tr>
    <?php foreach ($prestamos as $p): ?>
    <tr>
        <td><?= $p['nombre'] . ' ' . $p['apellido'] ?></td>
        <td><?= $p['herramienta'] ?></td>
        <td><?= $p['cantidad'] ?></td>
        <td><?= $p['fecha_prestamo'] ?></td>
        <td>
            <<a href="?controller=prestamos&action=devolver_parcial&id_detalle=<?= $p['id_detalle'] ?>">Devolver solo esta</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="?controller=prestamos&action=historial">Ver Historial</a>
<a href="?controller=auth&action=login">Inicio</a>
