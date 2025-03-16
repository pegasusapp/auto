<?php
require_once "controladores/plantilla.controlador.php";
require_once "controladores/inicio.controlador.php";
require_once "controladores/solicitud.controlador.php";


require_once "modelos/inicio.modelo.php";
require_once "modelos/solicitud.modelo.php";
require_once "modelos/DBConnection.php";
require_once "modelos/settings.config.php";





$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

?>
