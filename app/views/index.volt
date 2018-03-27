<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<style>
			body {
				font-family: "Segoe UI", sans-serif;
				font-size:100%;
			}

			.sidebar {
				position: fixed;
				height: 100%;
				width: 0;
				top: 0;
				left: 0;
				z-index: 1;
				background-color: #00324b;
				overflow-x: hidden;
				transition: 0.4s;
				padding: 1rem 0;
				box-sizing:border-box;
			}

			.sidebar .boton-cerrar {
				position: absolute;
				top: 0.5rem;
				right: 1rem;
				font-size: 2rem;
				display: block;
				padding: 0;
				line-height: 1.5rem;
				margin: 0;
				height: 32px;
				width: 32px;
				text-align: center;
				vertical-align: top;
			}

			.sidebar ul, .sidebar li{
				margin:0;
				padding:0;
				list-style:none inside;
			}

			.sidebar ul {
				margin: 4rem auto;
				display: block;
				width: 80%;
				min-width:200px;
			}

			.sidebar a {
				display: block;
				font-size: 120%;
				color: #eee;
				text-decoration: none;
				
			}

			.sidebar a:hover{
				color:#fff;
				background-color: #f90;

			}

			h1 {
				color:#f90;
				font-size:180%;
				font-weight:normal;
			}
			#content {
				transition: margin-left .4s;
				padding: 1rem;
			}
		</style>
    </head>
    <body>
        <div class="container">
			<div id="sidebar" class="sidebar">
			<ul class="menu">
				<li><a href="http://localhost/videostoreplus/Classification/search">CLASIFICACI&Oacute;N</a></li>
				<li><a href="http://localhost/videostoreplus/Genre/search">G&Eacute;NERO</a></li>
				<li><a href="http://localhost/videostoreplus/Format/search">FORMATO</a></li>
				<li><a href="http://localhost/videostoreplus/Director/search">DIRECTOR</a></li>
				<li><a href="http://localhost/videostoreplus/Actor/search">ACTOR</a></li>
				<li><a href="http://localhost/videostoreplus/Branchoffice/search">SUCURSAL</a></li>
				<li><a href="http://localhost/videostoreplus/Movie/search">PEL&Iacute;CULA</a></li>
				<li><a href="http://localhost/videostoreplus/Client/search">CLIENTE</a></li>
				<li><a href="http://localhost/videostoreplus/Rent/search">RENTA</a></li>
				<li><a href="http://localhost/videostoreplus/Movie/SWAPI">SWAPI</a></li>
			</ul>
			  
			</div>
			<div id="content">
              {{ content() }}
			</div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<script>
		document.getElementById("sidebar").style.width = "300px";
		document.getElementById("content").style.marginLeft = "300px";
       </script>
    </body>
</html>

