<?php
$week_days = array ("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");  
$months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
$year_now = date ("Y");  
$month_now = date ("n");  
$day_now = date ("j");  
$week_day_now = date ("w");  
$date = "<strong>" .$week_days[$week_day_now] . ", </strong>" . $day_now . " de " . $months[$month_now] . " de " . $year_now;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="shortcut icon" type="image/icon" href="imagenes/favicon.ico" />
		<meta charset="utf-8">
	</head>

	<title>
		Sistema de Manejo de Inventario de Equipos de Reserva
	</title>

	<body>
		<img class="izq" src="imagenes/gobierno2.jpg">
		<img class="der" src="imagenes/bicentenario.jpg">
		<br /><br /><br />
		<HR WIDTH="100%"; color="#FF0000"; size="5px";>
		<img class="izq" src="imagenes/logo_corpoelec_nuevo.jpg">
		<img class="der" src="imagenes/logo_edelca_nuevo.jpg">
		<br /><br /><br /><br />
		<HR WIDTH="100%"; color="#D8D8D8"; size="22px";>
		<div style="position:absolute; left:20px; top:175px; font-size:12px; text-align:left; color:#000099; font-style:italic;"><?php echo $date ?></div>
		<br />
		<h1>Departamento de Administraci&oacute;n de Servicios de Telem&aacute;tica</h1>
		<HR WIDTH="100%"; color="#FF0000";>
		<center><img src="imagenes/sismin.png" alt="sismin" ></center>
		<br /><br />
		<FORM METHOD="post" ACTION="procesaracceso.php">
			<div style="text-align:center";>
			
				<table align="center" border="1" rules="none" cellspacing="15" bgcolor="#FFFACD">
				
					<tr >
						<td colspan="2" align="left"><t><strong>Ingreso al Sistema</strong></t></td>						
					</tr>
		
					<tr>			
					<td><i><e>Login</e></i></td><td><input type="text" name="login" /></td><br />
					</tr>
					<tr>
					<td><i><e>Password</e></i></td><td><input type="password" name="password" /></td><br />
					</tr>
					
				</table>
					
				<br /><br />
				<input type="image" src="imagenes/login.png" alt="Ingresar">
				<br />
				<t><strong>Ingresar</strong></t>
			</div>
		</FORM>
		<? include("includes/bottom.php"); ?>
	</body>
</html>
