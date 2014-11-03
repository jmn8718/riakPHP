<?php
require_once('web.php');

printHead('About');
printHeader();
?>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
			<p>Desarrollado por Jose Miguel Navarro Iglesias.</p>
			<p>Utilizando <a href="http://basho.com/riak/">Riak</a> como almacenamiento de los datos.</p>
			<p>Utilizando <a href="http://aws.amazon.com/">Amazon Web Services</a> para el almacenamiento en el Cloud.</p>
        </div>
      </div>
<?php
printFooter();
?>