<?php
include("../includes/autentificado.php");

	$diae=$_GET["dia_e"];
	$mese=$_GET["mes_e"];
	$anoe=$_GET["ano_e"];
	$diad=$_GET["dia_d"];
	$mesd=$_GET["mes_d"];
	$anod=$_GET["ano_d"];
	
	//calculo timestam de las dos fechas
	$timestamp1 = mktime(0,0,0,$mese,$diae,$anoe);
	$timestamp2 = mktime(4,12,0,$mesd,$diad,$anod);

	//resto a una fecha la otra
	$segundos_diferencia = $timestamp1 - $timestamp2;


	//convierto segundos en días
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

	//obtengo el valor absoulto de los días (quito el posible signo negativo)
	$dias_diferencia = abs($dias_diferencia);

	//quito los decimales a los días de diferencia
	$dias_diferencia = floor($dias_diferencia);

	echo "<br />";
	echo "<e>Duración del Prestamo: <strong>".$dias_diferencia."</strong> Días</e>";

?>