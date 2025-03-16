<?php

require_once('settings.config.php');          // Define db configuration arrays here
require_once('DBConnection.php');

class ModeloSolicitud{

  /*=============================================
	CONSULTAR SOLICITUD
	=============================================*/


 public function mdlConsultaSolicitud($valor)
  {
     
          global $configdb;
          $database = new DBConnection($configdb); 
          $respuesta_consulta = $database->getQuery("SELECT count(*) as cantidad FROM solicitudes WHERE Usuario_niu = '".$valor."' and estado_solicitud_idestado_solicitud<>1  LIMIT 1");
            foreach($respuesta_consulta as $row)
             {
                 return $row["cantidad"];
             } 

	}
  public function mdlConsultaSolicitudEstado($valor)
  {

          global $configdb;
          $database = new DBConnection($configdb); 
          $respuesta_consulta = $database->getQuery("SELECT estado_solicitud_idestado_solicitud FROM solicitudes WHERE Usuario_niu = '".$valor."'  LIMIT 1");
            foreach($respuesta_consulta as $row)
             {
                 return $row["estado_solicitud_idestado_solicitud"]."*".$row["nro_solicitud"];
             } 
  }


}


