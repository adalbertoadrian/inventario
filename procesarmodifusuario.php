<?php
include("includes/autentificado.php"); 
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		
		<script type="text/javascript">
			
			function volverfocus()
			{
				document.imagenvolver.src="imagenes/volverfocus.png";
			}
			
			function volversinfocus()
			{
				document.imagenvolver.src="imagenes/volver.png";
			}
			
		</script>
	</head>

	<title>
		Sistema de Manejo de Inventario de Equipos de Reserva
	</title>
	
	<body>
	
		<?php
		
			include("includes/header.php");
			
			echo '<div style="text-align:right"><a href="modif_usuarios.php"><img src="imagenes/volver.png" name="imagenvolver" border = 0 onmouseover="volverfocus()" onmouseout="volversinfocus()"></a></div>';
			
			//Se conecta a la BD//	

			include("includes/conecta.php");	
  		
				//////////////////////////////////////////////////
				/// actualiza el registro en la tabla usuarios ///
				//////////////////////////////////////////////////
		
				$sql="UPDATE usuarios SET cedula='$_POST[cedula]', nombre='$_POST[nombre]', apellido='$_POST[apellido]', uo='$_POST[uo]' WHERE cedula = '$_POST[cedula]'";

				if (!mysql_query($sql,$con))
  				{
  					die('Error actualizando registro en la tabla usuarios: ' . mysql_error());
  				}
  				else
  				{
  		
  					echo "<br /><br /><br /><br /><br /><br />";
					echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Registro actualizado con Exito</div>';
					echo '<br /><br /><br />';
					
					////////////////////////////////////////
					/// Se ingresa el log de la operacion///
					////////////////////////////////////////
				
					$usuario=$_SESSION['usuario'];
					$operacion="actualizo usuario con cedula ".$_POST[cedula];
					$fecha= date ("Y")."-".date ("n")."-".date ("j");
					$hora= strftime("%T",time()); 
			
					$sql="INSERT INTO log (usuario, operacion, fecha, hora) VALUES ('$usuario','$operacion','$fecha','$hora')";
				
					if (!mysql_query($sql,$con))
  					{
  						die('Error ingresando registro al LOG: ' . mysql_error());
  					}
				}		

		mysql_close($con);
		
		?>
		
	</body>
</html>