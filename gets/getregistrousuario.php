<?php 
include("../includes/autentificado.php");  

	$valor=$_GET["v"];
	
	//Se conecta a la BD//

	include("../includes/conecta.php");
	mysql_query("SET NAMES utf8");
	
	//Realiza la consulta//

	$result = mysql_query("SELECT cedula, nombre, apellido, uo FROM usuarios WHERE cedula = '".$valor."'");
	
	while($row = mysql_fetch_array($result))
  	{
		$cedula=$row['cedula'];
		$nombre=$row['nombre'];
		$apellido=$row['apellido'];
		$uo=$row['uo'];
	}
	
	mysql_close($con);
?>

<html>
	<body>
	
	<br /><br /><br /><br />
		
		<?php if(mysql_num_rows($result)==0)
	
	//Muestra los datos del equipo en caso de existir el serial ingresado de lo contrario da mensaje de error//
	
	{	
		echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">La Cedula Consultada no se Encuentra Registrada</div>';	
	}	
	else
	{
	?>
		
		<table border="5" align="center" rules="none" cellspacing="5">
		<tr>
		<td>
		
			
	
		<FORM METHOD="post" NAME="fingreso" ACTION="procesarmodifusuario.php">

			<!--////////////////////////////// 
			/// Campo Cedula de Usuario //////
			///////////////////////////////-->
					
			
			<e>Cedula</e> <o>*</o> <input type="text" name="cedula" size="9" maxlength="9" value="<?php echo $cedula; ?>" readonly="readonly"><br /><br />
			
			<!--///////////////////////////////
			/// Campo Nombre del Usuario //////
			////////////////////////////////-->		
			
			<e>Nombre</e> <o>*</o> <input type="text" name="nombre" size="20" maxlength="20" value="<?php echo $nombre; ?>"><br /><br />
			
			<!--/////////////////////////////////
			/// Campo Apellido del Usuario //////
			/////////////////////////////////-->
			
			<e>Apellido</e> <o>*</o> <input type="text" name="apellido" size="20" maxlength="20" value="<?php echo $apellido; ?>"><br /><br />			
			
			<!--//////////////////////////
			/// Unidad Organizativa //////
			///////////////////////////-->
			
			<e>Unidad Organizativa</e> <o>*</o> <input type="text" name="uo" size="9" maxlength="9" value="<?php echo $uo; ?>">		

		</FORM>
		
		</td>
		</tr>
		</table>
		
		<?php } ?>
		
		<br /><br />	

	</body>
</html>