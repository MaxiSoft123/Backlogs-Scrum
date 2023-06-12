<?php
include("Modelo/conexion.php");
session_start();
$id_usuario = $_SESSION["id"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxisoft</title>
    <link rel="stylesheet" href="css/estilosdetodaslastablss.css">
	<!-- <link rel="stylesheet" href="adminlte.min.css" /> -->
</head>
<body>
<div class="header"></div>
<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
<label for="openSidebarMenu" class="sidebarIconToggle">
	<div class="spinner diagonal part-1"></div>
	<div class="spinner horizontal"></div>
	<div class="spinner diagonal part-2"></div>
</label>
<div id="sidebarMenu">
	<div class="padre">
		<div class="sidebar">
			<img src="../views/unnamed.png" alt="" class="logo_maxi">
			<br><br>
			<div class="user">
				<div class="cont_u">
					<img href="#" src="../views/icons/hombre.png"
						class="user_img"><br><br>
				</div>
				<div class="cont_n">
					<label for="" class="nombre">Juan Pablo Franco</label>
					<label for="">Empleado</label><br>
				</div>
			</div><br>
			<ul class="list">
				<li class="list__item list__item--click">
					<div class="list__button list__button--click">
						<img src="../views/icons/novedades-icon.png" class="list__img">
						<a href="#" class="nav__link">Novedades</a>
						<img src="../views/assets/arrow.svg" class="list__arrow">
					</div>

					<ul class="list__show">
						<li class="list__inside">
							<a href="#" onclick='metododemrd("listar_agendamiento_empleado.php")' class="nav__link nav__link--inside">Listar
								novedades</a>
						</li>
						<li class="list__inside">
							<a href="#" onclick='metododemrd("anadir_novedad.php")' class="nav__link nav__link--inside">Solicitar
								novedad</a>
						</li>

					</ul>
				</li>

				<li class="list__item list__item--click">
					<div class="list__button list__button--click">
						<img src="../views/assets/docs.svg" class="list__img">
						<a href="#" class="nav__link">Prestamos</a>
						<img src="../views/assets/arrow.svg" class="list__arrow">
					</div>

					<ul class="list__show">
						<li class="list__inside">
							<a href="#" 
								class="nav__link nav__link--inside">Listar herramientas prestadas</a>
						</li>

						<li class="list__inside">
							<a href="#"
								class="nav__link nav__link--inside">Solicitar prestamo de herramientas</a>
						</li>

					</ul>
				</li>

				<li class="list__item list__item--click">
					<div class="list__button list__button--click">
						<img src="../views/assets/bell.svg" class="list__img">
						<a href="#" class="nav__link">Agendamiento</a>
						<img src="../views/assets/arrow.svg" class="list__arrow">
					</div>

					<ul class="list__show">
					<li class="list__inside">
							<a href="#" onclick='metododemrd("listar_agendamiento_empleado.php")' class="nav__link nav__link--inside">Listar Agendamientos
								</a>
						</li>
						<li class="list__inside">
							<a href="#"
								class="nav__link nav__link--inside" onclick='metododemrd("listar_agendamiento_admin.php")' >Listar Agendamientos Administrador</a>
						</li>
						<li class="list__inside">
							<a href="#"
								class="nav__link nav__link--inside" onclick='metododemrd("agendar_servicio.php")' >Agendar Servicio</a>
						</li>
						

					</ul>

				</li>

				<li class="list__item list__item--click">
					<div class="list__button list__button--click">
						<img src="../views/assets/bell.svg" class="list__img">
						<a href="#" class="nav__link">Servicios</a>
						<img src="../views/assets/arrow.svg" class="list__arrow">
					</div>

					<ul class="list__show">
					<li class="list__inside">
							<a href="#" onclick='metododemrd("listar_servicios.php")' class="nav__link nav__link--inside">Listar Servicios
								</a>
						</li>
					</ul>

				</li>

				<li class="list__item list__item--click">
					<div class="list__button list__button--click">
						<img src="../views/assets/bell.svg" class="list__img">
						<a href="#" class="nav__link">Opciones</a>
						<img src="../views/assets/arrow.svg" class="list__arrow">
					</div>

					<ul class="list__show">
						<li class="list__inside">
							<a href="login.php" class="nav__link nav__link--inside">Cerrar sesion</a>
						</li>
					</ul>

				</li>

			</ul>
		</div>
	</div>

	<div class="content-wrapper" id="main-content">
		<section class="content">
		<div id="hola" class="body-text">
 			<div id="qCarga" class="container-fluid">
				









                </div>
			</div> 
		</section>
	</div>
</div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>