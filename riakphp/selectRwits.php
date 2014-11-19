<?php
require_once 'web.php';
require_once 'app.php';

$usuario = $_GET["usuario"];

printHead($usuario);
printHeader();
?>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
<?php

$rwits = listarRwits($usuario);
//print_r($rwits);
if(count($rwits)>0){
	foreach($rwits as $rwit){
?>
		<div class="panel panel-info">
			<div class="panel-body">
<?php
	print($rwit->value['texto']);
?>
			</div>
			<div class="panel-footer">
<?php
	print($rwit->value['fecha']);
?>
				<a class="btn pull-right" href=<?php echo '"removeRwit.php?usuario='.$usuario.'&key='.$rwit->key.'"'; ?>> 
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
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