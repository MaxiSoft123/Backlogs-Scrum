<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Novedades de los empleados</h1>
        <img src="assets/Iconos/novedades2.svg" alt="">
    </div>
    <div class="Boton">
        <button onclick='ListarNovedades(2);' class="BotonAmarillo">En espera</button>
        <button onclick='ListarNovedades(1);' class="BotonVerde">Aceptadas</button>
        <button onclick='ListarNovedades(0);' class="BotonRojo">Rechazadas</button>
    </div>
    <div class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Empleado</td>
                        <td>Fecha</td>
                        <td>Petición</td>
                        <td>Descripción</td>
                        <td>Desde el dia</td>
                        <td>Hasta el dia</td>
                        <td>Desde la hora</td>
                        <td>Hasta la hora</td>
                        <td>Estado</td>
                        <td>Operaciones</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
    </div>
</div>

<!-- MODAL -->
<dialog id="modal" class="form_registrar_novedad">
    <div class="modal-body">
        ...
    </div>
    <center>
        <br>
        <button class="BotonVerde" onclick="AceptarRechazarNovedad()">SI</button>
        <button class="BotonRojo" onclick="CerrarModal()">NO</button>
    </center>
</dialog>

<!-- JAVASCRIPT -->
<script>
    $(document).ready(function() {
        ListarNovedades(2);
    });
</script>