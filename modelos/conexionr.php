<?php

   $dbserver = "localhost";
   $dbuser = "admin_pegaso";
   $password = "ruit#od#2001601";
   $dbname = "autogeneracion";

   $database = new mysqli($dbserver, $dbuser, $password, $dbname);
   if($database->connect_errno)
   {
     die("No se pudo conectar a la base de datos");
   }

   $dbserver_data = "181.48.93.219:3308";
   $dbuser_data = "res030";
   $password_data = "Rtqc$#1502";
   $dbname_data = "res030";

   $database_data = new mysqli($dbserver_data, $dbuser_data, $password_data, $dbname_data);
   if($database_data->connect_errno)
   {
     die("No se pudo conectar a la base de datos de la data");
   }
 



/*class Conexion{

	static public function conectar()
		{

		 try {
				$link = new PDO("mysql:host=localhost;dbname=abastecimiento","admin_pegaso","ruit#od#2001601");
				$link->exec("set names utf8");
				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $link;
			}
			catch(PDOException $e)
			    {
			    echo "Connection failed: " . $e->getMessage();
			    }
		 }
	}*/

	
?>