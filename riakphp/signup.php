<?php
require_once('web.php');

printHead('Nuevo Usuario');
printHeader();
?>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
<?php
          printWidgetNewUser();
?>
			</div>
			<div class="col-md-3">
				<div class="panel panel-info">
					<div class="panel-heading text-center">
						Instrucciones
					</div>
					<div class="panel-body">
						<p>Introduzca el usuario y la contraseña.</p>
						<p>Si el usuario no existe, se almacenará en la base de datos de la aplicación.</p>
						<p>El texto se guardara en la cuenta del usuario, si el usuario esta registrado.</p>
					</div>
				</div>
			</div>
		</div>
<?php
printFooter();
?>