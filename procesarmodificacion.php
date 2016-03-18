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
			
			//Se conecta a la BD//
			
			echo '<div style="text-align:right"><a href="modificar_disp.php"><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()"></a></div>';

			include("includes/conecta.php");
			
			//Modifica los valores en la tabla//	
		
			$sql="UPDATE dispositivos SET numero='$_POST[numero]', tipo_disp='$_POST[tipo_disp]', operador='$_POST[operador]', marca='$_POST[marca]', modelo='$_POST[modelo]', plan='$_POST[plan]', clave='$_POST[clave]', inv='$_POST[inv]', imei='$_POST[imei]', sim='$_POST[sim]', tecnologia='$_POST[tecnologia]', tipreserva='$_POST[tipreserva]', ubicacion='$_POST[ubicacion]' WHERE serial = '$_POST[serial]'";

			if (!mysql_query($sql,$con))
			{
  				die('Error actualizando registro en la tabla dispositivos: ' . mysql_error());
  			}
  			else
  			{
  				echo "<br /><br /><br /><br /><br /><br />";
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Registro modificado con Exito</div>';
				echo '<br /><br /><br />';
				
				////////////////////////////////////////
				/// Se ingresa el log de la operacion///
				////////////////////////////////////////
				
				$usuario=$_SESSION['usuario'];
				$operacion="modifico equipo con serial ".$_POST[serial];
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