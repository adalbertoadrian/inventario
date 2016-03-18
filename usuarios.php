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
			
			function imgmod_focus()
			{
				document.imagen_mod.src="imagenes/mod_usuario_in.png";
			}
			
			function imgmod_sinfocus()
			{
				document.imagen_mod.src="imagenes/mod_usuario_out.png";
			}
			
			function resetear()
			{
				document.fingreso.reset();	
			}			
		
			function validar_formulario()
			{ 
				if (document.fingreso.cedula.value.length==0)
				{
					alert("Debe ingresar una cedula");
					document.fingreso.cedula.focus();
					return 0;
				} else if (isNaN(document.fingreso.cedula.value)) {
					alert ("!Error el campo cedula debe ser un valor numerico!");
					document.fingreso.cedula.focus();
					return 0;
				}
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
				
				r=confirm("Esta seguro que desea ingresar este nuevo usuario");
				
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
		<img src="imagenes/ing_usuario_in.png" border="0" title="Ingresar Usuario"> <a href="modif_usuarios.php"><img src="imagenes/mod_usuario_out.png" border="0" name="imagen_mod" onmouseover="imgmod_focus()" onmouseout="imgmod_sinfocus()" title="Modificar Usuario"></a>
		<HR WIDTH="100%"; size="1px";>
		<br /><br />		
		</tr>
		</td>
		<tr>
		<td colspan="2">
				
		<table border="5" align="center" rules="none" cellspacing="5">
		<tr>
		<td>
	
		<br />	
		
		<FORM METHOD="post" NAME="fingreso" ACTION="procesarusuario.php">

			<!--////////////////////////////// 
			/// Campo Cedula de Usuario //////
			///////////////////////////////-->
					
			
			<e>Cedula</e> <o>*</o> <input type="text" name="cedula" size="9" maxlength="9"><br /><br />
			
			<!--///////////////////////////////
			/// Campo Nombre del Usuario //////
			////////////////////////////////-->		
			
			<e>Nombre</e> <o>*</o> <input type="text" name="nombre" size="20" maxlength="20"><br /><br />
			
			<!--/////////////////////////////////
			/// Campo Apellido del Usuario //////
			/////////////////////////////////-->
			
			<e>Apellido</e> <o>*</o> <input type="text" name="apellido" size="20" maxlength="20"><br /><br />			
			
			<!--//////////////////////////
			/// Unidad Organizativa //////
			///////////////////////////-->
			
			<e>Unidad Organizativa</e> <o>*</o> <input type="text" name="uo" size="9" maxlength="9">		

		</FORM>	
		
		
		</td>
		</tr>
		</table>
		
		<br /><br />	
		
		
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