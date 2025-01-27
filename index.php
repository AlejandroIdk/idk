<?php
require "./inc/session_start.php";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include "./inc/head.php"; ?>
</head>

<body>
    <?php
    // Establecer la vista por defecto
    $vista = isset($_GET['vista']) && !empty($_GET['vista']) ? $_GET['vista'] : 'login';

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
        // Si el usuario no está autenticado mostrar la página de inicio de sesión
        include "./inc/header.php";
        include "./vistas/login.php";
    } else {
        // Usuario fue autenticado determinar su rol
        if ($_SESSION['rol_code'] == 1) {
            // Administrador
            if (is_file("./vistas/$vista.php") && $vista != 'login' && $vista != '404') {
                include "./inc/navbar.php"; // Incluir barra de navegación para administrador
                include "./vistas/$vista.php"; // Incluir la vista administrador correspondiente
                include "./inc/script.php"; // Incluir scripts
            } else {
                include "./vistas/404.php"; // Mostrar página de error 404 si la vista no existe
            }
        } elseif ($_SESSION['rol_code'] == 3) {
            // Usuario Aprendiz
            if (is_file("./vistasStudent/$vista.php") && $vista != 'login' && $vista != '404') {
                include "./inc/navbarStudent.php";
                include "./vistasStudent/$vista.php";
            } else {
                include "./vistas/404.php";
            }
        } else {
            // Rol no valido cerrar sesión mostrar un mensaje de error
            include "./vistas/logout.php";
            exit();
        }
    }
    ?>
    <footer>
        <script src="./js/mayusculas.js"></script>
        <?php include "./inc/footer.php"; ?>
    </footer>
</body>

</html>