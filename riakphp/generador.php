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

function crearRtwits($cantidad){
	$formatoUsuario = 'user%1$04d';
	$formatoPassword = 'key%1$04d';
	/*$formatoTexto[] = 'El usuario %1$s ha escrito en su muro un rwtit';
	$formatoTexto[] = 'El usuario %1$s ha publicado un rtwit';
	$formatoTexto[] = 'El usuario %1$s se aburre en casa'; 
	$formatoTexto[] = 'caza moscas con el rabo'
	$formatoTexto[] = 'tolon tolon';*/

	for($i=0;$i<$cantidad;$i++){
		$us = mt_rand(1, 49);
		$usuario = sprintf($formatoUsuario, $us);
		$password = sprintf($formatoPassword, $us);
		$te = mt_rand(1, 49);
		$texto = 'Pues hace un buen dia para el '.sprintf($formatoUsuario,$te);//sprintf($formatoTexto[$te], $usuario);
		crearUsuario($usuario,$password);
		if(crearRtwit($usuario,$password,$texto))
			print("rtwit insertado<br>");
		else
			print("no se ha insertado el rtwit<br>");		
		sleep(0.5);
	}
}

//crearUsuarios(10,50);
crearRtwits(150);
?>