<?php

session_start();

if (isset($_SESSION['sesion_iniciada']) == true && $_SESSION['Estado'] == 1) {
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
							<a href="#"><?php echo $_SESSION["Nombre"] . "<br>" . $_SESSION["NombreRol"]; ?></a>
						</li>
						<li class="menu-item">
							<a href="home.php"><img src="Assets/Iconos/home.svg" alt="" class="IconoBarraLateral">Home</a>
						</li>
						<?php if ($_SESSION['Permisos'][0] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/roles.svg" alt="" class="IconoBarraLateral">Roles</a>
								<ul class="submenu">
									<li><a href="#" onclick='Metodo("ListarRoles.php")'>Listar roles</a></li>
									<li><a href="#" onclick='Metodo("AñadirRoles.php")'>Añadir roles</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][1] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/empleados.svg" alt="" class="IconoBarraLateral">Empleados</a>
								<ul class="submenu">
									<li><a href="#" onclick='Metodo("ListarUsuarioEmpleado.php")'>Listar Empleados</a></li>
									<li><a href="#" onclick='Metodo("AñadirUsuarioEmpleado.php")'>Añadir Empleados</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][2] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/novedades.svg" alt="" class="IconoBarraLateral">Novedades</a>
								<ul class="submenu">
									<li><a href="#">Listar Novedades</a></li>
									<li><a href="#">Añadir Novedades</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][3] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/herramientas e insumos.svg" alt="" class="IconoBarraLateral">Herramientas e insumos</a>
								<ul class="submenu">
									<li><a onclick='Metodo("MasterHerramientas.php")' href="#">Listar Herramientas e insumos</a></li>
									<li><a onclick='Metodo("RegistrarHerramientas.php")' href="#">Añadir Herramientas e insumos</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][4] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/prestamos.svg" alt="" class="IconoBarraLateral">Préstamos</a>
								<ul class="submenu">
									<li><a onclick='Metodo("ListarPrestamoAdmin.php")' href="#">Listar Préstamos</a></li>
									<li><a onclick='Metodo("ListarPrestamoEmpleado.php")' href="#">Listar Préstamos Empleado</a></li>
									<li><a onclick='Metodo("RealizarPrestamo.php")' href="#">Añadir Préstamos</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][5] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/servicios.svg" alt="" class="IconoBarraLateral">Servicios</a>
								<ul class="submenu">
									<li><a onclick='Metodo("ListarServicios.php")' href="#">Listar Servicios</a></li>
									<li><a onclick='Metodo("CrearServicios.php")' href="#">Añadir Servicios</a></li>
								</ul>
							</li>
						<?php
						} ?>
						<?php if ($_SESSION['Permisos'][6] == 1) {
						?>
							<li class="menu-item has-submenu">
								<a href="#"><img src="Assets/Iconos/agendamiento.svg" alt="" class="IconoBarraLateral">Agendamiento</a>
								<ul class="submenu">
									<li><a href="#" onclick='Metodo("ListarAgendamientoEmpleado.php")'>Listar Agendamiento</a></li>
									<li><a href="#" onclick='Metodo("ListarAgendamientoAdmin.php")'>Listar Agendamiento Administrador</a></li>
									<li><a href="#" onclick='Metodo("AgendarServicio.php")'>Añadir Agendamiento</a></li>
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
	<script src="assets/js/HerramientaInsumo.js"></script>
	<script src="assets/js/AgendamientoServicios.js"></script>
	<script src="assets/js/Roles.js"></script>
	<script src="assets/js/UsuarioEmpleado.js"></script>
	<script src="assets/js/Prestamo.js"></script>
	</body>

	</html>
<?php

} else if (isset($_SESSION['sesion_iniciada']) == true && $_SESSION['Estado'] == 0) {
	echo '<p>No estas autorizado para usar el software</p>
	<h6>Comunicate con el adminisrador para dar solución</h6><br>
	<a href="login.php" class="nav__link">Inisiar Sesion</a>';
} else {
	echo 'No as iniciado session <br>
	<a href="login.php" class="nav__link">Inisiar Sesion</a>';
}
?>