<?php
include("includes/autentificado.php");

	$dia=$_POST[dia];
	$mes=$_POST[mes];
	$ano=$_POST[ano];
	
	include("includes/conecta.php");
			
	//Modifica los valores en la tabla//	
		
	$sql="UPDATE entregados SET fechadev='".$ano."-".$mes."-".$dia."' WHERE serial = '$_POST[serialoculto]'";
	
	if (!mysql_query($sql,$con))
  	{
  		die('Error Actualizando registro en la tabla entregados: ' . mysql_error());
  	}
  	else
  	{
  		echo "<br /><br /><br /><br /><br /><br />";
		echo '<div style="color:#FF0000; text-align:center; font-family:Arial, Times, serif;">Registro Actualizado con Exito</div>';
		echo '<br /><br /><br />';
  			
		////////////////////////////////////////
		/// Se ingresa el log de la operacion///
		////////////////////////////////////////
				
		$usuario=$_SESSION['usuario'];
		$operacion="cambio fecha de devolucion del equipo con serial ".$_POST[serialoculto];
		$fecha= date ("Y")."-".date ("n")."-".date ("j");
		$hora= strftime("%T",time()); 
			
		$sql="INSERT INTO log (usuario, operacion, fecha, hora) VALUES ('$usuario','$operacion','$fecha','$hora')";
				
		if (!mysql_query($sql,$con))
		{
  			die('Error ingresando registro al LOG: ' . mysql_error());
  		}

  	    mysql_close($con);
  	}
?>