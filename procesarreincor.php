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

			//Conecta a la BD//
			
			echo '<div style="text-align:right"><a href="reincorporar.php"><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()"></a></div>';
			
			include("includes/conecta.php");
			
			$dia=$_POST[dia];
			$mes=$_POST[mes];
			$ano=$_POST[ano];
			
			//Ingresa los valores dentro de la tabla//

			$sql="INSERT INTO reincorporado (serial, desc_reincor, fecha) VALUES ('$_POST[serialoculto]','$_POST[desc_reincor]','".$ano."-".$mes."-".$dia."')";
			
			$sql2="UPDATE dispositivos SET entregado = '0' WHERE serial = '$_POST[serialoculto]'";
			
			$sql3="UPDATE entregados SET prestamoact = '0' WHERE serial = '$_POST[serialoculto]' AND condicion = 'Prestamo'";

			if (!mysql_query($sql,$con))
  			{
  				die('Error Insertando registro en la tabla reincorporado: ' . mysql_error());
  			}
  			elseif (!mysql_query($sql2,$con))
  			{
  				die('Error actualizando registro en la tabla dispositivos: ' . mysql_error());
  			}
  			elseif (!mysql_query($sql3,$con))
  			{
  				die('Error actualizando registro en la tabla entregados: ' . mysql_error());
  			}
  			else
  			{
  				echo "<br /><br /><br /><br /><br /><br />";
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Registro agregado con Exito</div>';
				echo '<br /><br /><br />';
  			
				////////////////////////////////////////
				/// Se ingresa el log de la operacion///
				////////////////////////////////////////
				
				$usuario=$_SESSION['usuario'];
				$operacion="reincorporo equipo con serial ".$_POST[serialoculto];
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