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
		echo '<h3 class="text-center">BORRADO CON EXITO</h3><br>';
	} else {
		echo '<h3 class="text-center">NO SE HA PODIDO BORRAR</h3><br>';
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