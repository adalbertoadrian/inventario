<?php
include("includes/autentificado.php");
?>
<html>
	<head>
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
			
			function imging_focus()
			{
				document.imagen_inc.src="imagenes/ing_usuario_in.png";
			}
			
			function imging_sinfocus()
			{
				document.imagen_inc.src="imagenes/ing_usuario_out.png";
			}
			
			function resetear()
			{
				location.reload();	
			}
			
			
			function showtabla(e,v)
			{		
				if(e.keyCode==13)
				{
					if (v.length==0)
  					{
  						document.getElementById("txtHint").innerHTML="";
  						return;
  					}
  					if (isNaN(v))
  					{
  						document.getElementById("txtHint").innerHTML="<br /><br /><br /><br /><o><center>!Error el campo cedula debe ser un valor numerico!</center></o><br /><br />";
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
  				
					xmlhttp.open("GET", "gets/getregistrousuario.php?v="+v, true);
					xmlhttp.send();
					return false;
				}
			}
			
			function validar_formulario()
			{ 
				if (document.fingreso.nombre.value.length==0)
				{
					alert("Debe ingresar un nombre");
					document.fingreso.nombre.focus();
					return 0;
				}
				if (document.fingreso.apellido.value.length==0)
				{
					alert("Debe ingresar un apellido");
					document.fingreso.apellido.focus();
					return 0;
				}
				if (document.fingreso.uo.value.length==0)
				{
					alert("Debe ingresar una unidad organizativa");
					document.fingreso.uo.focus();
					return 0;
				}
				
				r=confirm("Esta seguro que desea modificar este usuario");
				
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
	<body>
		<? include("includes/header.php"); ?>
		
		<fieldset style='border:1px solid #000099'>
		<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Ingreso / Modificaci&oacute;n de Usuario</strong></i></div></td></tr></table>
		</fieldset>		
		
		<br />
		
		<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
		<br /><br />
		
		<table border="5" align="center" rules="none" cellspacing="5" width="100%">
			<tr>
			<td>
				<a href="usuarios.php"><img src="imagenes/ing_usuario_out.png" border="0" name="imagen_inc" onmouseover="imging_focus()" onmouseout="imging_sinfocus()" title="Ingresar Usuario"></a> <img src="imagenes/mod_usuario_in.png" border="0" title="Modificar Usuario">
				<HR WIDTH="100%"; size="1px";>
				<br /><br />
			
			</tr>
			</td>
			<tr>
			<td>
				
			<table border="5" align="left" rules="none" cellspacing="5">
			
				<caption><div style="font-size:15px; text-align:left; color:#000000;"><strong>Campos de Consulta</strong></div></caption>
				<tr><td><e>Cedula</e></td> <td><input type="text" name="cedula" size="9" maxlength="9" onkeyup="showtabla(event,value)"></td><td><t>Presione <img src="imagenes/enter.png" border="0"> para Continuar</t></td></tr>

			</table>
		
			<br /><br /><br /><br />
			
			<div id="txtHint"></div>
		
			</td>
			</tr>
		</table>
		
		<br /><br />
		
		<table border="5" align="center" rules="none" cellspacing="5">
			<td>

				<input type="button" name="boton" value="Guardar" onclick="validar_formulario()">
				<input type="reset" value="Restablecer" name="B2" onclick="resetear()">
		
			</td>
		</table>		
		
		<br /><br />		
		
	</body>
</html>