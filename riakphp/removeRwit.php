<?php
require_once'web.php';
require_once 'app.php';

$usuario = $_GET["usuario"];
$key = $_GET["key"];

printHead($usuario);
printHeader();
?>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
<?php
	if (borrarRwit($usuario,$key)){
?>
			<div class="panel panel-success">
				<div class="panel-heading">EXITO</div>
				<div class="panel-body text-center">
					<p>SE HA BORRADO</p>
				</div>
			</div>
<?php
	} else {
?>
			<div class="panel panel-danger">
				<div class="panel-heading">ERROR</div>
				<div class="panel-body text-center">
					<p>NO SE HA PODIDO BORRAR</p>
				</div>
			</div>
<?php
	}
?>			
			<a href=<?php echo '"selectRwits.php?usuario='.$usuario.'"'; ?> class="list-group-item" > 
				<h3 class="text-center">VOLVER ATRAS</h3>
			</a>
		</div>
		<div class="col-md-3">
<?php
printWidgetNewRwit();
?>
		</div>
<?php
printFooter();
?>