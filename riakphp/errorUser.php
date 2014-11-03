<?php
require_once('web.php');

printHead('Error');
printHeader();
?>
      <div class="row">
        <div class="col-md-7 col-md-offset-1">
			<div class="panel panel-danger">
				<div class="panel-heading">ERROR</div>
				<div class="panel-body">
					<p>Los datos introducidos son incorrectos
					</p>
				</div>
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