<body>
    <div class="ContenedorAñadir">
        <div class="NombreTabla">
            <h1>Agendar Servicio</h1>
            <img src="assets/Iconos/agendamientonegro.svg" alt="">
        </div>
        <form action="">
            <p>Nombre Cliente</p>
            <input type="text" id="NombreCliente" placeholder="Ingrese nombre del cliente"><img class="iconosagendamiento" src="icons/cliente.png" alt="">
            <p>Nombre del Empleado</p>
            <select name="nombre" id="Empleado">
            </select>
            <p>Telefono del Cliente</p>
            <input type="text" id="Telefono" placeholder="Ingrese telefono"><img class="iconosagendamiento" src="icons/telefono.png" alt="">
            <p>Fecha</p>
            <input type="date" id="Fecha" placeholder="Ingrese fecha"><img class="iconosagendamiento" src="icons/calendario.png" alt="">
            <p>Hora</p>
            <input type="time" id="Hora" placeholder="Ingrese hora"><img class="iconosagendamiento" src="icons/reloj-de-pared.png" alt="">
            <p>Direccion de la solicitud</p>
            <input type="text" id="Direccion" placeholder="Ingrese direccion"><img src="icons/casa.png" alt="" style="height:27px;margin-left:11px;">
            <p>Tipo de Servicio</p>
            <select class="ContenedorAñadirselect" name="inputselect" name="nombre" id="Servicio">
            </select>
            <p>Escoger insumos</p>
                
                    <table id="AgendarInsumos">
                    <tr>
                        <th>Insumo</th>
                        <th>Cantidad</th>
                        <th>Unidad Medida</th>
                        <th>Accion</th>
                    </tr>
                    <tr>
                            <td><select class="Especialselect" id="Insumos"></select></td>
                            <td><Input type="number" value="0" id="Cantidad" step="1.0" min="0" ></Input></td>
                            <td><select class="Especialselect" id="Medida"></select></td>
                            <td><input type="button"  class="BotonVerde" onclick="GuardarInsumosAgendamiento()" value="Agregar">
        
                        </td>
                    </tr>
                    </table>
        
            <p>Descripcion</p>
            <input type="text" id="Descripcion" placeholder="Ingrese una descripcion"><img class="iconosagendamiento" src="icons/editar-informacion.png" alt="">
            <div class="Boton">
                <button class="BotonVerde" onclick="ValidacionAgendamiento()">Agendar</button>
            </div>
    </div>
    </form>
    <main class="FormularioAñadir">
        <section class="FormularioBody"></section>
    </main>
</body>
<script>
    $(document).ready(function() {
        SelectServicio();
        SelectUsuario();
        SelectInsumo();
        SelectUnidadMedida();
        ListarNombresEmpleado();
    });
</script>