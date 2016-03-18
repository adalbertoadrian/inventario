<?php

			//Funcion para realizar la conexión a la BD el servidor debe tener instalado el paquete php5-mysql//		
					
			$con = mysql_connect("localhost","root","12345");
			if (!$con)
  			{
  			die('Could not connect: ' . mysql_error());
  			}

			mysql_select_db("inventario", $con);	
?>
