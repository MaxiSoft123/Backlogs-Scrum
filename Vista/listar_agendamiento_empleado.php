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
    <title>Lista agendamiento Empleado</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<div class="ContenedorListar">
        <div class="NombreTabla">
        <h1>Trabajo Pendiente</h1>
        <img src="assets/Iconos/agendamientonegro.svg" alt="">
        </div>
        <main class="table">
        <section class="TableBody">       
            <table>
                <thead>
                <tr>
                <th>Nombre del <br> cliente</th>
                <th>Tipo de Servicio</th>
                <th>Lugar del Servicio</th>
                <th>Telefono</th>
                <th>Fecha/Hora</th>
                <th>Insumos</th>
                <th>Cantidad</th>
                <th>Estado</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
               
            </table>
            </section>
    </main>
    </div>


<script src="Vista/assets/js/main.js"></script>

<script src="Vista/assets/js/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function() {
		listarAgendamiento();
	});
</script>
