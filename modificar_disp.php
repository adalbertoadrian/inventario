<?php
include("includes/autentificado.php"); 
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		<script type="text/javascript">
		
			var r;
			var valor;
			
			function volverfocus()
			{
				document.imagenvolver.src="imagenes/volverfocus.png";
			}
			
			function volversinfocus()
			{
				document.imagenvolver.src="imagenes/volver.png";
			}
			
			function bitacorain()
			{
				document.bitacora.src="imagenes/bitacora_in.png";
			}
			
			function bitacoraout()
			{
				document.bitacora.src="imagenes/bitacora_out.png";
			}
			
			function abrirbitacora()
			{
				valor = document.fingreso.serial.value;
				window.open("bitacora.php?v="+valor,"kkkk","width=830,height=770,top=100,left=250,scrollbars=1")
			}

			
			function resetear()
			{
				location.reload();	
			}	
			
			function validar_formulario()
			{ 
				if (document.fingreso.serial.value.length==0)
				{
					alert("Debe ingresar un serial");
					document.fingreso.serial.focus();
					return 0;
				}
				if (document.fingreso.tipo_disp.value.length==0)
				{
					alert("Debe seleccionar un Tipo de Dispositivo");
					document.fingreso.tipo_disp.focus();
					return 0;
				}
				if (document.fingreso.marca.value.length==0)
				{
					alert("Debe seleccionar una Marca");
					document.fingreso.marca.focus();
					return 0;
				}
				if (document.fingreso.modelo.value.length==0)
				{
					alert("Debe ingresar un Modelo de Dispositivo");
					document.fingreso.modelo.focus();
					return 0;
				}
				if (document.fingreso.ubicacion.value.length==0)
				{
					alert("Debe ingresar la Ubicacion del Dispositivo");
					document.fingreso.ubicacion.focus();
					return 0;
				}
				
				r=confirm("Esta seguro que modificar este dispositivo");
				
				if (r==true)
  				{
  					document.fingreso.submit();
  				}
				else
 				{
  					return 0;
  				}
			}
			
			function showtabla(e,n,v)
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
  				
					xmlhttp.open("GET", "gets/getregistro.php?u="+n+"&i="+v, true);
					xmlhttp.send();
					return false;
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
	
	<body>
	
		<? include("includes/header.php"); ?>
		
		<fieldset style='border:1px solid #000099'>
		<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Consulta - Modificar Equipo</strong></i></div></td></tr></table>
		</fieldset>		
		
		<br />
		
		<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
		<br /><br />

		

		<!--///////////////////////// 
		/// Equipo a Consultar //////
		//////////////////////////-->
		
		<table border="1" rules="none" cellspacing="5">
			<caption><div style="font-size:15px; text-align:left; color:#000000;"><strong>Campos de Consulta</strong></div></caption>
			<tr><td><e>Serial</e></td> <td><input type="text" name="serial" size="30" maxlength="30" onkeyup="showtabla(event,name,value)"></td><td><t>Presione <img src="imagenes/enter.png" border="0"> para Continuar</t></td></tr>
			<tr><td colspan="3"><HR WIDTH="100%"; color="#A4A4A4"; size="1px";></td></tr>
		
			<tr><td><e>Inmovilizado</e></td> <td><input type="text" name="inv" size="20" maxlength="20" onkeyup="showtabla(event,name,value)"></td> <td><t>Presione <img src="imagenes/enter.png" border="0"> para Continuar</t></td></tr>
		</table> 
		<br /><br />	
		<input type="button" value="Restablecer" name="B2" onclick="resetear()">
		
		<br /><br /><br />
		
		<!-- Se trae la tabla con los datos del equipo consultado -->
		
		<div id="txtHint"></div>
		
		<br /><br />
	
	</body>
</html>