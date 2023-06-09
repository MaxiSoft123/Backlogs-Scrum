<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1 >Realizar préstamo a empleado</h1>
        <img src="assets/Iconos/prestamos2.svg" alt="">
    </div>
<div class="letra ContenedorAñadir">
    <center>
        <div class="grid-item">
            <p>Nombre Empleado</p>
            <select name="id_empleado" id="id_empleado" placeholder="Empleado">
            </select>
        </div>
        <br>
        <h1>Filtro</h1> 
    </center>
  <center>
    <div class="barraCentrar
">
        <div class="grid-item" style="width: auto; display: inline-block;">
            <p>Tipo de herramienta</p>
            <select onclick="ListarNombresHerramienta()" name="Tipo" id="Tipo" placeholder="Tipo">
             <option value="Herramienta">Herramienta</option>
             <option value="Insumo">Insumo</option>
            </select>
        </div>
        <div class="grid-item" style="width: auto; display: inline-block;">
            <p>Nombre herramienta</p>
            <select name="Nombre" id="Nombre" placeholder="Nombre">
        
            </select>
        </div>
        </div>
        <br><br>
        <center><button class="Estado Activo" onclick="ConsultaRealizarP()">Consultar</button></center>
  
    </center>
    <br>
    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Nombre herramienta</th>
                    <th>Tipo de herramienta</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Color</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
                    <th>Prestar</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
    <br>
    <center>
    <div class="herramientasAsignadas">
        <h3>Asignadas</h3>
        <div id="todo">
        <table id="herramienta"></table>
            </div>
        <button class="Estado Activo" onclick="Prestar()">Prestar</button>
    </div>
    </center>
</div>
</div>
<script>
    $(document).ready(function() {
        DefectoRealizarP();
        ListarNombresEmpleado();
        ListarNombresHerramienta();
    });
</script>
