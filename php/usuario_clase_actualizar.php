<?php
require_once "main.php";

$id = limpiar_cadena($_POST['userclass_id']);
$identificacion = limpiar_cadena($_POST['usuario_identificacion']);
$clases = limpiar_cadena($_POST['clase_id']);
$generated_code = limpiar_cadena($_POST['generated_code']);

$check_usuario_clase = conexion()->prepare("SELECT * FROM usuario_clase WHERE userclass_id = :id");
$check_usuario_clase->execute([':id' => $id]);

if ($check_usuario_clase->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La Inscripcion no existe en el sistema
        </div>
    ';
    exit();
} else {
    $datos = $check_usuario_clase->fetch();
}

if ($identificacion == "" || $clases == "" || $generated_code == "") {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

$check_clases = conexion()->prepare("SELECT clase_id FROM clases WHERE clase_id = :clases");
$check_clases->execute([':clases' => $clases]);

if ($check_clases->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La Clase seleccionada no existe
        </div>
    ';
    exit();
}

$actualizar_usuario_clase = conexion()->prepare("UPDATE usuario_clase SET clase_id = :clases, usuario_identificacion = :identificacion, generated_code = :generated_code WHERE userclass_id = :id");

$marcadores = [
    ":identificacion" => $identificacion,
    ":clases" => $clases,
    ":generated_code" => $generated_code,
    ":id" => $id
];

if ($actualizar_usuario_clase->execute($marcadores)) {
    echo '
        <div class="notification is-info is-light">
            <strong>¡Inscripcion ACTUALIZADO!</strong><br>
            La Inscripcion se actualizó con éxito
        </div>
    ';
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo actualizar la Inscripcion, por favor intente nuevamente
        </div>
    ';
}
