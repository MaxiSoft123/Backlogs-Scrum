<div class="ContenedorAñadir">
    <div class="NombreTabla">
        <h1>Añadir Novedad</h1>
        <img src="assets/Iconos/novedades2.svg" alt="">
    </div>
    <form action="">
    <p>Petición</p>
        <input type="text" name="Peticion" id="Peticion">
        <p>Descripción</p>
        <input type="text" name="Descripcion" id="Descripcion">
        <p>Desea hacer un Cambio en el horario de trabajo?</p>
        <select name="Cambio" id="Cambio">
            <option value="No">No</option>
            <option value="Si">Si</option>
        </select>
        <!-- HORA -->
        <div class="Hora">
            <p>Desde la hora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <input type="time" id="HoraInicio" name="HoraInicio" disabled>&nbsp;&nbsp;&nbsp;
            <p>Hasta la hora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <input type="time" id="HoraFinal" name="HoraFinal" disabled>&nbsp;&nbsp;&nbsp;
        </div>
        <!-- FECHA -->
        <div class="Dia">
            <p>Desde el día &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <input type="date" id="FechaInicio" name="FechaInicio">&nbsp;&nbsp;&nbsp;
            <p>Hasta el día &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <input type="date" id="FechaFinal" name="FechaFinal">&nbsp;&nbsp;&nbsp;
        </div>
        <div class="Boton">
            <button class="BotonVerde" onclick="GuardarNovedad()">Registrar</button>
            <button class="BotonRojo">Cancelar</button>
        </div>
    </form>
</div>

<script>
    document.getElementById("Cambio").onclick = function() {
        if (document.getElementById("Cambio").value == "Si") {
            document.getElementById("HoraInicio").disabled = false
            document.getElementById("HoraFinal").disabled = false
        } else {
            document.getElementById("HoraInicio").value = null
            document.getElementById("HoraFinal").value = null
            document.getElementById("HoraInicio").disabled = true
            document.getElementById("HoraFinal").disabled = true
        }
    };
</script>