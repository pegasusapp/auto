<?php

require_once('settings.config.php');          // Define db configuration arrays here
require_once('DBConnection.php');

class ModeloUsuario{

  /*=============================================
	CONSULTAR USUARIO
	=============================================*/

  
    /*public function ajaxConsultaProveedor()
    {
      $item = "cc_nit";
      $tabla = "proveedores";
      $valor = $this->nit;
      $respuesta = ControladorProveedores::consultaNit($item,$tabla,$valor);
      echo $respuesta; 
      
    }*/
   
	public function mdlConsultaUsuario($valor)
  {
		   
     
        $jsondata = array();
        protected $_configura;
        $database = new DBConnection($_configura);

        if ( $result = $this->_config->getQuery( "SELECT tran.* from Usuario usu left join transformador tran on usu.transformador_codigo_transformador=tran.codigo_transformador where usu.niu='" . $valor."'" ) ) 
            {
      
                if($result->rowCount() > 0 )
                 {

                  $jsondata["success"] = true;
                  $jsondata["data"]["transformador"] = array();
                   foreach($result as $row)
                                    {
                                       $jsondata["data"]["transformador"][] = $row;
                                    } 
                  }
                else
                 {
                    $jsondata["success"] = false;
                    $jsondata["data"] = array('message' => 'No se encontro ningun resultado.');

                 }

 
             } 
      else 
      {
        $jsondata["success"] = false;
        $jsondata["data"] = array('message' => $database->error);
      }

  echo json_encode($jsondata, JSON_FORCE_OBJECT);

	}
  public function mdlInsertProveedores($table, $datos)
    {
  
      $stmt = Conexion::conectar();
      $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO ".$tabla." (razon_social, cc_nit, direccion, web_page, representante_legal, cc_representante_legal, anos_experiencia, representante_comercial, tlf_proveedor, fax_proveedor, email_proveedor, responsable_directo, tlf_responsable_directo, email_responsable_directo, garantia, tiempo_garantia_meses, forma_pago, stma_gestion_calidad, declara_renta, gran_respon_iva, gran_contribuyente, autoretenedor, regimen_comun, regimen_simplificado, descripcion_gral, idempresa)
              VALUES ('".$datos['razon_social']."','".$datos['cc_nit']."','".$datos['direccion']."','".$datos['web_page']."','".$datos['representante_legal']."','".$datos['cc_representante_legal']."',".$datos['anos_experiencia'].",'".$datos['representante_comercial']."','".$datos['tlf_proveedor']."','".$datos['fax_proveedor']."','".$datos['email_proveedor']."','".$datos['responsable_directo']."','".$datos['tlf_responsable_directo']."','".$datos['email_responsable_directo']."','".$datos['garantia']."','".$datos['tiempo_garantia_meses']."','".$datos['forma_pago']."','".$datos['stma_gestion_calidad']."',".$datos['declara_renta'].",".$datos['gran_respon_iva'].",".$datos['gran_contribuyente'].",".$datos['autoretenedor'].",".$datos['regimen_comun'].",".$datos['regimen_simplificado'].",'".$datos['descripcion_gral']."',".$datos['idempresa'].")";
      // use exec() because no results are returned
        $resultado=$stmt->exec($sql);
        $last_id = $stmt->lastInsertId();


     }  

}

if(isset($_GET["codigo_usuario"]))
  {
  
    $plantillaTrabajo = ModeloUsuario::mdlConsultaUsuario($_GET["codigo_usuario"]);
  }
