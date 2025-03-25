<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../modelos/DBConnection.php'; // Ajusta la ruta según tu estructura
require_once __DIR__ . '/../modelos/settings.config.php'; // Ajusta la ruta según tu estructura

global $configdb;

if (!isset($_FILES['archivo'])) {
    echo json_encode(["success" => false, "message" => "No se ha recibido ningún archivo."]);
    exit;
}

$archivo = $_FILES['archivo'];
$extensionesPermitidas = ['zip', 'rar', '7z'];
$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);

if (!in_array(strtolower($extension), $extensionesPermitidas)) {
    echo json_encode(["success" => false, "message" => "Formato no permitido. Solo ZIP, RAR o 7Z."]);
    exit;
}
if (!is_dir(__DIR__ . '/../solicitudes/'.$_POST["niu"].'/')) {
    die("El directorio no existe.");
}
if (!is_writable(__DIR__ . '/../solicitudes/'.$_POST["niu"].'/')) {
    die("El directorio no tiene permisos de escritura.");
}
$nombreArchivo = basename($_FILES['archivo']['name']);
$rutaDestino = __DIR__ . '/../solicitudes/'.$_POST["niu"].'/'.$nombreArchivo;


if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
    $respuesta_insercion_proyeccion_e = 0 ;
    $database = new DBConnection($configdb);
    $sqlFile = "INSERT INTO documentosExtra(nombreDocumento, nombreArchivo,solicitudes_idsolicitudes) VALUES('Documentos de entrada en operación','".$archivo['name']."',".$_POST['solicitudNro'].")";
    $respuesta_insercion_proyeccion_e = $database->getLastIDQuery($sqlFile);

    if ($respuesta_insercion_proyeccion_e > 0) {
        echo json_encode(["success" => true, "id" => $respuesta_insercion_proyeccion_e]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar en la base de datos."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Error al subir el archivo.-->".$_FILES["archivo"]["error"]]);
}

