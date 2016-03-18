<?php
function cierra() {
			session_destroy();
			unset($_SESSION['access']);
			unset($_SESSION['usuario']);
			echo "<br /><br /><br /><br /><br /><br />";
			echo '<div style="color:black; text-align:center; font-family:"Arial Black", Times, serif;"><img src="imagenes/stop.png"><br /><br /><strong>Acceso Negado</strong>';
			echo '<br /><br /><br /><br />';
			echo '<a href="index.php">Volver</a></div>';
}

		session_start();
		
		//Conecta a la BD//
		
		include("includes/conecta.php");
		
		//Verifica que el login se encuentra registrado en la BD//
	
		$consulta = mysql_query("SELECT login FROM acceso WHERE login='".$_POST['login']."'");
		
		//En caso de no estar registrado el usuario en la BD envia a la funcion cerrar//
	
		if(mysql_num_rows($consulta)==0)
		{
			mysql_close($con);
			cierra();
		}	
		else
		{
			$conecto = 0;
			
			//Realiza la autentificacion contra la base de datos//
			
			include("includes/ldap.php");
		
			//Activa la variable access en caso de que el login sea efectivo de lo contrario envia a la funcion cierra//		
			
			if($conecto == 1) {			
    			$_SESSION['access']='1';
    			$_SESSION['usuario']=$_POST['login'];
    			
				////////////////////////////////////////
				/// Se ingresa el log de la operacion///
				////////////////////////////////////////
				
				$usuario=$_SESSION['usuario'];
				$operacion="Inicio Sesion";
				$fecha= date ("Y")."-".date ("n")."-".date ("j");
				$hora= strftime("%T",time()); 
			
				$sql="INSERT INTO log (usuario, operacion, fecha, hora) VALUES ('$usuario','$operacion','$fecha','$hora')";
				
				if (!mysql_query($sql,$con))
  				{
  					die('Error ingresando registro al LOG: ' . mysql_error());
  				} 
  				
  				mysql_close($con);  			
    			
				header("Location: principal.php");
			}
			else
			{
				mysql_close($con);
				cierra();
			}
			
  		}
?>
