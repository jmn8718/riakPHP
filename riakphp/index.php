<?php
require_once('web.php');

printHead('Rwitter');
printHeader();
printMainHeader();
?>
      <div class="row">
        <div class="col-md-6 col-md-offset-2">
			<div class="panel panel-info">			
				<p>Rwitter es una apliación web que permite almacenar en una cuenta de un usuario mensajes de texto.</p>
				<p>Para crear solo necesitar ir a la pagina de <a href="signup.php">sign up</a> y crear un usuario y una contraseña.</p>
				<p>Luego ya podras escribir los mensajes que quieras con ese usuario y esa contraseña.</p>
				<p>Utilizando el campo search de la barra superior, puedes consultar los mensajes de cualquier usuario. Para ello solo necesitas introducir el nombre correspondiente y la aplicación te redirecciona a la pagina correspondiente.</p>
				<p>Si quieres saber algo mas de la aplicación, accede a la pagina <a href="about.php">about</a>.</p>
				<p>Y si lo que quieres es ponerte en contacto, accede a la pagina <a href="contact.php">contact</a>.</p>
			</div>
        </div>
        <div class="col-md-3">
<?php
          printWidgetNewRwit();
?>
        </div>
      </div>
<?php
printFooter();
?>