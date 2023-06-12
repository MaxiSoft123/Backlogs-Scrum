<link rel="stylesheet" href="assets/css/estilos.css">
<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Listar Roles</h1>
        <img src="assets/Iconos/roles2.svg" alt="">
    </div>
    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Rol</th>
                        <th>Permisos</th>
                        <th>Fecha de creación</th>
                        <th>Estado</th>
                        <th>modificar</th>
                        <th>Desactivar</th>
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
        ....
    </div>
    <br><br>
    <div class="Boton">
        <button class="BotonVerde" onclick="ModificarRol()">Aceptar</button>
        <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
    </div>
</dialog>
<script>
    $(document).ready(function() {
        ListarRoles();
    });
</script>