<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=rol_new">Crear Rol</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=rol_list">Lista de Roles</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=rol_search">Buscar Rol</a></li>
            </ol>
        </nav>
    </div>
    <?php
    include "./inc/btn_back.php";
    ?>
    <div class="container is-fluid mb-6">
        <h1 class="title">Roles</h1>
        <h2 class="subtitle">Lista de Roles</h2>
    </div>

    <div class="container pb-6 pt-6">
        <?php
        require_once "./php/main.php";

        if (isset($_GET['rol_code_del'])) {
            require_once "./php/rol_eliminar.php";
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
        $url = "index.php?vista=rol_list&page=";
        $registros = 15;
        $busqueda = "";

        require_once "./php/rol_lista.php";
        ?>
    </div>