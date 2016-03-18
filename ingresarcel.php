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
			
			function resetear()
			{
				document.fingreso.reset();	
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
				
				r=confirm("Esta seguro que desea ingresar este nuevo dispositivo");
				
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
	
	<body>
		 
		<? include("includes/header.php"); ?>

		<fieldset style='border:1px solid #000099'>
		<table border="0" align="center"><tr><td><div style="text-align:center; font-size:15px;"><strong>Ingreso de Nuevo Equipo al Inventario</strong></i></div></td></tr></table>
		</fieldset>		
		
		<br />
		
		
		<div style="text-align:right"><a href='principal.php'><img src="imagenes/volver.png" name="imagenvolver" border="0" onmouseover="volverfocus()" onmouseout="volversinfocus()" title="Volver"></a></div>
		<br /><br />
			
		<table border="5" align="center" rules="none" cellspacing="5">
		<td>
		
		<br />		
		
		<FORM METHOD="post" NAME="fingreso" ACTION="procesaringreso.php">

			<!--///////////////////////////// 
			/// Campo Serial de Equipo //////
			//////////////////////////////-->
					
			
			<e>Serial</e> <o>*</o> <input type="text" name="serial" size="30" maxlength="30"><br /><br />
			
			<!--///////////////////////////////////
			/// Campo numero del dispositivo //////
			////////////////////////////////////-->		
			
			<e>Numero Telef&oacute;nico</e> <input type="text" name="numero" size="15" maxlength="12"><br /><br />
			
			<!--////////////////////////////////
			/// Campo Tipo de Dispositivo //////
			/////////////////////////////////-->			
			
			<e>Tipo de Dispositivo</e> <o>*</o> <select size="1" name="tipo_disp">
			<option selected value="">Seleccione una Opci&oacute;n</option>
			<option value="Celular">Celular</option>
			<option value="Telefono Fijo">Telefono Fijo</option>
			<option value="Telefono Inalambrico">Telefono Inalambrico</option>
			<option value="Modem Inalambrico">Modem Inalambrico</option>
			</select><br /><br />
			
			<!--/////////////////////////////////////
			/// Campo Operador del Dispositivo //////
			//////////////////////////////////////-->		
			
			<e>Operador</e><br /><br />

			<blockquote>

			<t>CANTV</t><input type="radio" value="CANTV" name="operador">

			<t>Movilnet</t><input type="radio" value="Movilnet" name="operador">
				
			<t>Movistar</t><input type="radio" value="Movistar" name="operador">
				
			<t>Digitel</t><input type="radio" value="Digitel" name="operador"><br /><br />

			</blockquote> 
			
			<!--///////////////////////////////
			/// Campo Tipo de Tecnologia //////
			////////////////////////////////-->	
			
			<e>Tecnolog&iacute;a</e> <o>*</o><br /><br />

			<blockquote>

				<t>GSM</t><input type="radio" checked value="GSM" name="tecnologia">
				
				<t>CDMA</t><input type="radio" value="CDMA" name="tecnologia"><br /><br />

			</blockquote>
			
			<!--//////////////////////////////////
			/// Campo Marca del Dispositivo //////
			///////////////////////////////////-->
			
			<e>Marca del Dispositivo</e> <o>*</o> <select size="1" name="marca">
			<option selected value="">Seleccione una Opci&oacute;n</option>
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
			</select><br /><br />
			
			<!--///////////////////////////////////
			/// Campo Modelo del Dispositivo //////
			////////////////////////////////////-->
			
			<e>Modelo</e> <o>*</o> <input type="text" name="modelo" size="30" maxlength="20"><br /><br />
			
			<!--/////////////////////////////////
			/// Campo Plan del Dispositivo //////
			//////////////////////////////////-->
			
			<e>Plan del Dispositivo</e> <select size="1" name="plan">
			<option selected value="">Seleccione una Opci&oacute;n</option>
			<option value="Tope de Consumo">Tope de Consumo</option>
			<option value="Pegate con Mas 500 min">Pegate con Mas 500 min</option>
			<option value="Pegate con Mas 1000 min">Pegate con Mas 1000 min</option>
			<option value="Renta Basica">Renta Basica</option>
			<option value="Mensajes de Voz">Mensajes de Voz</option>
			<option value="Mensajes de Texto">Mensajes de Texto</option>
			</select><br /><br />
			
			<!--//////////////////////////////
			/// Campo Clave del Equipo ///////
			////////////////////////////// -->		
			
			<e>Clave</e> <input type="text" name="clave" size="10" maxlength="10"><br /><br />
			
			<!--//////////////////////////////////
			/// Campo Inventario del Equipo //////
			///////////////////////////////////-->		
			
			<e>Inmovilizado</e> <input type="text" name="inv" size="20" maxlength="20"><br /><br />
			
			<e>Imei</e> <input type="text" name="imei" size="15" maxlength="15"><br /><br />
			
			<e>Sim</e> <input type="text" name="sim" size="20" maxlength="20"><br /><br />
			
			<e>Tipo de Reserva</e> <o>*</o><br /><br />

			<blockquote>

				<t>Nuevo</t><input type="radio" checked value="Nuevo" name="tipreserva">
				
				<t>Recuperado</t><input type="radio" value="Recuperado" name="tipreserva"><br /><br />

			</blockquote>

			<e>Ubicaci&oacute;n del Dispositivo</e> <o>*</o> <select size="1" name="ubicacion">
			<option selected value="">Seleccione una Opci&oacute;n</option>
			<option value="Puerto Ordaz">Puerto Ordaz</option>
			<option value="Caracas">Caracas</option>
			</select><br />		
			

		</FORM>
			
		</td>
		</table>
		
		<br /><br />
		
		<table border="5" align="center" rules="none" cellspacing="5">
			<td>

			<input type="button" name="boton" value="Guardar" onclick="validar_formulario()">
			<input type="button" value="Restablecer" name="B2" onclick="resetear()">
		
			</td>
		</table>		
		
		<br /><br />	
		
	</body>
</html>