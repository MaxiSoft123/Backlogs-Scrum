<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista agendamiento Administrador</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head> 
<div class="ContenedorListar">
        <div class="NombreTabla">
        <h1>Trabajo Pendiente</h1>
        <img src="assets/Iconos/agendamientonegro.svg" alt="">
        </div>
        <main class="table">
        <section class="TableBody">       
            <table class="table">
                <thead>
                <tr>
                <th>Nombre del <br> Empleado</th>
                <th>Nombre del <br> Cliente</th>
                <th>Tipo de Servicio</th>
                <th>Lugar del Servicio</th>
                <th>Telefono</th>
                <th>Fecha/Hora</th>
                <th>Insumos</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Modificar</th>
                <th>Descartar</th>


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
            <button class="BotonVerde" onclick="ModificarAgendamiento()">Aceptar</button>
            <button class="BotonRojo" onclick="cerrarModal()">Cancelar</button>
        </div>
    </dialog>
<script>
	$(document).ready(function() {
		ListarAgendamientoAdministrador();
	});
</script>


