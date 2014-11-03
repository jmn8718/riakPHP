<?php
require_once 'app.php';

$usuario = $_POST["usuario"];
echo $usuario.'<br>';
$password = $_POST["password"];
echo $password.'<br>';
$texto = $_POST["texto"];
echo $texto.'<br>';

if(crearRtwit($usuario,$password,$texto)){
	//echo 'rtwit insertado';
	header('Location: selectRtwits.php?usuario='.$usuario);
	die;	
}
else {
	header('Location: errorUser.php');
	die;	
}	
?>