<?php
include("includes/autentificado.php"); 
?>
<html>	
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		
		<script type="text/javascript">
		
			var r;
			
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
			
			function validar_formulario()
			{ 
				if (document.getElementById("txtHint").innerHTML=="")
				{
					alert("Debe ingresar un equipo a reincorporar");
					return 0;
				}			
				else if (document.freinco.serialoculto.value.length==0)
				{
					alert("Debe ingresar un equipo ha reincorporar");
					return 0;
				}
				
				
				r=confirm("Esta seguro que modificar este dispositivo");
				
				if (r==true)
  				{
  					document.freinco.submit();
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
  				
					xmlhttp.open("GET", "gets/getentregado.php?u="+n+"&i="+v, true);
					xmlhttp.send();
					return false;
				}
			}			
		</script>		
		
	</head>

	<title>
		Sistema de Manejo de Inventario de Equipos de Reserva
	</title>
	
	<style type="text/css">
		select {
			border:1px solid Silver;
			font-family:Verdana;
			font-size:12px;
		}	
	</style>
	
	<body>

		<?php include("includes/header.php"); ?>

		<fieldset style='border:1px solid #000099'>
		<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Reincorporación de Equipo al Inventario</strong></i></div></td></tr></table>
		</fieldset>		
		
		<br />
		
		<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
		<br /><br />
		
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
