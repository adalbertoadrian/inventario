<?php 
include("includes/autentificado.php");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
	</head>
	
	<body>
		
		<?php
		$valor=$_GET["v"];

		//Se conecta a la BD//

		include("includes/conecta.php");
		mysql_query("SET NAMES utf8");
	
		$result = mysql_query("SELECT e.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, u.cedula, u.nombre, u.apellido, u.uo FROM entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula WHERE e.serial='".$valor."' ORDER BY e.fecha");
		
		$r=3;
		
		echo "<div style='text-align:right';><a href='exportar.php?r=".$r."&v=".$valor."'><img src='imagenes/export.png' title='Exportar' alt='Exportar' border = 0></a>";
		
		echo "<TABLE name='tablaentrega' border='2' rules='none' cellspacing='2' align='center'>
		<caption><strong><t>Historial de Entregas</t></strong></caption>";
		
		if(mysql_num_rows($result)==0)
		
		{
		
			echo '<tr><td><div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Este Equipo no Tiene Historia de Entregas</div></td></tr>';	
		
			echo "</table>";	
		
		}
		else
		{
	
			echo "<tr bgcolor='#CECEF6' align='center'>
			<th><t>Fecha Entrega</t></th>
			<th><t>Cedula</t></th>
			<th><t>Nombre</t></th>
			<th><t>Apellido</t></th>
			<th><t>UO</t></th>
			<th><t>Condici&oacute;n</t></th>
			<th><t>Descripci&oacute;n</t></th>
			</tr>";
		
			$color=1;
			
			while($row = mysql_fetch_array($result))
  			{
  				if ($color==1) {
					$colorfondo="#FFFFFF";
					$color = 2;
				}
				else
				{
					$colorfondo="#D8D8D8";
					$color = 1;
				}

  				echo "<tr bgcolor='".$colorfondo."' align='center'>";
  				echo "<td><t>" . $row['fecha'] . "</t></td>";
  				echo "<td><t>" . $row['cedula'] . "</t></td>";
  				echo "<td><t>" . utf8_decode($row['nombre']) . "</t></td>";
  				echo "<td><t>" . utf8_decode($row['apellido']) . "</t></td>";
  				echo "<td><t>" . $row['uo'] . "</t></td>";
  				echo "<td><t>" . utf8_decode($row['condicion']) . "</t></td>";
  				echo "<td><t>" . utf8_decode($row['desc_entrega']) . "</t></td>";
  				echo "</tr>";
  			}
  		
  			echo "</table>";
		
		}
		
		echo "<br /><br />";
		
		$result = mysql_query("SELECT DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, desc_reincor FROM reincorporado WHERE serial='".$valor."' ORDER BY fecha");
		
		echo "<TABLE name='tablaentrega' border='2' rules='none' cellspacing='2' align='center'>
		<caption><strong><t>Historial de Reincorporaciones</t></strong></caption>";
		
		if(mysql_num_rows($result)==0)
		
		{
		
			echo '<tr><td><div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Este Equipo no Tiene Historia de Reincorporaciones</div></td></tr>';
		
			echo "</table>";
		
		}
		else
		{

			echo "<tr bgcolor='#CECEF6' align='center'>
			<th><t>Fecha Entrega</t></th>
			<th><t>Descripci&oacute;n</t></th>
			</tr>";
		
			$color=1;
			
			while($row = mysql_fetch_array($result))
  			{
  				if ($color==1) {
					$colorfondo="#FFFFFF";
					$color = 2;
				}
				else
				{
					$colorfondo="#D8D8D8";
					$color = 1;
				}

  				echo "<tr bgcolor='".$colorfondo."' align='center'>";
  				echo "<td><t>" . $row['fecha'] . "</t></td>";
  				echo "<td><t>" . utf8_decode($row['desc_reincor']) . "</t></td>";

  				echo "</tr>";
  			}
  		
  			echo "</table>";
		
		}
		
		mysql_close($con);
		
		?>
	</body>
</html>