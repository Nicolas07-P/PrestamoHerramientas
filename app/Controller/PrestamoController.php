<?php
require_once __DIR__.'/../Helpers/Auth.php';
require_once __DIR__.'/../Model/Prestamo.php';
require_once __DIR__.'/../Model/Herramienta.php';
/**
 * Controlador para la gestión de préstamos de herramientas.
 * Permite crear, obtener, listar y devolver préstamos.
 */
class PrestamoController {
    /**
     * Constructor que requiere autenticación para acceder a las funciones del controlador.
     * Asegura que el usuario esté autenticado antes de realizar cualquier acción.
     */

    public function __construct() {
        Auth::requireLogin();
    }
    /**
     * Lista los prestamos, con opcion de busqueda y filtrado por estado.
     */
    public function index() {
        $q = $_GET['q'] ?? '';
        $estado = $_GET['estado'] ?? 'activo';
        $prestamos = Prestamo::buscar($q, $estado);
        include '../app/View/prestamos/index.php';
    }
    /**
     * Muestra el historial de préstamos completados.
     * Permite ver los préstamos que ya han sido devueltos.
     */


    public function historial() {
        $prestamos = Prestamo::prestamosCompletados();
        include '../app/View/prestamos/historial.php';
    }
    /**
     * Muestra el formulario para crear un nuevo prestamo.
     * Incluye las herramientas disponibles para seleccionar.
     */
    public function create() {
        $herramientas = Herramienta::all(); 
        include '../app/View/prestamos/create.php';
    }
    /**
     * Almacena un nuevo préstamo en la base de datos y descuenta las herramientas.
     * Requiere que el usuario esté autenticado y maneja la lógica de creación del préstamo.
     * @param array $data Datos del préstamo, incluyendo herramientas y cantidades.
     */
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

    /**
     *  Permite devolver parcialmente una herramienta prestada.
     */
    public function devolver_parcial() {
        $idDetalle = $_GET['id_detalle'] ?? null;
        if ($idDetalle) {
            Prestamo::devolverHerramientaDetalle($idDetalle);
        }
        header("Location: ?controller=prestamos");
        exit;
    }

}
