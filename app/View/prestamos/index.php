<h2>Préstamos Activos</h2>
<a href="?controller=prestamos&action=create">Nuevo Préstamo</a>
// Formulario de búsqueda y filtrado
<form method="GET" action="">
    <input type="hidden" name="controller" value="prestamos">
    <input type="text" name="q" placeholder="Buscar usuario o herramienta" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <select name="estado">
        <option value="">-- Estado --</option>
        <option value="activo" <?= (($_GET['estado'] ?? '') === 'activo') ? 'selected' : '' ?>>Activo</option>
        <option value="devuelto" <?= (($_GET['estado'] ?? '') === 'devuelto') ? 'selected' : '' ?>>Devuelto</option>
    </select>
    <button type="submit">Buscar/Filtrar</button>

</form>

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
