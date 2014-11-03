<?php
require_once'web.php';
require_once 'app.php';

$usuario = $_GET["usuario"];

printHead($usuario);
printHeader();
?>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
<?php

$rtwits = obtenerRtwits($usuario);
if($rtwits){
	foreach($rtwits as $rtwit){
?>
		<div class="panel panel-info">
			<div class="panel-body">
<?php
	print($rtwit['texto']);
?>
			</div>
			<div class="panel-footer">
<?php
	print($rtwit['fecha']);
?>
			</div>
		</div>	
<?php
	}
}
else {
	print('<h2>Lo lamentamos, pero este usuario aun no ha escrito nada</h2>');
}
?>
		</div>
		<div class="col-md-3">
<?php
printWidgetNewRwit();
?>
		</div>
<?php
printFooter();
?>