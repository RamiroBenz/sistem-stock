<?php 

	$conexion=mysqli_connect("localhost", "root", "root", "simple_stock"); // servidor, usuario, contraseña y Base de datos..

if(!$conexion){
	echo 'Error al conectar la base de datos';
	exit();// Salir si hay un error..

	mysqli_select_db($conexion, "simple_stock") or die("No se encuentra la Base de Datos.."); // Si no encuentra la base de datos tira algo mas descriptivo..
}else{
	echo 'Conectando la base de datos Stock para empezar a operar..';
}



mysqli_set_charset($conexion, "utf8"); // Diccionario Latino..


 ?>
