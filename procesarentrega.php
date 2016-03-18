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
			
			echo '<div style="text-align:right"><a href="entregar.php"><img src="imagenes/volver.png" name="imagenvolver" border = 0 onmouseover="volverfocus()" onmouseout="volversinfocus()"></a></div>';
			
			include("includes/conecta.php");
			
			$dia=$_POST[dia];
			$mes=$_POST[mes];
			$ano=$_POST[ano];
			if ($_POST[condicion]=="Prestamo")
			{
				$dia_d=$_POST[dia_d];
				$mes_d=$_POST[mes_d];
				$ano_d=$_POST[ano_d];
			}
			else
			{
				$dia_d="00";
				$mes_d="00";
				$ano_d="0000";
			}
			
			//Ingresa los valores dentro de la tabla//
			
			if($_POST[condicion]=='Prestamo')
			
			{
			
				$sql="INSERT INTO entregados (serial, condicion, desc_entrega, cedula, fecha, fechadev, prestamoact) VALUES ('$_POST[serialoculto]','$_POST[condicion]','$_POST[desc_entrega]','$_POST[cedulaoculta]','".$ano."-".$mes."-".$dia."','".$ano_d."-".$mes_d."-".$dia_d."','1')";			
			
			}
			else
			{

				$sql="INSERT INTO entregados (serial, condicion, desc_entrega, cedula, fecha, fechadev, prestamoact) VALUES ('$_POST[serialoculto]','$_POST[condicion]','$_POST[desc_entrega]','$_POST[cedulaoculta]','".$ano."-".$mes."-".$dia."','".$ano_d."-".$mes_d."-".$dia_d."','0')";
			
			}
			
			$sql2="UPDATE dispositivos SET entregado = '1' WHERE serial = '$_POST[serialoculto]'";

			if (!mysql_query($sql,$con))
  			{
  				die('Error Insertando registro en la tabla entregados: ' . mysql_error());
  			}
  			elseif (!mysql_query($sql2,$con))
  			{
  				die('Error actualizando registro en la tabla dispositivos: ' . mysql_error());
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
				$operacion="entrego equipo con serial ".$_POST[serialoculto];
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