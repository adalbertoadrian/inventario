<?php 
include("../includes/autentificado.php");  

	$valor=$_GET["i"];
	$campo=$_GET["u"];
	
	//Se conecta a la BD//

	include("../includes/conecta.php");
	mysql_query("SET NAMES utf8");
	
	//Realiza la consulta//

	$result = mysql_query("SELECT operador, tipo_disp, marca, modelo, numero, plan, serial, clave, inv, imei, sim, tecnologia, tipreserva, ubicacion FROM dispositivos WHERE entregado='0' AND ".$campo."='".$valor."'");
	
	while($row = mysql_fetch_array($result))
  	{
		$operador=$row['operador'];
		$tipo_disp=$row['tipo_disp'];
		$marca=$row['marca'];
		$modelo=$row['modelo'];
		$numero=$row['numero'];
		$plan=$row['plan'];
		$serial=$row['serial'];
		$clave=$row['clave'];
		$inv=$row['inv'];
		$imei=$row['imei'];
		$sim=$row['sim'];
		$tecnologia=$row['tecnologia'];
		$tipreserva=$row['tipreserva'];
		$ubicacion=$row['ubicacion'];
	}
	
	mysql_close($con);
?>

<html>
	<body>

	<?php if(mysql_num_rows($result)==0)
	
	//Muestra los datos del equipo en caso de existir el serial ingresado de lo contrario da mensaje de error//
	
	{	
		echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">El Equipo Consultado no se Encuentra Registrado</div>';	
	}	
	else
	{
	?>
	
		<table border="5" align="center" rules="none" cellspacing="5">
			<td>
			<br />
			<div style="text-align:right;"><img src="imagenes/bitacora_out.png" alt="Bitacora" name="bitacora" onmouseover="bitacorain()" onmouseout="bitacoraout()" title="Bitacora" onclick="abrirbitacora()" /></div>
			<br /><br />	
			
			<FORM METHOD="POST" NAME="fingreso" ACTION="procesarmodificacion.php">

			<!--///////////////////////////// 
			/// Campo Serial de Equipo //////
			//////////////////////////////-->
					
			
			<e>Serial</e> <o>*</o> <input type="text" name="serial" size="30" value="<?php echo $serial; ?>" readonly="readonly"><br /><br />
			
			<!--///////////////////////////////////
			/// Campo numero del dispositivo //////
			////////////////////////////////////-->		
			
			<e>Numero Telef&oacute;nico</e> <input type="text" name="numero" size="15" value="<?php echo $numero; ?>" maxlength="12"><br /><br />
			
			<!--////////////////////////////////
			/// Campo Tipo de Dispositivo //////
			/////////////////////////////////-->			
			
			<e>Tipo de Dispositivo</e> <o>*</o> <select size="1" name="tipo_disp">
				<?php if($tipo_disp=='') { echo "<option selected value=''>Seleccione una Opci&oacute;n</option>"; } ?>
				<option <?php if($tipo_disp=='Celular') { echo "selected"; } ?> value='Celular'>Celular</option>
				<option <?php if($tipo_disp=='Telefono Fijo') { echo "selected"; } ?> value='Telefono Fijo'>Telefono Fijo</option>
				<option <?php if($tipo_disp=='Telefono Inalambrico') { echo "selected"; } ?> value='Telefono Inalambrico'>Telefono Inalambrico</option>
				<option <?php if($tipo_disp=='Modem Inalambrico') { echo "selected"; } ?> value='Modem Inalambrico'>Modem Inalambrico</option>
			
			</select><br /><br />
			
			<!--/////////////////////////////////////
			/// Campo Operador del Dispositivo //////
			//////////////////////////////////////-->		
			
			<e>Operador</e><br /><br />

			<blockquote>
			
				<t>CANTV</t><input type='radio' value='CANTV' <?php if($operador=='CANTV') { echo "checked"; } ?> name='operador'>
				<t>Movilnet</t><input type='radio' value='Movilnet' <?php if($operador=='Movilnet') { echo "checked"; } ?> name='operador'>
				<t>Movistar</t><input type='radio' value='Movistar' <?php if($operador=='Movistar') { echo "checked"; } ?> name='operador'>
				<t>Digitel</t><input type='radio' value='Digitel' <?php if($operador=='Digitel') { echo "checked"; } ?> name='operador'>
				
				<br /><br />

			</blockquote> 
			
			<!--///////////////////////////////
			/// Campo Tipo de Tecnologia //////
			////////////////////////////////-->	
			
			<e>Tecnolog&iacute;a</e> <o>*</o><br /><br />

			<blockquote>
			
				<t>GSM</t><input type='radio' value='GSM' <?php if($tecnologia=='GSM') { echo "checked"; } ?> name='tecnologia'>
				<t>CDMA</t><input type='radio' value='CDMA' <?php if($tecnologia=='CDMA') { echo "checked"; } ?> name='tecnologia'>

				<br /><br />

			</blockquote>
			
			<!--//////////////////////////////////
			/// Campo Marca del Dispositivo //////
			///////////////////////////////////-->
			
			<e>Marca del Dispositivo</e> <o>*</o> <select size="1" name="marca">
			
				<?php if($marca=='') { echo "<option selected value=''>Seleccione una Opci&oacute;n</option>"; } ?>
				<option <?php if($marca=='BlackBerry') { echo "selected"; } ?> value='BlackBerry'>BlackBerry</option>
				<option <?php if($marca=='HTC') { echo "selected"; } ?> value='HTC'>HTC</option>
				<option <?php if($marca=='Nokia') { echo "selected"; } ?> value='Nokia'>Nokia</option>
				<option <?php if($marca=='Merlin') { echo "selected"; } ?> value='Merlin'>Merlin</option>
				<option <?php if($marca=='Motorola') { echo "selected"; } ?> value='Motorola'>Motorola</option>
				<option <?php if($marca=='Huawei') { echo "selected"; } ?> value='Huawei'>Huawei</option>
				<option <?php if($marca=='Kyocera') { echo "selected"; } ?> value='Kyocera'>Kyocera</option>
				<option <?php if($marca=='LG') { echo "selected"; } ?> value='LG'>LG</option>
				<option <?php if($marca=='Startel') { echo "selected"; } ?> value='Startel'>Startel</option>
				<option <?php if($marca=='Siemens') { echo "selected"; } ?> value='Siemens'>Siemens</option>
			
			</select><br /><br />
			
			<!--///////////////////////////////////
			/// Campo Modelo del Dispositivo //////
			////////////////////////////////////-->
			
			<e>Modelo</e> <o>*</o> <input type="text" name="modelo" size="30" value="<?php echo $modelo; ?>" maxlength="20"><br /><br />
			
			<!--/////////////////////////////////
			/// Campo Plan del Dispositivo //////
			//////////////////////////////////-->
			
			<e>Plan del Dispositivo</e> <select size="1" name="plan">
				<?php if($plan=='') { echo "<option selected value=''>Seleccione una Opci&oacute;n</option>"; } ?>
				<option <?php if($plan=='Tope de Consumo') { echo "selected"; } ?> value='Tope de Consumo'>Tope de Consumo</option>
				<option <?php if($plan=='Pegate con Mas 500 min') { echo "selected"; } ?> value='Pegate con Mas 500 min'>Pegate con Mas 500 min</option>
				<option <?php if($plan=='Pegate con Mas 1000 min') { echo "selected"; } ?> value='Pegate con Mas 1000 min'>Pegate con Mas 1000 min</option>
				<option <?php if($plan=='Renta Basica') { echo "selected"; } ?> value='Renta Basica'>Renta Basica</option>
				<option <?php if($plan=='Mensajes de Voz') { echo "selected"; } ?> value='Mensajes de Voz'>Mensajes de Voz</option>
				<option <?php if($plan=='Mensajes de Texto') { echo "selected"; } ?> value='Mensajes de Texto'>Mensajes de Texto</option>
			
			</select><br /><br />
			
			<!--//////////////////////////////
			/// Campo Clave del Equipo ///////
			////////////////////////////// -->		
			
			<e>Clave</e> <input type="text" name="clave" size="10" value="<?php echo $clave; ?>" maxlength="10"><br /><br />
			
			<!--//////////////////////////////////
			/// Campo Inventario del Equipo //////
			///////////////////////////////////-->		
			
			<e>Inmovilizado</e> <input type="text" name="inv" size="20" value="<?php echo $inv; ?>" maxlength="20"><br /></br>
			
			<e>Imei</e> <input type="text" name="imei" size="15" value="<?php echo $imei; ?>" maxlength="15"><br /><br />
			
			<e>Sim</e> <input type="text" name="sim" size="20" value="<?php echo $sim; ?>" maxlength="20"><br /><br />
			
			<e>Tipo de Reserva</e> <o>*</o><br /><br />
			
			<blockquote>
			
					<t>Nuevo</t><input type='radio' value='Nuevo' <?php if($tipreserva=='Nuevo') { echo "checked"; } ?> name='tipreserva'>
					<t>Recuperado</t><input type='radio' value='Recuperado' <?php if($tipreserva=='Recuperado') { echo "checked"; } ?> name='tipreserva'>

				<br /><br />

			</blockquote>
			
			<e>Ubicaci&oacute;n del Dispositivo</e> <o>*</o> <select size="1" name="ubicacion">
			
				<?php if($ubicacion=='') { echo "<option selected value=''>Seleccione una Opci&oacute;n</option>"; } ?>
				<option <?php if($ubicacion=='Puerto Ordaz') { echo "selected"; } ?> value='Puerto Ordaz'>Puerto Ordaz</option>
				<option <?php if($ubicacion=='Caracas') { echo "selected"; } ?> value='Caracas'>Caracas</option>
			
			</select><br />		
			
			</FORM>			
			</td>
			
		</table>	
			
		<br /><br />			
			
		<table border="5" align="center" rules="none" cellspacing="5">
			<td>

			<input type="button" name="boton" value="Guardar" onclick="validar_formulario()">
			
			</td>
		</table>		
	<?php } ?>	
	</body>
</html>