<?php

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class AjaxProveedor
	{

		/*=============================================
		CONSULTA NIT PROVEEDOR
		=============================================*/	

		public $nit;
		public function ajaxConsultaProveedor()
		{
			$item = "cc_nit";
			$tabla = "proveedores";
			$valor = $this->nit;
			$respuesta = ControladorProveedores::consultaNit($item,$tabla,$valor);
			echo $respuesta; 
			
		}
	}

/*=============================================
EDITAR PLANTILLA
=============================================*/	
if(isset($_POST["cc_nit"]))
	{
		$plantillaTrabajo = new AjaxProveedor();
		$plantillaTrabajo -> nit = $_POST["cc_nit"];
		$plantillaTrabajo -> ajaxConsultaProveedor();
	}
