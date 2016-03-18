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
			
			echo '<div style="text-align:right"><a href="ingresarcel.php"><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()"></a></div>';

			include("includes/conecta.php");	
  		
  			////////////////////////////////////////////////
			/// Verificar que el equipo no este repetido ///
			////////////////////////////////////////////////	
			
			$consulta=mysql_query("SELECT serial, entregado FROM dispositivos WHERE serial='".$_POST[serial]."' OR (inv='".$_POST[inv]."' AND inv<>'')");
			$row = mysql_fetch_array($consulta);
  			
  			if(mysql_num_rows($consulta)==0)
			
			{
				////////////////////////////////////////////////////////////////////
				/// Ingresar el Equipo Nuevo en caso de que no exista el registro///
				////////////////////////////////////////////////////////////////////
		
				//$sql="INSERT INTO dispositivos (numero, tipo_disp, operador, marca, modelo, plan, serial, clave, inv, imei, sim, tecnologia, ubicacion, tipreserva) VALUES ('$_POST[numero]','$_POST[tipo_disp]','$_POST[operador]','$_POST[marca]','$_POST[modelo]','$_POST[plan]','$_POST[serial]','$_POST[clave]','$_POST[inv]','$_POST[imei]','$_POST[sim]','$_POST[tecnologia]', '$_POST[ubicacion]', '$_POST[tipreserva]')";
				
				foreach ($_POST as $lbl => $valor) {
					if (preg_match('/^ope/i',$lbl))
						echo "Paso por operador";
				}
				
		/*
				if (!mysql_query($sql,$con))
  				{
  					die('Error ingresando registro en la tabla dispositivos: ' . mysql_error());
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
					$operacion="ingreso equipo con serial ".$_POST[serial];
					$fecha= date ("Y")."-".date ("n")."-".date ("j");
					$hora= strftime("%T",time()); 
			
					$sql="INSERT INTO log (usuario, operacion, fecha, hora) VALUES ('$usuario','$operacion','$fecha','$hora')";
				
					if (!mysql_query($sql,$con))
  					{
  						die('Error ingresando registro al LOG: ' . mysql_error());
  					}
  				}
			*/
			}
			elseif ($row['entregado'] == 1)
			{
				echo "<br /><br /><br /><br /><br /><br />";
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;"><img src="imagenes/stop.png"><br /><br />Error <br />Este Equipo se Encuentra ENTREGADO</div>';
				echo '<br /><br /><br />';		
			}
			else
			{
				echo "<br /><br /><br /><br /><br /><br />";
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;"><img src="imagenes/stop.png"><br /><br />Error <br />Este equipo se Encuentra REGISTRADO<br /> Verifique que el Serial o el Inmovilizado ingresado no se encuentra asignado a otro equipo</div>';
				echo '<br /><br /><br />';	
	
			}

		mysql_close($con);
		
		?>
		
	</body>
</html>
