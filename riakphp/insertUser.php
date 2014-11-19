<?php
require_once 'app.php';

$usuario = $_POST["usuario"];
echo $usuario.'<br>';
$password = $_POST["password"];
echo $password.'<br>';

if(crearUsuario($usuario,$password)){
	//echo 'usuario insertado';
	header('Location: selectRwits.php?usuario='.$usuario);
	die;
}
else {
	header('Location: errorUser.php');
	die;
}
?>