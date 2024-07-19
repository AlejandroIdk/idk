<div class="container is-fluid mb-6">
    <h1 class="title">Clases</h1>
    <h2 class="subtitle">Lista de Clases</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    require_once "./php/main.php";

    if (isset($_GET['clase_id_del'])) {
        require_once "./php/clase_eliminar.php";
    }

    if (!isset($_GET['page'])) {
        $pagina = 1;
    } else {
        $pagina = (int) $_GET['page'];
        if ($pagina <= 1) {
            $pagina = 1;
        }
    }

    $pagina = limpiar_cadena($pagina);
    $url = "index.php?vista=class_list&page=";
    $registros = 15;
    $busqueda = "";

    require_once "./php/clase_lista.php";
    ?>
</div>