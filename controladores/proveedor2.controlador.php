<?php



class ModeloProveedores2{

  /*=============================================
	CONSULTAR PROVEEDOR
	=============================================*/



	static public function mdlConsultaProveedores2($tabla, $item, $valor)
  {
			$stmt = DBConnection::getQuery()->prepare("SELECT count(*) as cantidad FROM $tabla WHERE $item = '".$valor."' LIMIT 1");
			
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();
	    $stmt -> close();
		  $stmt = null;

	}
  public function mdlInsertProveedores2($table, $datos)
    {
  
      $stmt = Conexion::conectar();
      $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO ".$tabla." (razon_social, cc_nit, direccion, web_page, representante_legal, cc_representante_legal, anos_experiencia, representante_comercial, tlf_proveedor, fax_proveedor, email_proveedor, responsable_directo, tlf_responsable_directo, email_responsable_directo, garantia, tiempo_garantia_meses, forma_pago, stma_gestion_calidad, declara_renta, gran_respon_iva, gran_contribuyente, autoretenedor, regimen_comun, regimen_simplificado, descripcion_gral, idempresa)
              VALUES ('".$datos['razon_social']."','".$datos['cc_nit']."','".$datos['direccion']."','".$datos['web_page']."','".$datos['representante_legal']."','".$datos['cc_representante_legal']."',".$datos['anos_experiencia'].",'".$datos['representante_comercial']."','".$datos['tlf_proveedor']."','".$datos['fax_proveedor']."','".$datos['email_proveedor']."','".$datos['responsable_directo']."','".$datos['tlf_responsable_directo']."','".$datos['email_responsable_directo']."','".$datos['garantia']."','".$datos['tiempo_garantia_meses']."','".$datos['forma_pago']."','".$datos['stma_gestion_calidad']."',".$datos['declara_renta'].",".$datos['gran_respon_iva'].",".$datos['gran_contribuyente'].",".$datos['autoretenedor'].",".$datos['regimen_comun'].",".$datos['regimen_simplificado'].",'".$datos['descripcion_gral']."',".$datos['idempresa'].")";
      // use exec() because no results are returned
        $resultado=$stmt->exec($sql);
        $last_id = $stmt->lastInsertId();
        /*
        if($resultado=="1")   
        {

                $gh="Nuevo";
                $stmt = Conexion::conectar()->prepare("SELECT idestado_proveedores FROM estadosp WHERE estado = ? LIMIT 1");
                $stmt->bind_param('s',$gh);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($estadopr);
                $stmt->fetch();

         }
         else
         {
              $sql5 = 'INSERT INTO errores(nro_error,cadena_error,fecha) VALUES("Caso 2","'.$stmt->errorInfo();.'",DATE_FORMAT(NOW(),"%Y-%m-%d %T"))';
                if ($stmt->exec($sql5) === TRUE)
                {
                  $sql4="Delete from proveedores WHERE idproveedores=".$last_id;
                  if($stmt->exec($sql4) === TRUE)
                  {
                    die("Caso 2");
                  } 
                }               
         }*/

     }  

}

?>
