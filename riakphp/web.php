<?php
function printHead($title){
	print('
	<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="description" content="Rtwiter">
				<meta name="author" content="Jose Miguel Navarro">

				<title>'.$title.'</title>
				<!-- Bootstrap core CSS -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
				<!-- Optional theme -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
				<!-- Custom styles for this template -->
				<link href="css/rwitter.css" rel="stylesheet">
			</head>
			<body>
	');
}

function printHeader(){
	print('
		<header>
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">RWITTER</a> 
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="signup.php">Sign Up</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="contact.php">Contact</a></li>
						</ul>
						<form class="navbar-form navbar-right" method="get" action="selectRtwits.php">
							<div class="input-group">
								<div class="input-group-addon">@</div>
								<input type="text" class="form-control" name="usuario" placeholder="Search...">
							</div>
						</form>
					</div>
				</div>
			</nav>
		</header>
		<div class="container-fluid">
	');
}

function printMainHeader(){
	print('
		<div class="blog-header">
			<h1 class="blog-title">Welcome to Rwitter</h1>
			<p class="lead blog-description">
				Powered by <a href="http://basho.com/riak/">Riak</a>.
			</p>
		</div>  
	');
}

function printWidgetNewRwit(){
	print('
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				Nuevo Rwit
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="post" action="insertRtwit.php">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">@</div>
							<input class="form-control" type="text" name="usuario" placeholder="Usuario" required>
						</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
					</div>
					<div class="form-group">
						<textarea class="form-control form" rows="5" type="text" name="texto" required></textarea>
					</div>    
					<div class="form-group">
						<button type="submit" class="btn btn-default btn-lg btn-block">Send</button>
					</div>
				</form>
			</div>
		</div>
	');
}

function printWidgetNewUser(){
	print('
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				Nuevo Usuario
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="post" action="insertUser.php">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">@</div>
							<input class="form-control" type="text" name="usuario" placeholder="Usuario" required>
						</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
					</div>  
					<div class="form-group">
						<button type="submit" class="btn btn-default btn-lg btn-block">Sign Up</button>
					</div>
				</form>
			</div>
		</div>
	');
}

function printFooter(){
	print('
				</div>
				<footer>
					<div class="footer navbar-fixed-bottom">
						Rwitter by <a href="http://twitter.com/jmn8718">@jmn8718</a>
						<a class="navbar-right" href="#">Back to top</a>
					</div>
				</footer>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			</body>
		</html>
	');
}
?>