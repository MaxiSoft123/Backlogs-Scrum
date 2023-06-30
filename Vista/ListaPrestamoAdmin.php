<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Lista de prestamos</h1>
        <img src="assets/Iconos/prestamos2.svg" alt="">
    </div>



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
    <!-- tabla 1 -->

    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
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

    <dialog id="modal" class="">
    <center>
        <br>
	<div class="modal-body">
		...
	</div>

		<button class="Estado Activo" onclick="MetodoModal()">Aceptar</button>
		<button class="Estado Inactivo" onclick="cerrarModal()">Cancelar</button>
	</center>
</dialog>



<br><br><br>

<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Dañadas</h1>
        <img src="assets/Iconos/prestamos2.svg" alt="">
    </div>




<main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Herramienta</th>
                    <th>Cantidad</th>
                    <th>Observacion</th>
                    <th>Operaciones</th>
                    </tr>
                </thead>
            <tbody id="ListarPrestamoDañado">
            </tbody>
            </table>
        </section>
    </main>
</div>

<!-- SCRIPTS -->
<script>
    $(document).ready(function() {
        ListarPrestamoAdmin(-999);
        ListarPrestamoDañado();
        ListarNombresEmpleado();
    });
</script>