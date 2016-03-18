<?php
//header ("Content-type: text/html; charset=utf-8"); 
include("includes/autentificado.php"); 
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			$(".alarmas").click(function(){
    		$(".panel").slideToggle("slow");
  			});
			});
		
			function modificarfechadev(v)
			{
				window.open("modificar_fecha_dev.php?v="+v,"kkkk","width=1200,height=400,top=100,left=50,scrollbars=1")
			}
		</script>
	</head>

	<title>
		Sistema de Manejo de Inventario de Equipos de Reserva
	</title>
	
	<style type="text/css">
		tr.celda:hover {
			background-color: #D0F5A9;
		}
		
		img.boton:hover {
			opacity:0.8;filter:alpha(opacity=40)
		}
		
		div.alarmas:hover {
			color: #4842FC;
		}
		
		div.title { 
			position: relative;
			z-index: 0;
		}
		
		div.title:hover { 
			background-color: transparent;
			z-index: 1;
		}

		div.title span { 
			border: 1px solid #f60;
			padding: 5px;
			position: absolute;
			text-decoration: none;
			background-color: #F5DEB3;
			color: #3E1F00;
			text-align: center;
			visibility: hidden;
			font-size: 14px;
			line-height: 15px;
		}
		
		div.title:hover span {
			visibility: visible;
			top: 24px;
			left: 25px;
		}
	</style>

	<body>

		<?php include("includes/header.php"); ?>
		
		<table align="center">
		<tr><td><div style="text-align:center";><a href="ingresarcel.php"><img class="boton" src="imagenes/phonein.png" border="0"></a></div></td><td><div style="text-align:center";><a href="entregar.php"><img class="boton" src="imagenes/phoneout.png" border="0"></a></div></td><td><div style="text-align:center";><a href="reincorporar.php"><img class="boton" src="imagenes/rein_phone.png" border="0"></a></div></td><td><div style="text-align:center";><a href="modificar_disp.php"><img class="boton" src="imagenes/phonemod.png" border="0"></a></div></td><td><div style="text-align:center";><a href="reporteingreso.php"><img class="boton" src="imagenes/reporte.png" border="0"></a></div></td><td><div style="text-align:center";><a href="reporteentregados.php"><img class="boton" src="imagenes/reporte.png" border="0"></a></div></td><td><div style="text-align:center";><a href="usuarios.php"><img class="boton" src="imagenes/user.png" border="0"></a></div></td></tr>
		<tr><td><div style="text-align:center; font-size:12px";><strong>Ingresar<br />Nuevo Equipo</strong></div></td><td><div style="text-align:center; font-size:12px";><strong>Entregar<br />Equipo</strong></div></td><td><div style="text-align:center; font-size:12px";><strong>Reincorporar<br />Equipo</strong></div></td><td><div style="text-align:center; font-size:12px";><strong>Consultar /<br />Modificar Equipo</strong></div></td><td><div style="text-align:center; font-size:12px";><strong>Imprimir Reporte<br />Equipos Disponibles</strong></div></td><td><div style="text-align:center; font-size:12px";><strong>Imprimir Reporte<br />Equipos Entregados</strong></div></td><td><div style="text-align:center; font-size:12px";><strong>Ingresar /<br />Modificar Usuario</strong></div></td></tr>
		</table>	
		
		<div class="panel" style="font-size:15px; padding:5px; text-align:left; background:#e5eecc; border:solid 1px #c3c3c3; display:none; position:absolute; bottom:60px; left:5px;">
		
			<?php 
			
				include("includes/conecta.php"); 
				mysql_query("SET NAMES utf8");
				
				$result = mysql_query("SELECT d.tipo_disp, d.operador, d.marca, d.modelo, d.ubicacion, d.entregado, d.serial, e.condicion, e.desc_entrega, e.prestamoact, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, DATE_FORMAT(e.fechadev, '%d-%m-%Y') AS fechadev, u.cedula, u.nombre, u.apellido, u.uo FROM dispositivos AS d INNER JOIN (entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula) ON d.serial=e.serial WHERE e.condicion='Prestamo' AND d.entregado = 1 AND e.prestamoact = 1 ORDER BY fecha");
				
				if(mysql_num_rows($result) == 0)
				{
			
			?>
			
			<div style='font-size:12px; color:#FF0000; text-align:center; font-family:Arial, Times, serif;'>No se encuentran préstamos próximos a caducar</div><br />
			
			<?php
			
				}
				else
				{
			
			?>
			
					<table border='1' align='center' rules='none'>
					<tr bgcolor='#CECEF6'>
					<th><div style='font-size:12px; color:#000000;'>Serial</div></th>
					<th><div style='font-size:12px; color:#000000;'>Tipo<br />Dispositivo</div></th>
					<th><div style='font-size:12px; color:#000000;'>Operador</div></th>
					<th><div style='font-size:12px; color:#000000;'>Marca</div></th>
					<th><div style='font-size:12px; color:#000000;'>Modelo</div></th>
					<th><div style='font-size:12px; color:#000000;'>Ubicación</div></th>
					<th><div style='font-size:12px; color:#000000;'>Nombre</div></th>
					<th><div style='font-size:12px; color:#000000;'>Apellido</div></th>
					<th><div style='font-size:12px; color:#000000;'>Fecha<br />Entrega</div></th>
					<th><div style='font-size:12px; color:#000000;'>Fecha<br />Devolución</div></th>
					<th><div style='font-size:12px; color:#000000;'>Estado</div></th>					
					</tr>
					
			<?php
								
					while($row = mysql_fetch_array($result)) 
					{					  	
					  	echo "<tr class='celda' align=center>";
  						echo "<td><div class='title'><t>" . $row['serial'] . "</t><span>" . $row['serial'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['tipo_disp'] . "</t><span>" . $row['tipo_disp'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['operador'] . "</t><span>" . $row['operador'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['marca'] . "</t><span>" . $row['marca'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['modelo'] . "</t><span>" . $row['modelo'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['ubicacion'] . "</t><span>" . $row['ubicacion'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['nombre'] . "</t><span>" . $row['nombre'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['apellido'] . "</t><span>" . $row['apellido'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['fecha'] . "</t><span>" . $row['fecha'] . "</span></div></td>";
  						echo "<td><div class='title'><t>" . $row['fechadev'] . "</t><span>" . $row['fechadev'] . "</span></div></td>";
  						if(strtotime($row['fechadev']) < strtotime(date("d-m-Y")))
  						{
  							echo "<td><div class='title'><t><div style='color:#FF0000;'>Vencido</div></t><span>Vencido</span></div></td>";
  						}
  						else
  						{
  							echo "<td<div class='title'><t><div style='color:#088A08;'>Vigente</div></t><span>Vigente</span></div></td>";
  						}
  						echo "<td><img src='imagenes/edit.png' alt='Editar' title='Editar' name='".$row['serial']."' onclick='modificarfechadev(name)'></td>";
  						echo "</tr>";
  					
					}

					echo "</table>";
				}
				mysql_close($con);
				
			?>
			
		</div>
		
		
		<?php if (!isset($_GET['x'])) { ?>
 
		<div class="alarmas" style="font-size:15px; text-align:left; position:absolute; padding:5px; bottom:5px; left:5px; background:#e5eecc; border:solid 1px #c3c3c3;"><div style="text-align:right;"><a href="?x"><img src="imagenes/close.png" border="0" title="cerrar" alt="cerrar"></a></div><img src="imagenes/warning.png"> Préstamos próximos a caducar</div>
		
		<?php } 

		include("includes/bottom.php"); ?>
	</body>
</html>
