<?php
include("../includes/autentificado.php");

			$valor=$_GET["i"];
			$campo=$_GET["u"];
			
			//Se conecta a la BD//
			
			include("../includes/conecta.php");
			mysql_query("SET NAMES utf8");
			
			//Realiza la Consulta//

			$result = mysql_query("SELECT d.numero, d.tipo_disp, d.operador, d.tecnologia, d.marca, d.modelo, d.ubicacion, d.clave, d.inv, d.entregado, d.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, u.cedula, u.nombre, u.apellido, u.uo FROM dispositivos AS d INNER JOIN (entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula) ON d.serial=e.serial WHERE d.".$campo." = '".$valor."' AND d.entregado = 1 ORDER BY fecha");
			
			//En caso de existir el serial ingresado imprime la tabla de lo contrario muestra mensaje de error//
			
			if(mysql_num_rows($result) == 0)
	
			{	
				echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Este Equipo NO se Encuentra ENTREGADO</div><br />';
				$q="";
				echo "<input type='hidden' name='serialoculto' value='".$q."' />";
			}	
			else
			{
			
				

				echo "<table border='1' align='center' rules='all'>
				<caption><div style='font-size:15px; text-align:left; color:#000000;'><strong>Bitacora de Entregas</strong></div></caption>
				<tr bgcolor='#D8D8D8'>
				<th colspan='8'><t><div style='color:blue;'>Datos del Equipo</div></t></th>
				<th colspan='7'><t><div style='color:blue;'>Datos de la entrega</div></t></th>				
				</tr>
				<tr bgcolor='#088A08' align=center>
				<td><div style='font-size:12px; color:#FFFFFF;'>Serial</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Numero</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Tipo de Dispositivo</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Operador</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Marca</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Modelo</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Inventario</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Ubicación</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Fecha Entrega</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Cedula</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Nombre</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Apellido</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>UO</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Condici&oacute;n</div></td>
				<td><div style='font-size:12px; color:#FFFFFF;'>Descripci&oacute;n</div></td>
				</tr>";
					
				while($row = mysql_fetch_array($result)) {

  					echo "<tr bgcolor='#FFFFFF' align='center'>";
  					echo "<td><t>" . $row['serial'] . "</t></td>";
  					echo "<td><t>" . $row['numero'] . "</t></td>";
  					echo "<td><t>" . $row['tipo_disp'] . "</t></td>";
  					echo "<td><t>" . $row['operador'] . "</t></td>";
  					echo "<td><t>" . $row['marca'] . "</t></td>";
  					echo "<td><t>" . $row['modelo'] . "</t></td>";
  					echo "<td><t>" . $row['inv'] . "</t></td>";
  					echo "<td><t>" . $row['ubicacion'] . "</t></td>";
  					echo "<td><t>" . $row['fecha'] . "</t></td>";
  					echo "<td><t>" . $row['cedula'] . "</t></td>";
  					echo "<td><t>" . $row['nombre'] . "</t></td>";
  					echo "<td><t>" . $row['apellido'] . "</t></td>";
  					echo "<td><t>" . $row['uo'] . "</t></td>";
  					echo "<td><t>" . $row['condicion'] . "</t></td>";
  					echo "<td><t>" . $row['desc_entrega'] . "</t></td>";
  					echo "</tr>";
  					$serial = $row['serial'];
				}
				
				mysql_close($con);
				
				echo "</table>";
				
				echo "<br /><br />";
				
				echo "<FORM METHOD='post' name='freinco' ACTION='procesarreincor.php'>";
				
				echo "<e>Fecha de Reincorporación:</e> <o>* </o> <select size='1' name='dia'>";

				//////////////////////////////////
				//// Fecha de Reincorporación ////
				//////////////////////////////////
			
				///////////			
				/// Dia ///
				///////////

				$day_now = date ("j"); 		
			
				for ($i=1; $i<=31; $i++) {

					if ($i==$day_now){
						echo "<option selected value='".$day_now."'>".$day_now."</option>";
					}
					else
					{	
						echo "<option value='".$i."'>".$i."</option>";
					} 
				} 			
				
				echo "</select>";
			
				///////////
				/// Mes ///			
				///////////
			
				echo "<select size='1' name='mes'>";


				$mes_now = date ("n"); 		
			
				for ($i=1; $i<=12; $i++) {

					if ($i==$mes_now){
						echo "<option selected value='".$mes_now."'>".$mes_now."</option>";
					}
					else
					{	
						echo "<option value='".$i."'>".$i."</option>";
					} 
				} 				
				
				echo "</select>";
			
				///////////
				/// Año ///			
				///////////
			
				echo "<select size='1' name='ano'>";

				$ano_now = date ("Y"); 		
			
				for ($i=($ano_now - 1); $i<=$ano_now; $i++) {

					if ($i==$ano_now){
						echo "<option selected value='".$ano_now."'>".$ano_now."</option>";
					}
					else
					{	
						echo "<option value='".$i."'>".$i."</option>";
					} 
				} 		
					
				
				echo "</select>";
				
				echo "<br /><br />";
				
				echo "<div style='font-size:15px; text-align:left; color:#000000;'><strong>Descripci&oacute;n de la Reincorporación</strong></div><textarea name='desc_reincor' cols='50' rows='5'></textarea>";
			
				echo "<input type='hidden' name='serialoculto' value='".$serial."' />";
				
				echo "</form>";
	 		
	 			echo "<br />";
	 			
	 			echo "<input type='button' name='boton' value='Guardar' onclick='validar_formulario()'>";
			}
?>