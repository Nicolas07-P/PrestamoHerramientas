<?php include __DIR__ . '/../VistaReutilizable/encabezado.php'; ?>
<link rel="stylesheet" href="/Sistema_prestamo_de_herramientas/public/assets/css/styles.css">

<div class="prestamos">
    <h2>Préstamos Activos</h2>
    
    <a href="?controller=prestamos&action=create" class="boton">Nuevo Préstamo</a>
    
    <form class="filtros" method="GET" action="">
        <input type="hidden" name="controller" value="prestamos">
        <input type="text" name="q" placeholder="Buscar..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <select name="estado">
            <option value="activo" <?= ($_GET['estado'] ?? '') === 'activo' ? 'selected' : '' ?>>Activos</option>
            <option value="devuelto" <?= ($_GET['estado'] ?? '') === 'devuelto' ? 'selected' : '' ?>>Devueltos</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>
    
    <table class="tabla-prestamos">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Herramienta</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamos as $p): ?>
            <tr>
                <td><?= $p['nombre'] . ' ' . $p['apellido'] ?></td>
                <td><?= $p['herramienta'] ?></td>
                <td><?= $p['cantidad'] ?></td>
                <td><?= date('d/m/Y', strtotime($p['fecha_prestamo'])) ?></td>
                <td class="acciones">
                    <a href="?controller=prestamos&action=devolver_parcial&id_detalle=<?= $p['id_detalle'] ?>">Devolver</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="enlaces">
        <a href="?controller=prestamos&action=historial" class="boton">Historial</a>
        <a href="?controller=auth&action=login" class="boton-secundario">Inicio</a>
    </div>
</div>

<?php include __DIR__ . '/../VistaReutilizable/pie.php'; ?>