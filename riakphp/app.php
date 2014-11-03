<?php
require_once 'riak.php';

function iniciarApp(){
	//crear bucket usuario
	crearBucket(BUCKET_USUARIOS,false);
	//crear bucket rtwits usuarios
	crearBucket(BUCKET_RTWITS,true);
	//crear bucket rtwits anonimos
	crearBucket(BUCKET_ANONIMOS,true);
}

function compobarDatosUsuario($usuario,$password){
	$data = getKValue(BUCKET_USUARIOS,$usuario);
	$value = $data[0]->value;
	echo $value.' | '.$password.'<br>';
	return $value === $password;
}

function existeUsuario($usuario){
	if (hasKey(BUCKET_USUARIOS,$usuario))
		return true;
	else
		return false;
}

function crearUsuario($usuario,$clave){
	if(!existeUsuario($usuario)){
		setKValue(BUCKET_USUARIOS,$usuario,$clave,false);
		return existeUsuario($usuario);
	}
	return false;
}

function crearRtwit($usuario,$password,$texto){
	if(compobarDatosUsuario($usuario,$password)){
		$rtwit = new Rtwit($usuario, $texto);
		$a = $rtwit->toArray();
		print_r($a);
		$resul = setKValue(BUCKET_RTWITS,$usuario,$a,true);
	} else {
		return false;
	}
	return $resul;
}

function obtenerRtwits($usuario){
	if(existeUsuario($usuario)){
		$rtwits = getKValue(BUCKET_RTWITS,$usuario);
		$count = count($rtwits);
		for ($i=0; $i < $count; $i++) {
			$data = $rtwits[$i]->value;
			$resul [] = $data;
		}
		return $resul;
	}
	return null;
}

?>