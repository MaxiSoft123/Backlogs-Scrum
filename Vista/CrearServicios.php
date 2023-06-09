    
    
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
    <title>Crear Servicio</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <div class="ContenedorAñadir">
        <div class="NombreTabla">
            <h1>Crear Servicio</h1>
            <img src="assets/Iconos/serviciosnegro.svg" alt="">
        </div>
<form action="">
    <p>Nombre del Servicio</p>
    <input type="text" id="NombredelServicio" placeholder="Ingrese nombre del servicio" ><img class="iconosagendamiento" src="icons/cliente.png" alt="">
    <div class="Boton">
    <button class="BotonVerde" onclick="GuardarServicio()">Guardar</button>
    </div>
    </div>
    
</form>
<main class="FormularioAñadir">
    <section class="FormularioBody"></section>
</main>
</body>

<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-3.3.1.min.js"></script>

