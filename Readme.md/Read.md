Sistema De Prestamo De Herramientas 
Proyecto PHP con arquitectura MVC que gestiona el prestamo de herramientas, el desarrollo esta echo en PHP y MySQL.

* Caracteristicas principales 
- Gestion de usuarios con roles en este caso son dos administrador y usuarios.
- Autenticaion de usuarios.
- Registro, edicion y eliminacion de herramientas.
- Solicitud de prestamo de herramientas, devolucion y seguimiento de prestamos de las mismas.
- Historial de prestamos.
- Buscador y filtrado de herraminetas por nombre de usuario o nombre de herramieta, esto solo para el rol administrador.
- Buscador de usuarios por nombre. Solo para administradores.
- Validaciones basicas con una interfaz intuitiva.

* Requisitos 
- MySQL (MariaDB)
- XAMPP o similar
- Navegador moderno

* Instalacion

1. Clona o copia el proyecto** en la carpeta `htdocs` de XAMPP:
   git clone https://github.com/Nicolas07-P/PrestamoHerramientas.git 
2. Inicia Apache y MySQL desde XAMPP.

3. Crea la base de datos:
    - Abre "phpAdmin"
    - Ejecuta el archivo "prestamo_herramientas.sql" incluido en los archivos del proyecto, esto con el fin de crear la base y sus tablas.

4. Configuracion

    1. Abre el archivo  y verifica que estos datos coincidan con tu configuracion local:
    private static $host = 'localhost';
    private static $db = 'prestamo_herramientas1';
    private static $user = 'root';
    private static $pass = '';

5. Ejecucion
    1. Abre el navegador y pon :http://localhost/Sistema_prestamo_de_herramientas/public/
    2. Inicia sesion con los usuarios de prueba.


* Funcionalidades por rol
    - Administrador: Gestiona usuarios, herramientas, ve y filtra todos los prestamos.
    - Usuario:Puede solicitar, ver y devolver sus propios prestamos.

* Diagrama de base de datos
    Este se encuentra en la carpeta Readme.md y es un archivo png llamado "Diagrama base de datos prestamo_herramientas1".