<?php
require_once __DIR__.'/../Helpers/Auth.php';
require_once __DIR__.'/../Model/Prestamo.php';
require_once __DIR__.'/../Model/Herramienta.php';
class PrestamoController {

    public function __construct() {
        Auth::requireLogin();
    }
    public function index() {
        // Filtros de búsqueda desde GET
        $q = $_GET['q'] ?? '';
        $estado = $_GET['estado'] ?? 'activo';

        // Obtener préstamos filtrados
        $prestamos = Prestamo::buscar($q, $estado);
        include '../app/View/prestamos/index.php';
    }

    public function historial() {
        $prestamos = Prestamo::prestamosCompletados();
        include '../app/View/prestamos/historial.php';
    }
    // Funcion para crear un nuevo prestamo
    public function create() {
        $herramientas = Herramienta::all(); // se pasa las herramientas disponibles para un psoterior uso en la vista
        include '../app/View/prestamos/create.php';
    }

    public function store($data) {
        $data['id_usuario'] = $_SESSION['usuario']['id'];

        // 1. Crear préstamo general
        $idPrestamo = Prestamo::crearDevolverId($data);

        // 2. Obtener herramientas y cantidades
        $herramientas = $data['herramientas'];
        $cantidades = $data['cantidades'];

        // 3. Guardar cada herramienta prestada
        foreach ($herramientas as $i => $idHerramienta) {
            $cantidad = (int)$cantidades[$i];

            // Guardar en detalle_prestamos
            Prestamo::agregarDetalle($idPrestamo, $idHerramienta, $cantidad);

            // Descontar cantidad
            Herramienta::descontarCantidad($idHerramienta, $cantidad);
        }

        header("Location: ?controller=prestamos");
    }


    public function devolver_parcial() {
        $idDetalle = $_GET['id_detalle'] ?? null;
        if ($idDetalle) {
            Prestamo::devolverHerramientaDetalle($idDetalle);
        }
        header("Location: ?controller=prestamos");
        exit;
    }

}
