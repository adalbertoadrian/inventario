<?php
include("../includes/autentificado.php");
			$q=$_GET["q"];
			
			//Se conecta a la BD//
			
			include("../includes/conecta.php");
			mysql_query("SET NAMES utf8");
			
			//Realiza la Consulta//

			$result = mysql_query("SELECT * FROM dispositivos WHERE serial = '".$q."'");
			$row = mysql_fetch_array($result);
			
			//En caso de existir el serial ingresado imprime la tabla de lo contrario muestra mensaje de error//
			
			if(mysql_num_rows($result) == 0)
	
			{	
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Este Equipo NO se Encuentra REGISTRADO</div><br />';
				$q="";
				echo "<input type='hidden' name='serialoculto' value='".$q."' />";
			}	
			elseif($row['entregado'] == 1)
			{
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Este Equipo se Encuentra ENTREGADO</div><br />';
				$q="";
				echo "<input type='hidden' name='serialoculto' value='".$q."' />";
			}
			else
			{

				echo "<table border='1' align='center' rules='cols'>
				<tr bgcolor='#088A08' align='center'>
				<th><div style='font-size:12px; color:#FFFFFF;'>Serial</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Numero</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Tipo de Dispositivo</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Operador</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Tecnolog&iacute;a</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Marca</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Modelo</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Plan</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Clave</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Inventario</div></th>
				<th><div style='font-size:12px; color:#FFFFFF;'>Ubicaci&oacute;n</div></th>
				</tr>";

  				echo "<tr bgcolor='#FFFFFF' align='center'>";
  				echo "<td><div style='font-size:12px;'>" . $row['serial'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['numero'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['tipo_disp'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['operador'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['tecnologia'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['marca'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['modelo'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['plan'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['clave'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['inv'] . "</div></td>";
  				echo "<td><div style='font-size:12px;'>" . $row['ubicacion'] . "</div></td>";
  				echo "</tr>";

				echo "</table>";
			
				echo "<input type='hidden' name='serialoculto' value='".$q."' />";

				mysql_close($con);
	 		
	 			echo "<br /><br />";
	 		}
?>