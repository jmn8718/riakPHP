<?php
require_once 'app.php';

function crearUsuarios($inicio, $cantidad){
	$formatoUsuario = 'user%1$04d';
	$formatoPassword = 'key%1$04d';

	for($i=$inicio;$i<$cantidad;$i++){
		$usuario = sprintf($formatoUsuario, $i);
		$password = sprintf($formatoPassword, $i);
		if(crearUsuario($usuario,$password))
			print('usuario '.$usuario.' insertado correctamente<br>');
		else
			print('usuario '.$usuario.' no se ha insertado<br>');
	}
}

function crearRwits($cantidad){
	$formatoUsuario = 'user%1$04d';
	$formatoPassword = 'key%1$04d';

	for($i=0;$i<$cantidad;$i++){
		$us = mt_rand(1, 49);
		$usuario = sprintf($formatoUsuario, $us);
		$password = sprintf($formatoPassword, $us);
		$te = mt_rand(1, 49);
		$texto = 'Pues hace un buen dia para el '.sprintf($formatoUsuario,$te).' by '.$usuario;
		echo $texto;
		//crearUsuario($usuario,$password);
		if(crearRwit($usuario,$password,$texto))
			print("\trwit insertado<br>");
		else
			print("\tno se ha insertado el rwit<br>");
		time_nanosleep(0, 200000000); //0.2 sec
	}
}

print('START!!<br>');
//crearUsuarios(1,50);
crearRwits(150);
print('DONE!!<br>');
?>