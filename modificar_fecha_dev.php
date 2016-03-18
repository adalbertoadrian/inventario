<?php
include("includes/autentificado.php"); 
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript">
			var r;
			var dian;
  			var mesn;
  			var anon;
			var diaa;
  			var mesa;
  			var anoa;
  			var fechaa;
  			var fechan;
  			
  			function validar_formulario()
  			{
  				dian = document.fecha.dia.value;
  				mesn = document.fecha.mes.value;
  				anon = document.fecha.ano.value;
  				diaa = document.fecha.diaoculto.value;
  				mesa = document.fecha.mesoculto.value;
  				anoa = document.fecha.anooculto.value;

 				fechaa = new Date();
 				fechaa.setFullYear(anoa,mesa,diaa);
 				fechan = new Date();
 				fechan.setFullYear(anon,mesn,dian);
 				if(fechaa>fechan)
				{
					alert("La Fecha de Devolucion debe ser Mayor o Igual a la Fecha Actual");
					return 0;
				}
					
				r=confirm("Esta seguro que desea modificar este prestamo");
				
				if (r==true)
				{
					document.fecha.submit();
				}
				else
 				{
  					return 0;
  				}
  			}
  		</script>		
	</head>

	<style type="text/css">
		select {
			border:1px solid Silver;
			font-family:Verdana;
			font-size:12px;
		}	
	</style>	
	
	<body>
	<?php

	$valor=$_GET["v"];

	include("includes/conecta.php"); 
	mysql_query("SET NAMES utf8");
				
	$result = mysql_query("SELECT d.tipo_disp, d.operador, d.marca, d.modelo, d.ubicacion, d.entregado, d.serial, e.condicion, e.desc_entrega, DATE_FORMAT(e.fecha, '%d-%m-%Y') AS fecha, DATE_FORMAT(e.fechadev, '%d-%m-%Y') AS fechadev, u.cedula, u.nombre, u.apellido, u.uo FROM dispositivos AS d INNER JOIN (entregados AS e INNER JOIN usuarios AS u ON e.cedula=u.cedula) ON d.serial=e.serial WHERE d.serial = '".$valor."'");
	
	?>
	
	<FORM METHOD="post" NAME="fecha" ACTION="procesar_modificarfecha.php">

	<table border="1" align="center" rules="none">
	<caption><strong><t>Datos del Prestamo</t></strong></caption>
	<tr bgcolor="#CECEF6">
	<th><div style="font-size:12px; color:#000000;">Serial</div></th>
	<th><div style="font-size:12px; color:#000000;">Tipo<br />Dispositivo</div></th>
	<th><div style="font-size:12px; color:#000000;">Operador</div></th>
	<th><div style="font-size:12px; color:#000000;">Marca</div></th>
	<th><div style="font-size:12px; color:#000000;">Modelo</div></th>
	<th><div style="font-size:12px; color:#000000;">Ubicación</div></th>
	<th><div style="font-size:12px; color:#000000;">Nombre</div></th>
	<th><div style="font-size:12px; color:#000000;">Apellido</div></th>
	<th><div style="font-size:12px; color:#000000;">Fecha<br />Entrega</div></th>
	<th><div style="font-size:12px; color:#000000;">Fecha<br />Devolución</div></th>			
	</tr>
	
	<?php
					
	while($row = mysql_fetch_array($result)) 
	{					  	
	  	echo "<tr align='center'>";
  		echo "<td><t>" . $row['serial'] . "</t></td>";
  		echo "<td><t>" . $row['tipo_disp'] . "</t></td>";
  		echo "<td><t>" . $row['operador'] . "</t></td>";
  		echo "<td><t>" . $row['marca'] . "</t></td>";
  		echo "<td><t>" . $row['modelo'] . "</t></td>";
  		echo "<td><t>" . $row['ubicacion'] . "</t></td>";
  		echo "<td><t>" . $row['nombre'] . "</t></td>";
  		echo "<td><t>" . $row['apellido'] . "</t></td>";
  		echo "<td><t>" . $row['fecha'] . "</t></td>";
  		echo "<td><t>" . $row['fechadev'] . "</t></td>";
  		echo "</tr>";
  		echo "<tr><td colspan='10'><br /><br /></td></tr>
  		<tr bgcolor='#CECEF6'><td colspan='10'><div style='font-size:12px; color:#000000; text-align:center;'><strong>Descripción del Prestamo</strong></div></td></tr>";
  		echo "<tr align='center'>";
  		echo "<td colspan='10'><t>" . $row['desc_entrega'] . "</t></td>";
  		echo "</tr>";
  		
  		echo "<input type='hidden' name='serialoculto' value='".$row['serial']."' />";	
	}
	echo "</table>";
	
	echo "<br /><br /";
	
	mysql_close($con);
	
	$day_now = date ("j");
	echo "<input type='hidden' name='diaoculto' value='".$day_now."' />"; 
	
	echo "<e>Nueva Fecha de Devolución</e> <o>* </o><select size='1' name='dia'>";		
			
			for ($i=1; $i<=31; $i++) {

				if ($i==$day_now){
					echo "<option selected value='".$day_now."'>".$day_now."</option>";
				}
				else
				{	
					echo "<option value='".$i."'>".$i."</option>";
				} 
			} 					
				
			echo "</select>";
			
			///////////////////
			/// Mes Entrega ///			
			////////////////-->
			
			$mes_now = date ("n");
			echo "<input type='hidden' name='mesoculto' value='".$mes_now."' />";	
			
			echo "<select size='1' name='mes'>";	
			
			for ($i=1; $i<=12; $i++) {

				if ($i==$mes_now){
					echo "<option selected value='".$mes_now."'>".$mes_now."</option>";
				}
				else
				{	
					echo "<option value='".$i."'>".$i."</option>";
				} 
			} 				
				
			echo "</select>";
			
			//////////////////
			/// Año Entrega //			
			///////////////-->
			
			$ano_now = date ("Y");
			echo "<input type='hidden' name='anooculto' value='".$ano_now."' />";
			
			echo "<select size='1' name='ano'>";
			
			for ($i=$ano_now; $i<=($ano_now + 1); $i++) {

				if ($i==$ano_now){
					echo "<option selected value='".$ano_now."'>".$ano_now."</option>";
				}
				else
				{	
					echo "<option value='".$i."'>".$i."</option>";
				} 
			} 		
				
			echo "</select></FORM>";

	?>
	
	<br /><br />
	
	<input type="button" name="boton" value="Guardar" onclick="validar_formulario()">	
	
	</body>