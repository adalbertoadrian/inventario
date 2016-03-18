<?php
include("includes/autentificado.php"); 
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />

		<script type="text/javascript">
		
			var r;
			var diae;
  			var mese;
  			var anoe;
  			var diad;
  			var mesd;
  			var anod;
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
		
			function resetear()
			{
				location.reload();	
			}
			
			function visible()
			{
				if(document.fingreso.condicion.value != "Prestamo")
				{
					document.fingreso.dia_d.style.visibility = "hidden";
					document.fingreso.mes_d.style.visibility = "hidden";
					document.fingreso.ano_d.style.visibility = "hidden";
					document.getElementById("fechadev").style.visibility = "hidden";
					document.getElementById("txtHint3").innerHTML="";
				}
				else
				{
					document.fingreso.dia_d.style.visibility = "visible";
					document.fingreso.mes_d.style.visibility = "visible";
					document.fingreso.ano_d.style.visibility = "visible";
					document.getElementById("fechadev").style.visibility = "visible";
					document.getElementById("txtHint3").innerHTML="<br /><e>Duraci&oacute;n del Prestamo: 0 D&iacute;as</e>";
				}			
			}
		
			function showEquipo(e,v)
			{
				if(e.keyCode==13)
				{
					if (v.length==0)
  					{
  						document.getElementById("txtHint").innerHTML="";
  						return;
  					}
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
  					
					xmlhttp.open("GET","gets/getequipo.php?q="+v,true);
					xmlhttp.send();
				}
			}
			
			function showUsuario(e,v)
			{
				if(e.keyCode==13)
				{	
					if (v.length==0)
  					{
  						document.getElementById("txtHint2").innerHTML="";
  						return;
  					} else if (isNaN(v)){
  						alert ("!Error el campo cedula debe ser un valor numerico!");
  						document.fingreso.cedula.focus();
  						return;
  					}
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
    						document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    					}
  					}
  					
					xmlhttp.open("GET","gets/getusuario.php?q="+v,true);
					xmlhttp.send();
				}
			}
			
			function showdiferenciafecha()
			{
				if(document.fingreso.condicion.value == "Prestamo")
				{
					
					diae = document.fingreso.dia.value;
  					mese = document.fingreso.mes.value;
  					anoe = document.fingreso.ano.value;
  					diad = document.fingreso.dia_d.value;
  					mesd = document.fingreso.mes_d.value;
  					anod = document.fingreso.ano_d.value;
  					fechai = new Date();
  					fechaf = new Date();
  					fechai.setFullYear(anoe,mese,diae);
  					fechaf.setFullYear(anod,mesd,diad);
  					
  					if(fechaf>=fechai)
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
    							document.getElementById("txtHint3").innerHTML=xmlhttp.responseText;
    						}
  						}

						xmlhttp.open("GET","gets/getfechadiv.php?dia_e="+diae+"&mes_e="+mese+"&ano_e="+anoe+"&dia_d="+diad+"&mes_d="+mesd+"&ano_d="+anod, true);
						xmlhttp.send();
					}
					else
					{
						document.getElementById("txtHint3").innerHTML="<br /><e>Rango de Fecha Incorrecto</e>";
					}
				}
			}
			
			function validar_formulario()
			{ 	
				if (document.getElementById("txtHint").innerHTML=="")
				{
					alert("Debe ingresar un serial valido");
					document.fingreso.serial.focus();
					return 0;
				}			
				else if (document.fingreso.serialoculto.value.length==0)
				{
					alert("Debe ingresar un serial valido");
					document.fingreso.serial.focus();
					return 0;
				}
				else if (document.getElementById("txtHint2").innerHTML=="")
				{
					alert("Debe ingresar una cedula valida");
					document.fingreso.cedula.focus();
					return 0;
				}
				else if (document.fingreso.cedulaoculta.value.length==0)
				{
					alert("Debe ingresar una cedula valida");
					document.fingreso.cedula.focus();
					return 0;
				}
				else if (document.fingreso.condicion.value.length==0)
				{
					alert("Debe ingresar una condicion de entrega");
					document.fingreso.condicion.focus();
					return 0;
				}
				else if(document.fingreso.condicion.value == "Prestamo")
				{
					diae = document.fingreso.dia.value;
  					mese = document.fingreso.mes.value;
  					anoe = document.fingreso.ano.value;
  					diad = document.fingreso.dia_d.value;
  					mesd = document.fingreso.mes_d.value;
  					anod = document.fingreso.ano_d.value;
  					fechai = new Date();
  					fechaf = new Date();
  					fechai.setFullYear(anoe,mese,diae);
					fechaf.setFullYear(anod,mesd,diad);
					
					if(fechai>fechaf)
					{
						alert("La Fecha de Devolucion debe ser Mayor o Igual a la Fecha de Entrega");
						return 0;
					}
				}
				
				r=confirm("Esta seguro que desea entregar este dispositivo");
				
				if (r==true)
  				{
  					document.fingreso.submit();
  				}
				else
 				{
  					return 0;
  				}
			} 
		</script>		
		
	</head>

	<title>
		Sistema de Manejo de Inventario
	</title>
	
	<style type="text/css">
		select {
			border:1px solid Silver;
			font-family:Verdana;
			font-size:12px;
		}	
	</style>
	
	<body onload="visible()">		
			
		<? include("includes/header.php"); ?>

		<fieldset style='border:1px solid #000099'>
		<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Entrega de Equipo</strong></i></div></td></tr></table>
		</fieldset>		
		
		<br />
		
		<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
		<br /><br />
		
		<FORM METHOD="post" NAME="fingreso" ACTION="procesarentrega.php">
			
			
			<!-- ////////////////////////
			// Campo Serial del Equipo //
			/////////////////////////-->		
	
			<e>Serial del Equipo</e> <o>* </o><input type="text" name="serial" size="30" maxlength="30" onkeyup="showEquipo(event,value)"> <t>Presione <img src="imagenes/enter.png" border = 0> para Continuar</t>
			
			<br /><br /><br />
			
			<!-- Muestra los datos del equipo -->
			
			<div id="txtHint"></div>
			
			<!-- /////////////////////////			
			// Campo Cedula del Usuario //
			///////////////////////////-->
			
			<e>Cedula del Usuario</e> <o>* </o></strong><input type="text" name="cedula" size="9" maxlength="9" onkeyup="showUsuario(event,value)"> <t>Presione <img src="imagenes/enter.png" border="0"> para Continuar</t>
			
			<br /><br /><br />
			
			<!-- Muestra los datos del usuario -->
			
			<div id="txtHint2"></div>
					
			<!-------------------------->
			<!-- Condicion de entrega -->
			<!-------------------------->
			
			<e>Condici&oacute;n de Entrega</e> <o>* </o> <select size="1" name="condicion" onchange="visible()">
			<option selected value="">Seleccione una Opci&oacute;n</option>
			<option value="Asignacion">Asignaci&oacute;n</option>
			<option value="Reemplazo - Falla">Reemplazo - Falla</option>
			<option value="Reemplazo - Robo">Reemplazo - Robo</option>
			<option value="Reemplazo - Extravio">Reemplazo - Extravi&oacute;</option>
			<option value="Prestamo">Pr&eacute;stamo</option>
			</select>
			<br /><br /><br />
			
						
			<!--////////////////////////
			/// Fecha de la entrega ///			
			////////////////////////-->
			
			<!--///////////////
			/// Dia Entrega ///			
			////////////////-->
		
			<table border="0" rules="none">
			
			<tr>
			
			<td>
			
			<e>Fecha Entrega</e> <o>* </o> <br /><select size="1" name="dia" onchange="showdiferenciafecha()">

			<?php 

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
			?>			
				
			</select>
			
			<!--///////////////
			/// Mes Entrega ///			
			////////////////-->
			
			<select size="1" name="mes" onchange="showdiferenciafecha()">

			<?php 

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
			?>			
				
			</select>
			
			<!--//////////////
			/// Año Entrega //			
			///////////////-->
			
			<select size="1" name="ano" onchange="showdiferenciafecha()">
			
			<?php 

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
			?>			
				
			</select>
			
			</td>
			
			<td></td><td></td><td></td>
			
			<!--////////////////////////
			/// Fecha de la entrega ///			
			////////////////////////-->
			
			<!--///////////////
			/// Dia Entrega ///			
			////////////////-->
			
			<td>
		
			<div id="fechadev"><e>Fecha de Devoluci&oacute;n</e> <o>* </o></div> <select size="1" name="dia_d" onchange="showdiferenciafecha()">

			<?php  		
			
			for ($i=1; $i<=31; $i++) {

				if ($i==$day_now){
					echo "<option selected value='".$day_now."'>".$day_now."</option>";
				}
				else
				{	
					echo "<option value='".$i."'>".$i."</option>";
				} 
			} 		
			?>			
				
			</select>
			
			<!--///////////////
			/// Mes Entrega ///			
			////////////////-->
			
			<select size="1" name="mes_d" onchange="showdiferenciafecha()">

			<?php  		
			
			for ($i=1; $i<=12; $i++) {

				if ($i==$mes_now){
					echo "<option selected value='".$mes_now."'>".$mes_now."</option>";
				}
				else
				{	
					echo "<option value='".$i."'>".$i."</option>";
				} 
			} 		
			?>			
				
			</select>
			
			<!--//////////////
			/// Año Entrega //			
			///////////////-->
			
			<select size="1" name="ano_d" onchange="showdiferenciafecha()">
			
			<?php  		
			
			for ($i=$ano_now; $i<=($ano_now + 1); $i++) {

				if ($i==$ano_now){
					echo "<option selected value='".$ano_now."'>".$ano_now."</option>";
				}
				else
				{	
					echo "<option value='".$i."'>".$i."</option>";
				} 
			} 		
			?>			
				
			</select>
			
			</td>
			
			<td><div id="txtHint3"></div></td>
			
			</tr>
			
			</table>
			
			<!------------------------------>
			<!-- Descrición de la Entrega -->
			<!------------------------------>
			
			<br /><br />		
			
			<e>Descripci&oacute;n de la Entrega</e><br /><textarea name="desc_entrega" cols="50" rows="5"></textarea>
			
			<br /><br /><br />	
			
			<table border="5" align=center rules="none" cellspacing="5">
			<td>

			<input type="button" name="boton" value="Guardar" onclick="validar_formulario()">
			<input type="button" value="Restablecer" name="B2" onclick="resetear()">
			
			</td>
			</table>
			
			<br /><br />

		</FORM>
		
	</body>
</html>