<link rel="stylesheet" href="assets/css/estilos.css">
<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Listar Empleado</h1>
        <img src="assets/Iconos/empleados.svg" alt="">
    </div>
    <div class="Boton">
        <button onclick='ListarUsuario(1);' class="BotonVerde">Usuarios Activos</button>
        <button onclick='ListarUsuario(0);' class="BotonRojo">Usuarios Inactivos</button>
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
        <button class="BotonVerde" onclick="ModificarUsuario()">Aceptar</button>
        <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
    </div>
</dialog>

<script>
    $(document).ready(function() {
        ListarUsuario(1);
    });
</script>