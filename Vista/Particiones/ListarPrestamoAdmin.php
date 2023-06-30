<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Lista de prestamos</h1>
        <img src="assets/Iconos/prestamos2.svg" alt="">
    </div>
    <br>
    <center>
<button class="BotonVerde" onclick="CambiarAdmin('Prestamos')">Prestamos</button>
<button class="BotonRojo" onclick="CambiarAdmin('Dañada')">Herramientas Dañadas</button>
</center>
<br>
<div class="CambiarAdmin">
    <center>
        <div class="empleadoyboton">
            <div class="grid-item letra">
                <p>Nombre Empleado</p>
                <select name="NombreEmpleado" id="id_empleado">

                </select>
            </div>
            <br>
            <button class="Estado Activo" onclick="ConsultaEmpleadoPrestamo()">Listar</button>
        </div>
    </center>
    <br>
 
    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                        <th>ID prestamo</th>
                        <th>ID detalle</th>
                        <th>Empleado</th>
                        <th>Herramienta</th>
                        <th>Tipo</th>
                        <th>Fecha Registro</th>
                        <th>Cantidad</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody id="ListarPrestamoAdmin">
                </tbody>
            </table>
        </section>
    </main>
</div>

</div>
<dialog id="modal" class="">
    <center>
        <br>
        <div class="modal-body">
            ...
        </div>

        <button class="Estado Activo" onclick="MetodoModal()">Aceptar</button>
        <button class="Estado Inactivo" onclick="CerrarModal()">Cancelar</button>
    </center>
</dialog>
<!-- SCRIPTS -->
<script>
    $(document).ready(function() {
        ListarPrestamoAdmin(-999);

        ListarNombresEmpleadoPrestados();
    });
</script>