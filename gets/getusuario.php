<?php
include("../includes/autentificado.php");
			$q=$_GET["q"];
			
			//Se conecta a la BD//
			
			include("../includes/conecta.php");
			mysql_query("SET NAMES utf8");
			
			//Realiza la consulta//

			$result = mysql_query("SELECT * FROM usuarios WHERE cedula = '".$q."' ORDER BY cedula");
			
			//Muestra los datos del usuario en caso de encontrarse la cedula registrada de lo contrario da mensaje de error//
			
			if(mysql_num_rows($result)==0)
	
			{	
			echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Esta Cedula NO se 				Encuentra REGISTRADA</div><br />';	
			$q="";
			echo "<input type='hidden' name='cedulaoculta' value='".$q."' />";
			}	
			else
			{

			echo "<table border='1' align='center' rules='cols'>
			<tr bgcolor='#088A08' align='center'>
			<th><div style='font-size:12px; color:#FFFFFF;'>Cedula</div></th>
			<th><div style='font-size:12px; color:#FFFFFF;'>Nombre</div></th>
			<th><div style='font-size:12px; color:#FFFFFF;'>Apellido</div></th>
			<th><div style='font-size:12px; color:#FFFFFF;'>Unidad</div></th>
			</tr>";

			$row = mysql_fetch_array($result);

  			echo "<tr bgcolor='#FFFFFF' align='center'>";
  			echo "<td><div style='font-size:12px;'>" . $row['cedula'] . "</div></td>";
  			echo "<td><div style='font-size:12px;'>" . $row['nombre'] . "</div></td>";
  			echo "<td><div style='font-size:12px;'>" . $row['apellido'] . "</div></td>";
  			echo "<td><div style='font-size:12px;'>" . $row['uo'] . "</div></td>";

  			echo "</tr>";

			echo "</table>";
			
			echo "<input type='hidden' name='cedulaoculta' value='".$q."' />";

			mysql_close($con);
	 		
	 		echo "<br /><br />";
	 		}
?>