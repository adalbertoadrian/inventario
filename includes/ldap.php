<?php

//Esta función requiere tener instalado el paquete php5-ldap//

// Variables LDAP
$servidor_ldap = "ldap-pzo";  // el servidor LDAP al que se quiere conectar
$puerto_ldap = 389;         		// el puerto al que se conectara
$usr = $_POST['login'];				// el usuario
$pwr = $_POST['password'];			// la contraseña

$atributos = array ("uid","mail","cn","maildrop","telephonenumber","employeenumber","userPassword","dn");
$dn = "ou=Usuarios,o=EDELCA,dc=cvgedelca,dc=ve";
$usuario="(uid=".$usr.")";

//Realiza la prueba de conexión al servidor ldap
$conexion_ldap = ldap_connect("ldap://".$servidor_ldap."", $puerto_ldap) or die ("No ha sido posible conectarse al servidor ".$servidor_ldap."en el puerto ".$puerto_ldap."");

//si la conexión es efectiva realiza el proceso de autentificación
if ($conexion_ldap) {

	$ldapget = @ldap_search($conexion_ldap,$dn,$usuario,$atributos);
	$ldapcat = @ldap_get_entries($conexion_ldap,$ldapget);
	$candidato = $ldapcat[0]["dn"];

	if (@ldap_bind($conexion_ldap,$candidato,$pwr)) {
		$conecto = 1;
		$_SESSION['datos'] = $ldapcat[0]['cn'][0];
	}
	else
	{
		$conecto = 0;
	}

	@ldap_close($conexion_ldap);
}

?>
