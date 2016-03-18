<?php
include("../includes/autentificado.php"); 

			//Captura las variables enviadas por la pagina reporteentregados.php//

			$fei=$_GET["i"];
			$fef=$_GET["f"];
			$ub=$_GET["u"];
			$co=$_GET["c"];
			$ti=$_GET["tip"];
			$ri=$_GET["lri"];
			$rf=$_GET["lrf"];
			$npagi=$_GET["np"];
			$npagf=$_GET["npf"];
			
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
			
			//Conecta a la BD//
			
			include("../includes/conecta.php");
			mysql_query("SET NAMES utf8");	
			
			$r=2;
			
			//Realiza la consulta en la BD con los parametros indicados en la pagina reporteentregados.php//
			
			$result = mysql_query("SELECT d.numero, d.tipo_disp, d.operador, d.tecnologia, d.marca, d.modelo, d.ubicacion, d.clave, d.inv, d.entregado, e.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, u.cedula, u.nombre, u.apellido, u.uo FROM dispositivos AS d INNER JOIN (entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula) ON d.serial=e.serial WHERE e.fecha BETWEEN '".$anoi."-".$mesi."-".$diai."' AND '".$anof."-".$mesf."-".$diaf."' AND ubicacion ".$oubic." '".$ub."' AND e.condicion ".$ocond." '".$co."' AND d.tipo_disp ".$otip." '".$ti."' ORDER BY e.fecha");
			
			$totalregistros = mysql_num_rows($result);

			if($totalregistros == 0)
			{
				echo "<div style='color:#FF0000; text-align:center; font-family:Arial, Times, serif;'>No se encuentran registros de equipos entregados para el pediodo ".$diai."/".$mesi."/".$anoi." al ".$diaf."/".$mesf."/".$anof."</div><br />";
			}
			else
			{			
				if ($ri + 10 > $totalregistros) { $f = $totalregistros; } else { $f = $ri + 10; }
				$i = $ri + 1;
			
				$result = mysql_query("SELECT d.numero, d.tipo_disp, d.operador, d.tecnologia, d.marca, d.modelo, d.ubicacion, d.clave, d.inv, d.entregado, e.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, u.cedula, u.nombre, u.apellido, u.uo FROM dispositivos AS d INNER JOIN (entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula) ON d.serial=e.serial WHERE e.fecha BETWEEN '".$anoi."-".$mesi."-".$diai."' AND '".$anof."-".$mesf."-".$diaf."' AND ubicacion ".$oubic." '".$ub."' AND e.condicion ".$ocond." '".$co."' AND d.tipo_disp ".$otip." '".$ti."' ORDER BY e.fecha LIMIT ".$ri.",".$rf."");
			
				echo "<t><strong><center>Periodo del Reporte: ".$diai."/".$mesi."/".$anoi." al ".$diaf."/".$mesf."/".$anof."</center></strong></t>";
			
				//Imprime la Tabla//

				echo "<table border='2' rules='none' cellspacing='2' align='center'>";
			
				//Imprime el numero de bloque de registro que se esta consultando//			
							
				if($npagf==0)
				{
					$npagf=1;
					$compara=0;
				
					while($compara + 10 < $totalregistros)
					{
						$compara = $compara + 10;
						$npagf = $npagf + 1;
					}
				}
				
				echo "<caption><div style='text-align:right;'><e>Mostrando Registros ".$i." - ".$f." (Total: ".$totalregistros.") - Pagina: ". $npagi ."/". $npagf."</e></div></caption>";
			
				//Aqui configura el boton exportar para que envie a la pagina exportar.php los datos del reporte con la variable r=2 lo que indica que es un reporte de equipos entregados//
						
				echo "<tr><td><div style='text-align:left';><a href='exportar.php?i=".$fei."&f=".$fef."&r=".$r."&tip=".$ti."&u=".$ub."&c=".$co."'><img src='imagenes/export.png' title='Exportar' alt='Exportar' border = '0'></div></td>";
			
				//imprime las flechas para desplazarse entre los bloques de registros//
				
				echo "<td colspan='14' align='right'><input type='image' name='back' title='Anterior' src='imagenes/back.png' alt='Anterior' onclick='showtabla(name)'> <input type='image' name='next' title='Siguiente' src='imagenes/next.png' alt='Siguiente' onclick='showtabla(name)'></div></td>";
				echo "</tr>";		
			
				echo "<tr bgcolor='#CECEF6' align='center'>
				<th><t>Serial</t></th>
				<th><t>Fecha Entrega</t></th>
				<th><t>Numero</t></th>
				<th><t>Tipo de Dispositivo</t></th>
				<th><t>Operador</t></th>
				<th><t>Marca</t></th>
				<th><t>Modelo</t></th>
				<th><t>Inventario</t></th>
				<th><t>Cedula</t></th>
				<th><t>Nombre</t></th>
				<th><t>Apellido</t></th>
				<th><t>UO</t></th>
				<th><t>Condici&oacute;n</t></th>
				<th><t>Descripci&oacute;n</t></th>
				<th><t>Ubicación</t></th>
				</tr>";
			
				$color=0;
			
				while($row = mysql_fetch_array($result))
  				{
  					echo "<tr class='celda' bgcolor='".($color%2=='0' ? '#FFFFFF' : '#D8D8D8')."' align='center'>";
  					echo "<td><div class='title'><t>" . $row['serial'] . "</t><span>" . $row['serial'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['fecha'] . "</t><span>" . $row['fecha'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['numero'] . "</t><span>" . $row['numero'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['tipo_disp'] . "</t><span>" . $row['tipo_disp'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['operador'] . "</t><span>" . $row['operador'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['marca'] . "</t><span>" . $row['marca'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['modelo'] . "</t><span>" . $row['modelo'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['inv'] . "</t><span>" . $row['inv'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['cedula'] . "</t><span>" . $row['cedula'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['nombre'] . "</t><span>" . $row['nombre'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['apellido'] . "</t><span>" . $row['apellido'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['uo'] . "</t><span>" . $row['uo'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['condicion'] . "</t><span>" . $row['condicion'] . "</span></div></td>";
  					echo "<td><div class='title'><t>".$row['desc_entrega']."</t><span>" .$row['desc_entrega']. "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['ubicacion'] . "</t><span>" . $row['ubicacion'] . "</span></div></td>";
  					echo "</tr>";
  					$color++;
  				}

				echo "<form name='formulariooculto'>";
				echo "<input type='hidden' name='campooculto' value='".$totalregistros."' />";
				echo "<input type='hidden' name='npagina' value='".$npagf."' />";
				echo "</form>";
				echo "</table>";			
				echo "<br /><br />";
			}

			mysql_close($con);		
?>