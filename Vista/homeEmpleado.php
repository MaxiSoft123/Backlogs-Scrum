<?php

session_start();

if (isset($_SESSION['sesion_iniciada']) == true && $_SESSION['Estado'] == 1 && $_SESSION['Permiso'] == 0) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Maxisoft</title>
		<link rel="stylesheet" href="assets/css/estilos.css">
		<link rel="shortcut icon" href="assets/img/MaxiwifiLogo.png" />
	</head>

	<body>
		<div class="header"></div>
		<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
		<label for="openSidebarMenu" class="sidebarIconToggle">
			<div class="spinner diagonal part-1"></div>
			<div class="spinner horizontal"></div>
			<div class="spinner diagonal part-2"></div>
		</label>

		<!-- barra lateral -->
		<div id="sidebarMenu">
			<div class="padre">
				<div class="sidebar">
					<ul class="menu">
						<img src="Assets/Img/MaxiwifiLogo.png" alt="logo" class="logo">
						<li class="menu-item">
							<a href="#"><?php echo $_SESSION["Nombre"] . "<br>" . $_SESSION["NombrePermiso"]; ?></a>
						</li>
						<li class="menu-item">
							<a href="homeEmpleado.php"><img src="Assets/Iconos/home.svg" alt="" class="IconoBarraLateral">Home</a>
						</li>
						<?php if ($_SESSION['Permisos'][0] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/novedades.svg" alt="" class="IconoBarraLateral">Novedades</a>
								<ul class="submenu">
									<li><a href="#" onclick='Metodo("Particiones/MisNovedades.php")'>Mis novedades</a></li>
									<li><a href="#" onclick='Metodo("Particiones/AñadirNovedad.php")'>Añadir Novedad</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][1] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/prestamos.svg" alt="" class="IconoBarraLateral">Préstamos</a>
								<ul class="submenu">
									<li><a onclick='Metodo("Particiones/ListarPrestamoEmpleado.php")' href="#">Listar Préstamos Empleado</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][2] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/agendamiento.svg" alt="" class="IconoBarraLateral">Agendamiento</a>
								<ul class="submenu">
									<li><a href="#" onclick='Metodo("Particiones/ListarAgendamientoEmpleado.php")'>Listar Agendamiento</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<hr>
						<li class="menu-item">
							<a href="#"><img src="Assets/Iconos/ajustes.svg" alt="" class="IconoBarraLateral">Ajustes</a>
						</li>
						<li class="menu-item">
							<a href="../Controlador/CerrarSesion.php"><img src="Assets/Iconos/cerrar sesion.svg" alt="" class="IconoBarraLateral">Cerrar sesión</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Contenido de pagina -->
		<div class="content-wrapper" id="main-content">
			<section class="ContenedorContenido">
				<div id="qCarga" class="Contenido">
					<div class="ContenedorSaludo">
						<h1>Que bueno verte de nuevo, <?php echo $_SESSION["Nombre"] ?></h1>
						<img src="assets/img/undraw_hello_re_3evm.svg" alt="">
					</div>
				</div>
			</section>
		</div>
	</body>

	</html>

	</thead>
	</table>
	</div>
	</div>

	<!-- fin contenido de la pagina -->

	<!-- Scripts -->
	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/Main.js"></script>
	<script src="assets/js/Agendamiento.js"></script>
	<script src="assets/js/Servicio.js"></script>
	<script src="assets/js/Prestamo.js"></script>
	<script src="assets/js/Novedad.js"></script>
	</body>

	</html>
<?php

} else if (isset($_SESSION['sesion_iniciada']) == true && $_SESSION['Estado'] == 0) {
	echo '<p>No estas autorizado para usar el software</p>
	<h6>Comunicate con el adminisrador para dar solución</h6><br>
	<a href="../Controlador/cerrarsesion.php" class="nav__link">Inisiar Sesion</a>';
} else if (isset($_SESSION['sesion_iniciada']) == true && $_SESSION['Permiso'] == 1) {
	echo '<p>No estas autorizado para Estar acá</p>
	<h6>Comunicate con el adminisrador para dar solución</h6><br>
	<a href="../Controlador/cerrarsesion.php" class="nav__link">Inisiar Sesion</a>';
} else {
	echo 'No as iniciado session <br>
	<a href="../Controlador/cerrarsesion.php" class="nav__link">Inisiar Sesion</a>';
}
?>