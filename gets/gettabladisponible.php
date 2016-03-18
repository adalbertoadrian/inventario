<?php
include("../includes/autentificado.php");

			//Captura las variables enviadas por la pagina reporteingreso.php//
			
			$ub=$_GET["u"];
			$te=$_GET["t"];
			$ti=$_GET["tip"];
			$tir=$_GET["tir"];
			$ma=$_GET["m"];
			$ti_r=$_GET["ti_r"];
			$ri=$_GET["i"];
			$rf=$_GET["f"];
			$npagi=$_GET["np"];
			$npagf=$_GET["npf"];
			$ord=$_GET["o"];
			
			if($ord==1) 
			{ 
				$ruta="imagenes/order_desc.png";
				$alt="Orden Descendiente";
				$orden="DESC"; 
			} 
			else 
			{ 
				$ruta="imagenes/order_asc.png";
				$alt="Orden Ascendente";
				$orden="ASC"; 
			}
			
			//Cambia los operadores de la consulta en caso de ser necesario // 
			
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
			
			//Se conecta a la BD//
			
			include("../includes/conecta.php");
			mysql_query("SET NAMES utf8");
			
			//Si ti_r = 'detallado' imprime el reporte de equipos disponibles detallado//
			
			if($ti_r=='detallado')
			
			{
				
				$r=1;
				
				//Comprueba el total de registros en la Tabla para llenar la variable totalregistros y imprimir el Numero de bloque de registros que se estan consultando//
				
				$result = mysql_query("SELECT serial FROM dispositivos WHERE entregado = '0' AND ubicacion ".$oubic." '".$ub."' AND tecnologia ".$otec." '".$te."' AND marca ".$omac." '".$ma."' AND tipo_disp ".$otip." '".$ti."' AND tipreserva ".$otir." '".$tir."' ORDER BY marca,modelo,serial");
				
				$totalregistros = mysql_num_rows($result);
				if ($ri + 30 > $totalregistros) { $f = $totalregistros; } else { $f = $ri + 30; }
				$i = $ri + 1;
				
				//Se trae un bloque de registros del reporte siempre se realizan consultas de 30 registros unicamente//
				
				$result = mysql_query("SELECT * FROM dispositivos WHERE entregado = '0' AND ubicacion ".$oubic." '".$ub."' AND tecnologia ".$otec." '".$te."' AND marca ".$omac." '".$ma."' AND tipo_disp ".$otip." '".$ti."' AND tipreserva ".$otir." '".$tir."' ORDER BY marca,modelo,serial ".$orden." LIMIT ".$ri.",".$rf."");
				
				//Se imprime la tabla//

				echo "<table border='2' rules='none' cellspacing='2' align='center'>";
				
				//Imprime el numero de bloque de registro que se esta consultando//
				
				if($npagf==0)
				{
					$npagf=1;
					$compara=0;
				
					while($compara + 30 < $totalregistros)
					{
						$compara = $compara + 30;
						$npagf = $npagf + 1;
					}
				}
				
				echo "<caption><div style='text-align:right;'><e>Mostrando Registros ".$i." - ".$f." (Total: ".$totalregistros.") - Pagina: ". $npagi ."/". $npagf."</e></div></caption>";
				
				//Aqui configura el boton exportar para que envie a la pagina exportar.php los datos del reporte con la variable r=1 lo que indica que es un reporte de equipos disponibles//
				
				echo "<tr><td><div style='text-align:left';><a href='exportar.php?r=".$r."&u=".$ub."&t=".$te."&tip=".$ti."&tipres=".$tir."&m=".$ma."&tir=".$ti_r."'><img src='imagenes/export.png' title='Exportar' alt='Exportar' border = '0'></a></div></td>";
				
				//imprime las flechas para desplazarse entre los bloques de registros//
				
				echo "<td colspan='13' align='right'><input type='image' name='back' title='Anterior' src='imagenes/back.png' alt='Anterior' onclick='showtabla(name)'> <input type='image' name='next' title='Siguiente' src='imagenes/next.png' alt='Siguiente' onclick='showtabla(name)'></div></td>";
				echo "</tr>";
			
				echo "<tr bgcolor='#CECEF6' align='center'>
				<th><t>Serial <img src='".$ruta."' name='orden' title='Cambiar Orden' alt='".$alt."' onclick='showtabla(name)' /></t></th>
				<th><t>Numero</t></th>
				<th><t>Tipo de Dispositivo</t></th>
				<th><t>Operador</t></th>
				<th><t>Tecnolog&iacute;a</t></th>
				<th><t>Marca</t></th>
				<th><t>Modelo</t></th>
				<th><t>Plan</t></th>
				<th><t>Inventario</t></th>
				<th><t>Imei</t></th>
				<th><t>Sim</t></th>
				<th><t>Tipo de Reserva</t></th>
				<th><t>Ubicaci&oacute;n</t></th>
				</tr>";
			
				$color=0;
				
				while($row = mysql_fetch_array($result))
  				{
  					echo "<td><div class='title'><t>" . $row['serial'] . "</t><span>" . $row['serial'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['numero'] . "</t><span>" . $row['numero'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['tipo_disp'] . "</t><span>" . $row['tipo_disp'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['operador'] . "</t><span>" . $row['operador'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['tecnologia'] . "</t><span>" . $row['tecnologia'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['marca'] . "</t><span>" . $row['marca'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['modelo'] . "</t><span>" . $row['modelo'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['plan'] . "</t><span>" . $row['plan'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['inv'] . "</t><span>" . $row['inv'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['imei'] . "</t><span>" . $row['imei'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['sim'] . "</t><span>" . $row['sim'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['tipreserva'] . "</t><span>" . $row['tipreserva'] . "</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['ubicacion'] . "</t><span>" . $row['ubicacion'] . "</span></div></td>";
  					echo "</tr>";
  					$color++;
  				}
  			
				echo "</table>";
				
				echo "<form name='formulariooculto'>";
				echo "<input type='hidden' name='campooculto' value='".$totalregistros."' />";
				echo "<input type='hidden' name='npagina' value='".$npagf."' />";
				echo "</form>";				
				
			}
			
			else
			
			{
			
				//Si ti_r <> 'detallado' imprime el reporte de equipos disponibles resumido//
			
				$r=1;
				
				//Comprueba el total de registros en la Tabla para llenar la variable totalregistros y imprimir el Numero de bloque de registros que se estan consultando//
				
				$result = mysql_query("SELECT COUNT(modelo) FROM dispositivos WHERE entregado = '0' AND ubicacion ".$oubic." '".$ub."' AND marca ".$omac." '".$ma."' AND tecnologia ".$otec." '".$te."' AND tipo_disp ".$otip." '".$ti."' AND tipreserva ".$otir." '".$tir."' GROUP BY modelo,ubicacion,marca,tecnologia ORDER BY marca,modelo");
				
				$totalregistros = mysql_num_rows($result);
				if ($ri + 30 > $totalregistros) { $f = $totalregistros; } else { $f = $ri + 30; }
				$i = $ri + 1;
				
				//Calcula el monto total de equipos//
				
				$total=0;
				while($row = mysql_fetch_array($result)) {

  					$total = $total + $row['COUNT(modelo)'];
  					
  				}	
				
				//Realiza la consulta en la BD//
			
				$result = mysql_query("SELECT modelo, marca, tecnologia, ubicacion, COUNT(modelo) FROM dispositivos WHERE entregado = '0' AND ubicacion ".$oubic." '".$ub."' AND marca ".$omac." '".$ma."' AND tecnologia ".$otec." '".$te."' AND tipo_disp ".$otip." '".$ti."' AND tipreserva ".$otir." '".$tir."' GROUP BY modelo,ubicacion,marca,tecnologia ORDER BY marca,modelo LIMIT ".$ri.",".$rf."");
				
				//Imprime la tabla//

				echo "<table border='2' rules='none' cellspacing='2' align='center'>";
				
				//Imprime el numero de bloque de registro que se esta consultando//
				
				if($npagf==0)
				{
					$npagf=1;
					$compara=0;
				
					while($compara + 30 < $totalregistros)
					{
						$compara = $compara + 30;
						$npagf = $npagf + 1;
					}
				}
				
				echo "<caption><div style='text-align:right;'><e>Mostrando Registros ".$i." - ".$f." (Total: ".$totalregistros.") - Pagina: ". $npagi ."/". $npagf."</e></div></caption>";
				
				//Aqui configura el boton exportar para que envie a la pagina exportar.php los datos del reporte con la variable r=1 lo que indica que es un reporte de equipos disponibles//
				
				echo "<tr><td><div style='text-align:left';><a href='exportar.php?r=".$r."&u=".$ub."&tip=".$ti."&t=".$te."&m=".$ma."&tipres=".$tir."&tir=".$ti_r."'><img src='imagenes/export.png' title='Exportar' alt='Exportar' border = '0'></a></div></td>";
				
				//imprime las flechas para desplazarse entre los bloques de registros//
				
				echo "<td colspan='10' align='right'><input type='image' name='back' src='imagenes/back.png' alt='Anterior' title='Anterior' onclick='showtabla(name)'> <input type='image' name='next' src='imagenes/next.png' title='Siguiente' alt='Siguiente' onclick='showtabla(name)'></div></td>";
				echo "</tr>";		
			
				echo "<tr bgcolor='#CECEF6' align='center'>
				<th><t>Modelo</t></th>
				<th><t>Marca</t></th>
				<th><t>Tecnolog&iacute;a</t></th>
				<th><t>Ubicaci&oacute;n</t></th>
				<th><t>N° Equipos</t></th>
				</tr>";
			
				$color=0;
			
				while($row = mysql_fetch_array($result))
  				{
  					echo "<tr class='celda' bgcolor='".($color%2=='0' ? '#FFFFFF' : '#D8D8D8')."' align='center'>";
  					echo "<td><div class='title'><t>" . $row['modelo'] . "</t><span>". $row['modelo'] ."</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['marca'] . "</t><span>". $row['marca'] ."</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['tecnologia'] . "</t><span>". $row['tecnologia'] ."</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['ubicacion'] . "</t><span>". $row['ubicacion'] ."</span></div></td>";
  					echo "<td><div class='title'><t>" . $row['COUNT(modelo)'] . "</t><span>". $row['COUNT(modelo)'] ."</span></div></td>";
  					echo "</tr>";
  					$color++;
  				}
  				
  				echo "<tr><td colspan='5' align='right'><HR WIDTH='100%'; color='#FF0000';><t><strong>Total de Equipos: ".$total."</strong></t></td></tr>";

				echo "<form name='formulariooculto'>";
				echo "<input type='hidden' name='campooculto' value='".$totalregistros."' />";
				echo "<input type='hidden' name='npagina' value='".$npagf."' />";
				echo "</form>";	  				
  				
				echo "</table>";		
			
			}
			
			echo "<br /><br />";		

			mysql_close($con);
?>
