<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../modelos/DBConnection.php'; // Ajusta la ruta según tu estructura
require_once __DIR__ . '/../modelos/settings.config.php'; // Ajusta la ruta según tu estructura

global $configdb;


if (!isset($_POST['id'])) {
    echo json_encode(["success" => false, "message" => "ID no recibido."]);
    exit;
}

$id = $_POST['id'];
$database = new DBConnection($configdb);
$stmt = $database->getQuery("SELECT nombreArchivo FROM documentosExtra WHERE iddocumentosExtra =".$id);
if($stmt->rowCount() === 0 ){
    echo json_encode(["success" => false, "message" => "Archivo no encontrado."]);
    exit;
}

foreach($stmt as $row)
{
    $nameFile = $row["nombreArchivo"];
}

$rutaDestino = __DIR__ . '/../solicitudes/'.$_POST["niu"].'/'.$nameFile;

if (unlink($rutaDestino)) {
    $stmt = $database->runQuery("DELETE FROM documentosExtra WHERE iddocumentosExtra = ".$id);
    if ($stmt > 0){
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => false]);
    }

} else {
    echo json_encode(["success" => false, "message" => "No se pudo eliminar el archivo."]);
}
