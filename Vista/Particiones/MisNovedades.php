<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Mis novedades</h1>
        <img src="assets/Iconos/novedades2.svg" alt="">
    </div>
    <div class="Boton">
        <button onclick='ListarNovedad(2);' class="BotonAmarillo">En espera</button>
        <button onclick='ListarNovedad(1);' class="BotonVerde">Aceptadas</button>
        <button onclick='ListarNovedad(0);' class="BotonRojo">Rechazadas</button>
    </div>
    <div class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Petición</td>
                        <td>Descripción</td>
                        <td>Desde el dia</td>
                        <td>Hasta el dia</td>
                        <td>Desde la hora</td>
                        <td>Hasta la hora</td>
                        <td>Estado</td>
                        <td>Modificar</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </section>
    </div>
</div>

<dialog id="modal" class="form_registrar_novedad">
    <div class="modal-body">
        ...
    </div>
    <center>
        <button class="BotonVerde" onclick="ModificarNovedad()">Registrar</button>
        <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
    </center>
</dialog>

<script>
    $(document).ready(function() {
        ListarNovedad(2);
    });
</script>