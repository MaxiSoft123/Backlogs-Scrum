    
    
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
    <title>Agendar Nuevo Servicio</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <div class="ContenedorAñadir">
        <div class="NombreTabla">
            <h1>Agendar Servicio</h1>
            <img src="assets/Iconos/agendamientonegro.svg" alt="">
        </div>
<form action="">
    <p>Nombre Cliente</p>
    <input type="text" id="nombreCliente" placeholder="Ingrese nombre del cliente" ><img class="iconosagendamiento" src="icons/cliente.png" alt="">
    <p>Nombre del Empleado</p>
    <select  name="nombre" id="Empleado" >
    </select>
    <p>Telefono del Cliente</p>
    <input  type="text" id="telefono" placeholder="Ingrese telefono" ><img class="iconosagendamiento" src="icons/telefono.png" alt="">
    <p>Fecha</p>
    <input type="date" id="fecha" placeholder="Ingrese fecha" ><img class="iconosagendamiento" src="icons/calendario.png" alt="" >
    <p>Hora</p>
    <input  type="time" id="hora" placeholder="Ingrese hora" ><img class="iconosagendamiento" src="icons/reloj-de-pared.png" alt="">
    <p>Direccion de la solicitud</p>
    <input type="text" id="direccion" placeholder="Ingrese direccion"><img src="icons/casa.png" alt="" style="height:27px;margin-left:11px;">
    <p>Tipo de Servicio</p>
    <select class ="ContenedorAñadirselect"   name="inputselect" name="nombre" id="Servicios" >
    </select>
    <p>Insumos</p>
    <select class ="ContenedorAñadirselect" name="inputselect" name="nombre" id="Insumos" >
    </select>
    <P>Cantidad de Insumos</P>
    <input  type="text" id="cantidadInsumo" placeholder="Ingrese cantidad del insumo"><img class="iconosagendamiento" src="icons/ordenar-cantidad-ascendente.png" alt="" >
    <p>Descripcion</p>
    <input type="text" id="Descripcion" placeholder="Ingrese una descripcion"><img class="iconosagendamiento" src="icons/editar-informacion.png" alt="" >
    <div class="Boton">
    <button class="BotonVerde" onclick="guardarAgendamiento()">Agendar</button>
    </div>
    </div>
    
</form>
<main class="FormularioAñadir">
    <section class="FormularioBody"></section>
</main>
</body>

<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function() {
    SelectServicio();
	});
</script>
<script>
	$(document).ready(function() {
    SelectInsumo();
	});
</script>
<script>
	$(document).ready(function() {
    SelectEmpleado();
	});
</script>

