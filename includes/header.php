<!-- Sistema de Manejo de Inventario.
Copyright (C) 2010 Adalberto Adrian

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
-->

<?php
$week_days = array ("Domingo", "Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "S&aacute;bado");  
$months = array ("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
$year_now = date ("Y");  
$month_now = date ("n");  
$day_now = date ("j");  
$week_day_now = date ("w");  
$date = "<strong>" .$week_days[$week_day_now] . ", </strong>" . $day_now . " de " . $months[$month_now] . " de " . $year_now;
?>

<img class="izq" src="imagenes/gobierno2.jpg">
<img class="der" src="imagenes/bicentenario.jpg">
<br /><br /><br />
<HR WIDTH="100%"; color="#FF0000"; size="5px";>
<img class="izq" src="imagenes/logo_corpoelec_nuevo.jpg">
<img class="der" src="imagenes/logo_edelca_nuevo.jpg">
<br /><br /><br /><br />
<HR WIDTH="100%"; color="#D8D8D8"; size="22px";>
<div style="position:absolute; left:20px; top:175px; font-size:12px; text-align:left; color:#000099; font-style:italic;"><?php echo $date ?></div>
<div style="position:absolute; right:20px; top:170px";><a href="?salir"><e>Salir Usuario: <?php echo $_SESSION['usuario'] ?> </e><img src="imagenes/exit.png"; border="0"></a></div>
<?php echo"<div style='text-align:right;'><t><strong>Bienvenido(a):</strong> ". $_SESSION['datos'] ."</t></div>" ?>

<h1>Departamento de Administraci&oacute;n de Servicios de Telem&aacute;tica</h1>
<HR WIDTH="100%"; color="#FF0000";>
<center><img src="imagenes/sismin.png" alt="sismin" ></center>
<br /><br />
