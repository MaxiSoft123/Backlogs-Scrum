<?php
include("../Modelo/conexion.php");
session_start();
$id_usuario = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<div class="ContenedorListar">
    <div class="NombreTabla" >
    <h1 class="logoytitulo">Lista de Servicios</h1>
    <img src="assets/Iconos/serviciosnegro.svg" alt="logo">
    </div>
    <main class="table">
        <section class="TableBody">       
            <table class="table">
                    <thead>
                    <tr class="fila_servicios">
                            <th class="encabezado_servicios">Nombre</th class="encabezado_servicios">
                           <th class="encabezado_servicios">  Estado</th class="encabezado_servicios">
                            <th class="encabezado_servicios">Operación</th class="encabezado_servicios">
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                </table>
        </section>
    </main>         
        </div>

        <dialog id="modal">
        <div class="modal-body">

        </div>
        <br><br>
        <div class="Boton">
            <button class="BotonVerde" onclick="ModificarListar()">Aceptar</button>
            <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
        </div>
    </dialog>
    <script src="js/main.js"></script>

<script src="js/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function() {
		ListarServicios();
	});
</script>
