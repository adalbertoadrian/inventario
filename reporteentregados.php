<?php
include("includes/autentificado.php"); 
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		<meta charset="utf-8">
		<script type="text/javascript">
		
			var diai;
			var mesi;
			var anoi;
			var diaf;
			var mesf;
			var anof;
			var diai_c;
			var mesi_c;
			var anoi_c;
			var diaf_c;
			var mesf_c;
			var anof_c;
			var ub;
			var ub_c='*';
			var co;
			var co_c='*';
			var ti;
			var ti_c='*';
			var ri;
			var rf=10;
			var npagi;
			var npagf;
			var fechai;
			var fechaf;
			
			function volverfocus()
			{
				document.imagenvolver.src="imagenes/volverfocus.png";
			}
			
			function volversinfocus()
			{
				document.imagenvolver.src="imagenes/volver.png";
			}
			
			function dia_i(v)
			{
				diai_c = v;
			}
			
			function mes_i(v)
			{
				mesi_c = v;
			}
			
			function ano_i(v)
			{
				anoi_c = v;
			}
			
			function dia_f(v)
			{
				diaf_c = v;
			}
			
			function mes_f(v)
			{
				mesf_c = v;
			}
			
			function ano_f(v)
			{
				anof_c = v;
			}
			
			function ubic(v)
			{
				ub_c = v;
			}
			
			function cond(v)
			{
				co_c = v;
			}
			
			function tip(v)
			{
				ti_c = v;
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
  					co = co_c;
  					ti = ti_c;
  					diai = diai_c;
  					mesi = mesi_c;
  					anoi = anoi_c;
  					diaf = diaf_c;
  					mesf = mesf_c;
  					anof = anof_c;
  					npagi = 1;
  					npagf = 0;
  					fechai = new Date();
  					fechaf = new Date();
  					fechai.setFullYear(anoi,mesi,diai);
					fechaf.setFullYear(anof,mesf,diaf);
  				}
  				
  				if (isNaN(diai)) {

					alert ("Error debe Ingresar un Dia de Inicio");
					document.formularioi.diai.focus();
					return;  				
  				
  				} 
  				else if (isNaN(mesi)) {

					alert ("Error debe Ingresar un Mes de Inicio");
					document.formularioi.mesi.focus();
					return;
					
				} 
				else if (isNaN(anoi)) {

					alert ("Error debe Ingresar un Año de Inicio");
					document.formularioi.anoi.focus();
					return;
					
				} 
				else if (isNaN(diaf)) {

					alert ("Error debe Ingresar un Dia Final");
					document.formulariof.diaf.focus();
					return;      	
  				
				} 
				else if (isNaN(mesf)) {

					alert ("Error debe Ingresar un Mes Final");
					document.formulariof.mesf.focus();
					return;    				
					
				} 
				else if (isNaN(anof)) {

					alert ("Error debe Ingresar un Año Final");
					document.formulariof.anof.focus();
					return; 
				
				}
				else if(fechai>fechaf)
				{
					alert("La Fecha de Inicio debe ser Mayor o Igual a la Fecha Final");
					return;
				}
  				
  				if (v=='next' && ri + 10 < document.formulariooculto.campooculto.value)
  				{
  					ri = ri + 10;
  					npagi++;
  					npagf = document.formulariooculto.npagina.value
  				}
  				
  				if (v=='back' && ri!=0)
  				{
  					ri = ri - 10;
  					npagi--;
  					npagf = document.formulariooculto.npagina.value
  				}	
  				
				var fei = anoi+mesi+diai;
				var fef = anof+mesf+diaf;				
  				
				xmlhttp.open("GET", "gets/gettablaentrega.php?i="+fei+"&f="+fef+"&u="+ub+"&tip="+ti+"&c="+co+"&lri="+ri+"&lrf="+rf+"&np="+npagi+"&npf="+npagf, true);
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
		<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Reporte de Equipos Entregados</strong></i></div></td></tr></table>
		</fieldset>		
		
		<br />
		
		<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
		<br /><br />
		
		<table border="1" rules="none" cellspacing="5">
		
			<caption><div style="font-size:15px; text-align:left; color:#000000;"><strong>Parametros del Reporte</strong></div></caption>
		
			<tr align="center">
		
			<td bgcolor="#D8D8D8"><e>Fecha Entrega</e> <o>* </o></td>

			<td bgcolor="#D8D8D8">

			<!--//////////////////////////////////////////
			/// Formulario Fecha de Inicio del Reporte ///			
			///////////////////////////////////////////-->
			
			<FORM name="formularioi">
		
				<!--/////////////////////////////
				/// Dia de inicio del reporte ///			
				//////////////////////////////-->
		
				<t><strong>Desde:</strong></t> <select size="1" name="diai" onchange="dia_i(value)">
			
				<option selected value="">D&iacute;a</option>
				<option value ="01">01</option>
				<option value ="02">02</option>
				<option value ="03">03</option>
				<option value ="04">04</option>
				<option value ="05">05</option>
				<option value ="06">06</option>
				<option value ="07">07</option>
				<option value ="08">08</option>
				<option value ="09">09</option>
			
				<?php for ($i=10; $i<=31; $i++) {

					echo "<option value='".$i."'>".$i."</option>";
				 
				} ?>			
				
				</select>
			
				<!--/////////////////////////////
				/// Dia de inicio del reporte ///			
				//////////////////////////////-->
			
				<select size="1" name="mesi" onchange="mes_i(value)">
				<option selected value="">Mes</option>
				<option value ="01">01</option>
				<option value ="02">02</option>
				<option value ="03">03</option>
				<option value ="04">04</option>
				<option value ="05">05</option>
				<option value ="06">06</option>
				<option value ="07">07</option>
				<option value ="08">08</option>
				<option value ="09">09</option>
			
				<?php for ($i=10; $i<=12; $i++) {

					echo "<option value='".$i."'>".$i."</option>";
				 
				} ?>			
				
				</select>	
			
				<!--/////////////////////////////
				/// Año de inicio del reporte ///			
				//////////////////////////////-->
			
				<select size="1" name="anoi" onchange="ano_i(value)">
				<option selected value="">A&ntilde;o</option>
			
				<?php for ($i=2009; $i<=date("Y"); $i++) {

					echo "<option value='".$i."'>".$i."</option>";
				 
				} ?>			
				
				</select>	
				
			</FORM>
			
			</td>
		
			<!--//////////////////////////////////////////
			/// Formulario Fecha Final del Reporte ///			
			///////////////////////////////////////////-->
			
			<td bgcolor="#D8D8D8">
			
			<FORM name="formulariof">
		
				<!--/////////////////////////////
				/// Dia de inicio del reporte ///			
				//////////////////////////////-->
		
				<t><strong>Hasta:</strong></t> <select size="1" name="diaf" onchange="dia_f(value)">
				<option selected value=""> D&iacute;a</option>
				<option value ="01">01</option>
				<option value ="02">02</option>
				<option value ="03">03</option>
				<option value ="04">04</option>
				<option value ="05">05</option>
				<option value ="06">06</option>
				<option value ="07">07</option>
				<option value ="08">08</option>
				<option value ="09">09</option>
				<?php for ($i=10; $i<=31; $i++) {

					echo "<option value='".$i."'>".$i."</option>";
				 
				} ?>			
				
				</select>
			
				<!--/////////////////////////////
				/// Dia de inicio del reporte ///			
				//////////////////////////////-->
			
				<select size="1" name="mesf" onchange="mes_f(value)">
				<option selected value="">Mes</option>
				<option value ="01">01</option>
				<option value ="02">02</option>
				<option value ="03">03</option>
				<option value ="04">04</option>
				<option value ="05">05</option>
				<option value ="06">06</option>
				<option value ="07">07</option>
				<option value ="08">08</option>
				<option value ="09">09</option>
			
				<?php for ($i=10; $i<=12; $i++) {

					echo "<option value='".$i."'>".$i."</option>";
				 
				} ?>			
				
				</select>	
			
				<!--/////////////////////////////
				/// Año de inicio del reporte ///			
				//////////////////////////////-->
		
				<select size="1" name="anof" onchange="ano_f(value)">
			
				<option selected value="">A&ntilde;o</option>
			
				<?php for ($i=2009; $i<=date("Y"); $i++) {

					echo "<option value='".$i."'>".$i."</option>";
				 
				} ?>			
				
				</select>	
				
			</FORM>

			</td>				
						
			</tr>
			
			<!-- Tipo de Equipo a Consultar -->
				
			<tr>
			
			<td>
			
				<e>Tipo de Equipo</e>
			
			</td>			
			
			<td align="left">
			
				<select size="1" name="tipo" onchange="tip(value)">
					<option selected value="*">Todos</option>
					<option value="Celular">Celular</option>
					<option value="Telefono Fijo">Telefono Fijo</option>
					<option value="Modem Inalambrico">Modem Inalambrico</option>
				</select>
						
			</td>
			
			</tr>
			
			<!--// Condición de Entrega a Consultar //-->
			
			<tr>
			
			<td bgcolor="#D8D8D8">
			
			<e>Condici&oacute;n de Entrega</e>
			
			</td>

			<td bgcolor="#D8D8D8" colspan='2'>			
				<select size="1" name="condicion" onchange="cond(value)">
					<option selected value="*">Todas</option>
					<option value="Asignacion">Asignaci&oacute;n</option>
					<option value="Reemplazo - Falla">Reemplazo - Falla</option>
					<option value="Reemplazo - Robo">Reemplazo - Robo</option>
					<option value="Reemplazo - Extravio">Reemplazo - Extravi&oacute;</option>
					<option value="Prestamo">Pr&eacute;stamo</option>
				</select>	
			
			</td>
			
			</tr>
			
			<!--// Ubicacion del equipo a Consultar //-->	
			
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
		
		</table>		
		
		<br />
			
		<input type="button" name="generar" value="Generar" onclick="showtabla(name)"> 
			
		<br /><br />
		
		<!-- >Se trae la tabla de equipos entregados con los parametros ingresados en el formulario  --> 
		
		<div id="txtHint"></div>
		
	</body>
</html>

