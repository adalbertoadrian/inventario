<?php
include("includes/autentificado.php"); 

			$x=$_GET["r"];
			
			//Configura el header de la pagina dependiendo el tipo de reporte que se esta imprimiendo//
			
			header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
			if ($x==1)
			{
				header("Content-Disposition: attachment; filename=inventario.ods");
			}
			elseif ($x==2)
			{
				header("Content-Disposition: attachment; filename=entregados.ods");
			}
			elseif ($x==3)
			{
				header("Content-Disposition: attachment; filename=bitacora.ods");
			}
			
			//Se conecta a la BD//

			include("includes/conecta.php");
			mysql_query("SET NAMES utf8");
			
			if ($x==1)
			
			/////////////////////////////////////////////////////////////
			//Si la variable x=1 Imprime Reporte de equipos disponibles//
			/////////////////////////////////////////////////////////////			
			
			{

				//Captura las variables enviadas por la URL//			
			
				$ub=$_GET["u"];
				$te=$_GET["t"];
				$ti=$_GET["tip"];
				$tir=$_GET["tipres"];
				$ma=$_GET["m"];
				$ti_r=$_GET["tir"];
				
				//Cambia los operadores de la consulta en caso de ser necesario//				
				
				$oubic = "<>";
				$otec = "<>";
				$omac = "<>";
				$otip = "<>";
				$otir = "<>";
			
				if($ub!='*') { $oubic = "="; }
				if($te!='*') { $otec = "="; }
				if($ti!='*') { $otip = "="; }
				if($tir!='*') { $otir = "="; }
				if($ma!='*') { $omac = "="; }
				
			/////////////////////////////////////////////////////////////////////////////////////////////
			//Si la variable ti_r='detallado' entonces imprime el reporte equipos disponibles detallado//
			/////////////////////////////////////////////////////////////////////////////////////////////
				
				if($ti_r=='detallado')
				
				{
				
					//Realiza la consulta en la BD//

					$result = mysql_query("SELECT * FROM dispositivos WHERE entregado = '0' AND ubicacion ".$oubic." '".$ub."' AND tecnologia ".$otec." '".$te."' AND marca ".$omac." '".$ma."' AND tipo_disp ".$otip." '".$ti."' AND tipreserva ".$otir." '".$tir."' ORDER BY marca,modelo,serial");
			
					//Imprime la tabla//			
			
					echo "<table border='2' rules='none' cellspacing='2' align='center'>";
			
					echo "<caption><div style='text-align:right; font-size:15px;'>Registros: ".mysql_num_rows($result)."</div></caption>";
						
			
					echo "<tr bgcolor='#CECEF6' align='center'>";
					echo "<th>".utf8_decode('Serial')."</th>";
					echo "<th>".utf8_decode('Numero')."</th>";
					echo "<th>".utf8_decode('Tipo de Dispositivo')."</th>";
					echo "<th>".utf8_decode('Operador')."</th>";
					echo "<th>".utf8_decode('Tecnología')."</th>";
					echo "<th>".utf8_decode('Marca')."</th>";
					echo "<th>".utf8_decode('Modelo')."</th>";
					echo "<th>".utf8_decode('Plan')."</th>";
					echo "<th>".utf8_decode('Clave')."</th>";
					echo "<th>".utf8_decode('Inventario')."</th>";
					echo "<th>".utf8_decode('Imei')."</th>";
					echo "<th>".utf8_decode('Sim')."</th>";
					echo "<th>".utf8_decode('Tipo de Reserva')."</th>";
					echo "<th>".utf8_decode('Ubicación')."</th>";
					echo "</tr>";
					
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
  						echo "<td>'".utf8_decode($row['serial'])."</td>";
  						echo "<td>".utf8_decode($row['numero'])."</td>";
  						echo "<td>".utf8_decode($row['tipo_disp'])."</td>";
  						echo "<td>".utf8_decode($row['operador'])."</td>";
  						echo "<td>".utf8_decode($row['tecnologia'])."</td>";
  						echo "<td>".utf8_decode($row['marca'])."</td>";
  						echo "<td>".utf8_decode($row['modelo'])."</td>";
  						echo "<td>".utf8_decode($row['plan'])."</td>";
  						echo "<td>".utf8_decode($row['clave'])."</td>";
  						echo "<td>'".utf8_decode($row['inv'])."</td>";
  						echo "<td>'".utf8_decode($row['imei'])."</td>";
  						echo "<td>'".utf8_decode($row['sim'])."</td>";
  						echo "<td>'".utf8_decode($row['tipreserva'])."</td>";
  						echo "<td>".utf8_decode($row['ubicacion'])."</td>";
  						echo "</tr>";
  					}
  				}
  				
				///////////////////////////////////////////////////////////////////////////////////////////////
				//Si la variable ti_r <> 'detallado' entonces imprime el reporte equipos disponibles resumido//
				///////////////////////////////////////////////////////////////////////////////////////////////
				
  				else
  				{
  				
  					//Realiza la Consulta en la BD//

					$result = mysql_query("SELECT modelo, marca, tecnologia, ubicacion, COUNT(modelo) FROM dispositivos WHERE entregado = '0' AND ubicacion ".$oubic." '".$ub."' AND marca ".$omac." '".$ma."' AND tecnologia ".$otec." '".$te."' AND tipo_disp ".$otip." '".$ti."' AND tipreserva ".$otir." '".$tir."' GROUP BY modelo,ubicacion,marca,tecnologia ORDER BY marca,modelo");
					
					//Imprime la Tabla//

					echo "<table border='2' rules='none' cellspacing='2' align='center'>";
			
					echo "<caption><div style='text-align:right; font-size:15px;'>Registros: ".mysql_num_rows($result)."</div></caption>";
						
			
					echo "<tr bgcolor='#CECEF6' align='center'>
					<th><t>".utf8_decode('Modelo')."</t></th>
					<th><t>".utf8_decode('Marca')."</t></th>
					<th><t>".utf8_decode('Tecnolog&iacute;a')."</t></th>
					<th><t>".utf8_decode('Ubicaci&oacute;n')."</t></th>
					<th><t>".utf8_decode('N° Equipos')."</t></th>
					</tr>";
			
					$color=1;
					$total=0;
			
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
  						echo "<td><t>" . utf8_decode($row['modelo']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['marca']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['tecnologia']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['ubicacion']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['COUNT(modelo)']) . "</t></td>";
  						$total = $total + $row['COUNT(modelo)'];
  						echo "</tr>";
  					}
  					echo "<tr><td colspan='5' align='right'><t><strong>Total de Equipos: ".$total."</strong></t></td></tr>";
  			
					echo "</table>";
			
					echo "<br /><br />";  				
  				
  				}
			}
			elseif ($x==2)

			/////////////////////////////////////////////////////////////
			//Si la variable x=2 Imprime Reporte de equipos entregados //
			/////////////////////////////////////////////////////////////		
			
			{
			
				//Captura las variables//
			
				$fei=$_GET["i"];
				$fef=$_GET["f"];
				$ub=$_GET["u"];
				$co=$_GET["c"];
				$ti=$_GET["tip"];
				
				//Separa la fecha de inicio del reporte que contiene la variable fei//
			
				$anoi=substr($fei,0,4);
				$mesi=substr($fei,4,2);
				$diai=substr($fei,6,2);
				
				//Separa la fecha final del reporte que contiene la variable fei//
			
				$anof=substr($fef,0,4);
				$mesf=substr($fef,4,2);
				$diaf=substr($fef,6,2);
				
				//Si la varible ub es distinta * que es el valor por defecto cambia el operador de la consulta SQL a = //
			
				$oubic = "<>";
				$ocond = "<>";
				$otip = "<>";
			
				if($ub!='*') { $oubic = "="; }
				if($co!='*') { $ocond = "="; }
				if($ti!='*') { $otip = "="; }	
				
				//Realiza la consulta en la BD con los parametros indicados//	
				
				$result = mysql_query("SELECT d.numero, d.tipo_disp, d.operador, d.tecnologia, d.marca, d.modelo, d.ubicacion, d.clave, d.inv, d.imei, d.sim, d.entregado, e.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, u.cedula, u.nombre, u.apellido, u.uo FROM dispositivos AS d INNER JOIN (entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula) ON d.serial=e.serial WHERE e.fecha BETWEEN '".$anoi."-".$mesi."-".$diai."' AND '".$anof."-".$mesf."-".$diaf."' AND ubicacion ".$oubic." '".$ub."' AND e.condicion ".$ocond." '".$co."' AND d.tipo_disp ".$otip." '".$ti."' ORDER BY e.fecha");	
				
				//Imprime la Tabla//
				
				echo "<table border='0' align='center'>";
				echo "<tr bgcolor='#CECEF6' align='center'>";
				echo "<th>".utf8_decode('Serial')."</th>";
				echo "<th>".utf8_decode('Fecha Entrega')."</th>";
				echo "<th>".utf8_decode('Numero')."</th>";
				echo "<th>".utf8_decode('Tipo de Dispositivo')."</th>";
				echo "<th>".utf8_decode('Operador')."</th>";
				echo "<th>".utf8_decode('Tecnología')."</th>";
				echo "<th>".utf8_decode('Marca')."</th>";
				echo "<th>".utf8_decode('Modelo')."</th>";
				echo "<th>".utf8_decode('Clave')."</th>";
				echo "<th>".utf8_decode('Inventario')."</th>";
				echo "<th>".utf8_decode('Imei')."</th>";
				echo "<th>".utf8_decode('Sim')."</th>";
				echo "<th>".utf8_decode('Cedula')."</th>";
				echo "<th>".utf8_decode('Nombre')."</th>";
				echo "<th>".utf8_decode('Apellido')."</th>";
				echo "<th>".utf8_decode('UO')."</th>";
				echo "<th>".utf8_decode('Condicion')."</th>";
				echo "<th>".utf8_decode('Descripcion')."</th>";
				echo "<th>".utf8_decode('Ubicación')."</th>";
				echo "</tr>";
				
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
  					echo "<td>'".utf8_decode($row['serial'])."</td>";
  					echo "<td>".utf8_decode($row['fecha'])."</td>";
  					echo "<td>".utf8_decode($row['numero'])."</td>";
  					echo "<td>".utf8_decode($row['tipo_disp'])."</td>";
  					echo "<td>".utf8_decode($row['operador'])."</td>";
  					echo "<td>".utf8_decode($row['tecnologia'])."</td>";
  					echo "<td>".utf8_decode($row['marca'])."</td>";
  					echo "<td>".utf8_decode($row['modelo'])."</td>";
  					echo "<td>".utf8_decode($row['clave'])."</td>";
  					echo "<td>'".utf8_decode($row['inv'])."</td>";
  					echo "<td>'".utf8_decode($row['imei'])."</td>";
  					echo "<td>'".utf8_decode($row['sim'])."</td>";
  					echo "<td>".utf8_decode($row['cedula'])."</td>";	
  				   echo "<td>".utf8_decode($row['nombre'])."</td>";
  					echo "<td>".utf8_decode($row['apellido'])."</td>";
  					echo "<td>'".utf8_decode($row['uo'])."</td>";
  					echo "<td>".utf8_decode($row['condicion'])."</td>";
  					echo "<td>".utf8_decode($row['desc_entrega'])."</td>";
  					echo "<td>".utf8_decode($row['ubicacion'])."</td>";
  					echo "</tr>";
  				}
  				echo "</table>";  
  				echo "<br /><br />";				
			}	
			
			elseif ($x==3)
			
			//////////////////////////////////////////
			//Si la variable x=3 Imprime la Bitacora//
			//////////////////////////////////////////	
			
			{
			
				$valor=$_GET["v"];
				include("includes/conecta.php");
				mysql_query("SET NAMES utf8");
	
				$result = mysql_query("SELECT e.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, u.cedula, u.nombre, u.apellido, u.uo FROM entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula WHERE serial='".$valor."' ORDER BY e.fecha");
				
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
  						echo "<td><t>" . utf8_decode($row['fecha']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['cedula']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['nombre']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['apellido']) . "</t></td>";
  						echo "<td><t>'" . utf8_decode($row['uo']) . "</t></td>";
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
  						echo "<td><t>" . utf8_decode($row['fecha']) . "</t></td>";
  						echo "<td><t>" . utf8_decode($row['desc_reincor']) . "</t></td>";

  						echo "</tr>";
  					}
  		
  					echo "</table>";
		
				}

			
			}
			
			mysql_close($con);
?>