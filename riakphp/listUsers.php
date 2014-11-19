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

$users = listarUsuarios();
if($users){
	foreach($users as $user){
?>
		<div class="list-group">
			<a href= <?php echo '"selectRwits.php?usuario='.$user->key.'"'; ?> class="list-group-item" > 
				<h3 class="text-info text-center">
					<?php echo $user->key; ?> 
					<span class="badge alert-danger">
						<?php echo $user->value; ?>
					</span>
				</h3>
			</a>
		</div>	
<?php
	}
}
else {
	print('<h2>No hay usuarios</h2>');
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