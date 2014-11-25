<?php
require_once 'riak.php';

/**
*Funcion que comprueba si dado el usuario, si su password es correcto.
*Si coincide el password con el almacenado en la BD se devuelve TRUE, en caso contrario se devuelve FALSE.
*/
function compobarDatosUsuario($usuario,$password){
	$data = getKValue(BUCKET_USUARIOS,$usuario);
	/*$value = $data->value;
	echo $value.' | '.$password.'<br>';*/
	return $data->value === $password;
}
/**
*Funcion que comprueba si existe un usuario en la BD.
*Si se encuentra se devuelve TRUE, en caso contrario se devuelve FALSE.
*/
function existeUsuario($usuario){
	if (hasKey(BUCKET_USUARIOS,$usuario))
		return true;
	else
		return false;
}
/**
*Funcion que crea un usuario, y lo inserta en la BD.
*Si se ha insertado correctamente se devuelve TRUE, en caso contrario se devuelve FALSE.
*/
function crearUsuario($usuario,$clave){
	if(!existeUsuario($usuario)){
		setKValue(BUCKET_USUARIOS,$usuario,$clave);
		return existeUsuario($usuario);
	}
	return false;
}
/**
*Funcion que compara los usuarios $a y $b, para saber cual ha escrito mas rwits.
*Se ordena de mayor a menor, para conseguir que los usuarios con mas numero de mensajes primero.
*/
function compararUsuarios($a, $b)
{
    if ($a->value == $b->value) {
        return 0;
    }
    return ($a->value < $b->value) ? 1 : -1;
}
/**
*Funcion que devuelve una lista con los usuarios existentes en la tabla, y el numero de rwits escritos por el usuario;
*/
function listarUsuarios(){
	$usuarios = getKeys(BUCKET_USUARIOS);
	foreach ($usuarios as $usuario) {
		//echo $usuario.'<br>';
		//$rwits = getNumberOfValues($usuario);
		//echo $rwits.'<br>';
		$resul[] = new KValue($usuario, getNumberOfValues($usuario));
	}
	usort($resul, "compararUsuarios");
	return $resul;
}
/**
*Funcion que crea un rtwit, y lo inserta en la BD.
*Si se ha insertado correctamente se devuelve TRUE, en caso contrario se devuelve FALSE.
*/
function crearRwit($usuario,$password,$texto){
	if(compobarDatosUsuario($usuario,$password)){
		$rwit = new Rwit($usuario, $texto);
		return setKValue($usuario,null,$rwit->toArray());
	} 
	return false;
}
/**
*Funcion que compara los elementos $a y $b, para saber cual es mas antiguo según el campo timestamp.
*Se ordena de mayor a menor, para conseguir que los objetos con un timestamp mayor (se han creado despues),
*esten en las primeras posiciones del array, para que se muestren los objetos mas nuevos primero.
*/
function compararRwits($a, $b)
{
    if ($a->value['timestamp'] === $b->value['timestamp']) {
        return 0;
    }
    return ($a->value['timestamp'] < $b->value['timestamp']) ? 1 : -1;
}

/**
*Funcion que devuelve los rtwits de un usuario que se indica en el parametro $usuario.
*Se devuelve un array con los rtwits ordenados de mas nuevos a mas viejos.
*/
function listarRwits($usuario){
	if(existeUsuario($usuario)){
		$keys = getKeys($usuario);
		foreach ($keys as $key) {
			$resul [] = getKValue($usuario,$key);
		}
		usort($resul, "compararRwits"); //ordena el array
		return $resul;
	}
	return null;
}

function borrarRwit($usuario,$key){
	if(existeUsuario($usuario)){
		return removeKey($usuario,$key);
	}
	return false;
}
?>