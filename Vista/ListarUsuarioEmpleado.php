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
                        <th>Rol</th>
                        <th>nombre</th>
                        <th>apellido</th>
                        <th>tipo de documento</th>
                        <th>documento</th>
                        <th>correo</th>
                        <th>telefono</th>
                        <th>Direccion</th>
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
        <button class="BotonVerde" onclick="ModificarUsuarioEmpleado()">Aceptar</button>
        <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
    </div>
</dialog>

<script>
    $(document).ready(function() {
        ListarUsuarioEmpleado();
    });
</script>