<?php
include("includes/autentificado.php"); 
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		<script type="text/javascript">

			var ub_c='*';
			var ub;
			var te_c='*';
			var te;
			var ti_c='*';
			var ti;
			var tir_c='*';
			var tir;
			var ma_c='*';
			var ma;
			var ti_r_c='resumido';
			var ti_r;
			var ri;
			var rf=30;
			var npagi;
			var npagf;
			var ord;
			var id;
			
			function volverfocus()
			{
				document.imagenvolver.src="imagenes/volverfocus.png";
			}
			
			function volversinfocus()
			{
				document.imagenvolver.src="imagenes/volver.png";
			}
			
			function ubic(v)
			{
				ub_c = v;
			}
			
			function tec(v)
			{
				te_c = v;
			}
			
			function tip(v)
			{
				ti_c = v;
			}
			
			function tipres(v)
			{
				tir_c = v;
			}
			
			function mac(v)
			{
				ma_c = v;
			}	
			
			function tiporep(v)
			{
				ti_r_c = v;
			}			
		
			function showtabla(v)
			{
				if (window.XMLHttpRequest)
  				{
  					// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{
  					// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
    				{
    					document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    				}
  				}
  				
  				if (v=='generar')
  				{
  					ri = 0;
  					ub = ub_c;
  					te = te_c;
  					ti = ti_c;
  					tir = tir_c;
  					ma = ma_c;
  					ti_r = ti_r_c;
  					npagi = 1;
  					npagf = 0;
  					ord = 1;
  				}
  				
  				if (v=='orden')	
				{
					if (ord==1)
					{
					 ord = 2;
					}
					else
					{
					 ord = 1;
					}
				}  				
  				
  				if (v=='next' && ri + 30 < document.formulariooculto.campooculto.value)
  				{
  					ri = ri + 30;
  					npagi++;
  					npagf = document.formulariooculto.npagina.value
  				}
  				
  				if (v=='back' && ri!=0)
  				{
  					ri = ri - 30;
  					npagi--;
  					npagf = document.formulariooculto.npagina.value
  				}	  			  				
  				
				xmlhttp.open("GET", "gets/gettabladisponible.php?u="+ub+"&t="+te+"&tip="+ti+"&tir="+tir+"&m="+ma+"&ti_r="+ti_r+"&i="+ri+"&f="+rf+"&np="+npagi+"&npf="+npagf+"&o="+ord, true);
				xmlhttp.send();
			}
		</script>
	</head>

	<title>
		Sistema de Manejo de Inventario
	</title>
	
	<style type="text/css">
		tr.celda:hover {
			background-color: #D0F5A9;
		}
		
		select {
			border:1px solid Silver;
			font-family:Verdana;
			font-size:12px;
		}	
		div.title { position: relative;
			z-index: 0;
		}
		div.title:hover { background-color: transparent;
			z-index: 1;
		}
		div.title span { border: 1px solid #f60;
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
		div.title:hover span { visibility: visible;
			top: 24px;
			left: 25px;
		}
	</style>
	
	<body>
		
			<? include("includes/header.php"); ?>

			<fieldset style='border:1px solid #000099'>
			<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Reporte de Equipos Disponibles</strong></i></div></td></tr></table>
			</fieldset>		
		
			<br />
			
			<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
			
			<br /><br />
		
			<table border="1" rules="none" cellspacing="5">
				
			<caption><div style="font-size:15px; text-align:left; color:#000000;"><strong>Parametros del Reporte</strong></div></caption>
				
				<!-- Campo de tipo de reporte a imprimir Resumido o Detallado -->
				
				<tr>
			
					<td bgcolor="#D8D8D8">
			
						<e>Tipo de Reporte</e>
			
					</td>			
			
					<td align="left" bgcolor="#D8D8D8">			

						<t>Resumido</t><input type="radio" checked value="resumido" name="tipo_rep" onclick="tiporep(value)"><br />
				
						<t>Detallado </t><input type="radio" value="detallado" name="tipo_rep" onclick="tiporep(value)">						
							
					</td>				
			
				</tr>
				
				<!-- Ubicacion de los equipos a consultar Caracas o Puerto Ordaz -->
		
				<tr>
			
					<td>
			
						<e>Ubicaci&oacute;n</e>
			
					</td>			
			
					<td align="left">
			
						<select size="1" name="ubicacion" onchange="ubic(value)">
						<option selected value="*">Todas</option>
						<option value="Puerto Ordaz">Puerto Ordaz</option>
						<option value="Caracas">Caracas</option>		
						</select>
							
					</td>
			
				</tr>
				
				<!-- Tipo de Equipo a Consultar -->
				
				<tr>
			
					<td bgcolor="#D8D8D8">
			
						<e>Tipo de Equipo</e>
			
					</td>			
			
					<td align="left" bgcolor="#D8D8D8">
			
						<select size="1" name="tipo" onchange="tip(value)">
							<option selected value="*">Todos</option>
							<option value="Celular">Celular</option>
							<option value="Telefono Fijo">Telefono Fijo</option>
							<option value="Telefono Inalambrico">Telefono Inalambrico</option>
							<option value="Modem Inalambrico">Modem Inalambrico</option>
						</select>
							
					</td>
			
				</tr>
				
				<!-- Marca de los equipos a consultar -->
				
				<tr>
			
					<td align="left">
			
						<e>Marca</e>
			
					</td>			
			
					<td align="left">
			
						<select size="1" name="marca" onchange="mac(value)">
						<option selected value="*">Todas</option>
						<option value="BlackBerry">BlackBerry</option>
						<option value="HTC">HTC</option>
						<option value="Nokia">Nokia</option>
						<option value="Merlin">Merlin</option>
						<option value="Motorola">Motorola</option>
						<option value="Huawei">Huawei</option>
						<option value="Kyocera">Kyocera</option>
						<option value="LG">LG</option>
						<option value="Startel">Startel</option>
						<option value="Siemens">Siemens</option>		
						</select>
							
					</td>
			
				</tr>
				
				<!-- Tecnologia de los equipos a consultar -->
				
				<tr>
			
					<td bgcolor="#D8D8D8">
			
						<e>Tecnolog&iacute;a</e>
			
					</td>			
			
					<td align="left" bgcolor="#D8D8D8">
			
						<select size="1" name="tecnologia" onchange="tec(value)">
						<option selected value="*">Todas</option>
						<option value="GSM">GSM</option>
						<option value="CDMA">CDMA</option>		
						</select>
							
					</td>
			
				</tr>
				
				<!-- Tipo de Reserva -->
		
				<tr>
			
					<td>
			
						<e>Tipo de Reserva</e>
			
					</td>			
			
					<td align="left">
			
						<select size="1" name="tir" onchange="tipres(value)">
						<option selected value="*">Todas</option>
						<option value="Nuevo">Nuevo</option>
						<option value="Recuperado">Recuperado</option>		
						</select>
							
					</td>
			
				</tr>
			
			</table>
			
			<br />
			
			<input type="button" name="generar" value="Generar" onclick="showtabla(name)">
			
			<br /><br />
			
			<!-- >Se trae la tabla de equipos disponibles con los parametros ingresados en el formulario  --> 
			
			<div id="txtHint"></div>
			
	</body>
</html>