<?php
include("../Modelo/Conexion.php");
switch ($_POST['Metodo']) {
    case 'GuardarAgendamiento':
        GuardarAgendamiento();
        break;
    case 'GuardarInsumosAgendamiento':
        GuardarInsumosAgendamiento();
        break;
    case 'EliminarInsumosAgendamiento':
        EliminarInsumosAgendamiento();
        break;
    case 'SelectInsumo':
        SelectInsumo();
        break;
    case 'SelectUnidadMedida':
        SelectUnidadMedida();
        break;
    case 'SelectServicio':
        SelectServicio();
        break;
    case 'SelectUsuario':
        SelectUsuario();
        break;
    case 'ModificarAgendamiento':
        ModificarAgendamiento();
        break;
    case 'ModalAgendamiento':
        ModalAgendamiento();
        break;
    case 'CambiarEstado':
        CambiarEstado();
        break;
    case 'ListarAgendamientoAdministrador':
        ListarAgendamientoAdministrador();
        break;
    case 'ListarAgendamiento':
        ListarAgendamiento();
        break;
}
function GuardarAgendamiento()
{
    $Cantidad = $_POST["CantidadRegistrados"];
    $IdAcumuladas = $_POST["IdRegistrados"];
    $IdUsuario = $_POST["IdUsuario"];
    $IdServicio = $_POST["IdServicio"];
    $NombreCliente = $_POST["NombreCliente"];
    $Descripcion = $_POST["Descripcion"];
    $FechaServicio = $_POST["FechaServicio"];
    $DireccionCliente = $_POST["DireccionCliente"];
    $TelefonoCliente = $_POST["TelefonoCliente"];
    $HoraAgendamiento = $_POST["HoraAgendamiento"];
    $Estado = "2";
    $ListaIdHerramientaInsumo = "";
    foreach ($IdAcumuladas as $key => $value) {
        $ListaIdHerramientaInsumo = "$ListaIdHerramientaInsumo $value, ";

    }
    $ListaCantidadHerramientaInsumo = "";
    foreach ($Cantidad as $key => $value) {
    
            $ListaCantidadHerramientaInsumo = "$ListaCantidadHerramientaInsumo $value, ";
    }
    $ListaCantidadHerramientaInsumo = substr($ListaCantidadHerramientaInsumo, 0, strlen($ListaCantidadHerramientaInsumo) - 1);
    $ListaCantidadHerramientaInsumo = substr($ListaCantidadHerramientaInsumo, 0, strlen($ListaCantidadHerramientaInsumo) - 1);
    $ListaCantidadHerramientaInsumo = trim($ListaCantidadHerramientaInsumo);

    $ListaIdHerramientaInsumo = substr($ListaIdHerramientaInsumo, 0, strlen($ListaIdHerramientaInsumo) - 1);
    $ListaIdHerramientaInsumo = substr($ListaIdHerramientaInsumo, 0, strlen($ListaIdHerramientaInsumo) - 1);
    $ListaIdHerramientaInsumo = trim($ListaIdHerramientaInsumo);
    $conexion = new PDODB();

    $conexion->Conectar();
$InstruccionSQL1 = "INSERT INTO agendamiento 
VALUES
(null,'" . $IdUsuario . "','" . $IdServicio . "','" . $ListaIdHerramientaInsumo . "','" . $NombreCliente . "','" . $Descripcion . "','" . $FechaServicio . "','" . $HoraAgendamiento . "','" . $DireccionCliente . "','" . $TelefonoCliente . "','" . $Estado . "')";
$resultado1 = $conexion->EjecutarInstruccion($InstruccionSQL1);
$InstruccionSQL2 = "SELECT MAX(IdAgendamiento) as IdAgendamiento FROM agendamiento;";
$resultado2 = $conexion->EjecutarInstruccion($InstruccionSQL2);
foreach ($resultado2 as $key => $value) {
    $IdAgendamiento = "$value[0]";
}
$InstruccionSQL3 = "INSERT INTO insumoagenda
VALUES
(null,'" . $ListaIdHerramientaInsumo . "','" . $IdAgendamiento . "','" . $ListaCantidadHerramientaInsumo . "')";
$resultado3 = $conexion->EjecutarInstruccion($InstruccionSQL3);
if ($resultado1 and $resultado2 and $resultado3 == true) {
    echo "Se ha guardado correctamente";
}else{
    echo "No se ha guardado";

}
}


function GuardarInsumosAgendamiento()
{
    $Cantidad = $_POST["CantidadRegistrados"];
    $IdAcumuladas = $_POST["IdRegistrados"];
    $NuevaCantidad = $_POST["NuevaCantidad"];

    $conexion = new PDODB();
    $conexion->Conectar();
    $IdAgendamiento = "";
    foreach ($Cantidad as $key => $CantidadAgendada) {}
    foreach ($IdAcumuladas as $key =>$IdHerramienta){}
        $InstruccionSQL1 = "UPDATE HerramientaInsumo SET Cantidad = '" . $NuevaCantidad . "'
        WHERE IdHerramientaInsumo = " . $IdHerramienta;
        $resultado = $conexion->EjecutarInstruccion($InstruccionSQL1);
        if ($resultado) {
            echo"Insumos Actualizados";
        }else{
            echo"F";
        }

} 


function EliminarInsumosAgendamiento()
{

    $Cantidad = $_POST["CantidadRegistrados"];
    $IdAcumuladas = $_POST["IdRegistrados"];
    $NuevaCantidad = $_POST["NuevaCantidad"];

    $conexion = new PDODB();
    $conexion->Conectar();

    foreach ($Cantidad as $key => $CantidadAgendada) {}
    foreach ($IdAcumuladas as $key =>$IdHerramienta){}
        $InstruccionSQL1 = "UPDATE HerramientaInsumo SET Cantidad = '" . $CantidadAgendada . "'
        WHERE IdHerramientaInsumo = " . $IdHerramienta;
        $resultado = $conexion->EjecutarInstruccion($InstruccionSQL1);
        if ($resultado) {
            echo"Insumos Actualizados";
        }else{
            echo"F";
        }
  
  
}

function SelectServicio()
{
    $conexion = new PDODB();
    $conexion->Conectar();

    $sql = "SELECT * FROM servicio";
    $lista = $conexion->ObtenerDatos($sql);
    $formHtml = "";

    foreach ($lista as $key => $value) {
        if($value['Estado']==1){
        echo '
    
                <option value="' . $value['IdServicio'] . '">' . $value['Nombre'] . '</option>
            ';
    }
}
}

function SelectInsumo()
{
    $conexion = new PDODB();
    $conexion->Conectar();

    $sql = "SELECT * FROM  HerramientaInsumo WHERE Cantidad >0";
    $lista = $conexion->ObtenerDatos($sql);

    foreach ($lista as $key => $value) {
        if ($value['Tipo'] == 'Insumo') {
            echo '
                <input id="CantidadActual' . $value['Nombre'] . '" type="hidden" value = "' . $value['Cantidad'] . '">
                <input id="IdInsumo' . $value['Nombre'] . '" type="hidden" value = "' . $value['IdHerramientaInsumo'] . '">
                <option value="" hidden>Selecciona una opción</option>
                <option value="' . $value['Nombre'] . '">' . $value['Nombre'] . '</option>
            ';
        }
    }
}


function SelectUnidadMedida()
{

    $Cantidad = $_POST["CantidadRegistrados"];
    $IdAcumuladas = $_POST["IdRegistrados"];
    $conexion = new PDODB();
    $conexion->Conectar();
    $StringHerrameintas = [];
    $separador = ",";
    $separadas = explode($separador, $IdAcumuladas);
        $sql = "SELECT * FROM  HerramientaInsumo";
        $lista = $conexion->ObtenerDatos($sql);

        foreach ($lista as $key => $value) {

            echo '
                <option value="" hidden>Selecciona una opción</option>
                <option value="' . $value['Medida'] . '">' . $value['Medida'] . '</option>
            ';
        }
    
}


function SelectUsuario()
{
    $conexion = new PDODB();
    $conexion->Conectar();

    $sql = "SELECT * FROM usuario";
    $lista = $conexion->ObtenerDatos($sql);
    $formHtml = "";

    foreach ($lista as $key => $value) {
        echo '
    
                <option  value="' . $value['IdUsuario'] . '">' . $value['Nombre'] . '</option>
            ';
    }
}

function ListarAgendamientoAdministrador()
{
    $conexion = new PDODB();

    $conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM agendamiento";

    $resultado = $conexion->ObtenerDatos($InstruccionSQL);
    foreach ($resultado as $fila) {
        $IdServicio = $fila['IdServicio'];
        $IdUsuario = $fila['IdUsuario'];
        $IdAgendamiento = $fila['IdAgendamiento'];
        $InstruccionSQL4 = "SELECT Nombre FROM usuario where IdUsuario=" . $IdUsuario;
        $resultado4 = $conexion->ObtenerDatos($InstruccionSQL4);
        $InstruccionSQL5 = "SELECT Cantidad FROM insumoagenda where IdAgendamiento=" . $IdAgendamiento;
        $resultado5 = $conexion->ObtenerDatos($InstruccionSQL5);
        foreach ($resultado4 as $fila4) {
        }
        foreach ($resultado5 as $fila5) {
        }
        $InstruccionSQL2 = "SELECT Nombre FROM servicio where IdServicio=" . $IdServicio;
        $resultado2 = $conexion->ObtenerDatos($InstruccionSQL2);
        foreach ($resultado2 as $fila2) {
        }
        $IdHerramientaInsumo = $fila['IdHerramientaInsumo'];
        $StringHerrameintas = [];
        $separador = ",";
        $separadorq = "";
        $separadas = explode($separador, $IdHerramientaInsumo);
        foreach ($separadas as $key => $value) {
            if($value!="Ninguno"){
            $InstruccionSQL3 = "SELECT Nombre,Medida FROM  HerramientaInsumo where IdHerramientaInsumo=" . $value;
            $resultado3 = $conexion->ObtenerDatos($InstruccionSQL3);

            foreach ($resultado3 as $key => $fila3) {
                array_push($StringHerrameintas, "$fila3[Nombre]");
            }
        }else{
            array_push($StringHerrameintas,$IdHerramientaInsumo);

        }
        }
        $StringEstado = "";
        $Color = "Estado Activo";
        if ($fila['Estado'] == "2") {
            $Color = "Estado Inactivo";
            $StringEstado = "Pendiente";
           
        } else {
            $StringEstado = "Realizado";
        }

        $StringHerrameintas = implode($separador, $StringHerrameintas);
        echo '
        <tr>
        <td >', $fila4['Nombre'], '</td>
        <td >', $fila['NombreCliente'], '</td>
        <td >', $fila2['Nombre'], '</td>
        <td >', $fila['DireccionCliente'], '</td>
        <td >', $fila['TelefonoCliente'], '</td>
        <td >', $fila['FechaServicio'], '| ', $fila['HoraAgendamiento'], '  </td>
        <td >', $StringHerrameintas, '</td>
        <td >', $fila5['Cantidad'],'  </td>
        <td >	<button class="', $Color, '">', $StringEstado, '</td></button>
        <td> <a href="#"><img onclick="ModalAgendamiento(' . $fila['IdAgendamiento'] . ')" src="assets/Iconos/editar.svg" alt="" class="IconoTabla"> </a> </td>
        <td> <a href="#"><img onclick="CambiarEstado(' . $fila['IdAgendamiento'] . ')" src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla"> </a> </td>
        </tr>
        ';
    }
}


function CambiarEstado()
{
    $IdAgendamiento = $_POST["IdAgendamiento"];
    $estado1 = "1";


    $conexion = new PDODB();

    $conexion->Conectar();

    $estadoss = "SELECT * FROM agendamiento WHERE IdAgendamiento=" . $IdAgendamiento;

    $resultado = $conexion->ObtenerDatos($estadoss);

    foreach ($resultado as $key => $fila) {
        $estado = $fila['Estado'];
    }

    if ($estado == "1") {
        $estado1 = "2";
    }
    if ($estado == "1" || $estado == "2") {

        $InstruccionSQL = "UPDATE agendamiento SET Estado = '" . $estado1 . "'
         WHERE IdAgendamiento = " . $IdAgendamiento;

        $resultado = $conexion->EjecutarInstruccion($InstruccionSQL);

        if ($resultado == true) {
            echo "Cambio Realizado";
        } else {
            echo "Cambio No Realiazado";
        }
    }
}
function ModalAgendamiento()
{
    $conexion = new PDODB();
    $conexion->Conectar();
    $IdAgendamiento = $_POST['IdAgendamiento'];
    $sql = "SELECT * FROM agendamiento WHERE IdAgendamiento  = " . $IdAgendamiento;
    $lista = $conexion->ObtenerDatos($sql);
    foreach ($lista as $key => $value) {
        echo '
        <form action="">
        <input id="Agendamiento" type="hidden" value = "' . $value['IdAgendamiento'] . '">
        <p>Nombre Cliente</p>
        <input type="text" id="NombreCliente"  value ="' . $value['NombreCliente'] . '"><img class="iconosagendamiento" src="icons/cliente.png" alt="">
        <p>Nombre del Empleado</p>
        <select name="nombre" id="Empleado">
        </select>
        <p>Telefono del Cliente</p>
        <input type="text" id="Telefono" value="' . $value['TelefonoCliente'] . '"><img class="iconosagendamiento" src="icons/telefono.png" alt="">
        <p>Fecha</p>
        <input type="date" id="Fecha" value="' . $value['FechaServicio'] . '"><img class="iconosagendamiento" src="icons/calendario.png" alt="">
        <p>Hora</p>
        <input type="time" id="Hora" value="' . $value['HoraAgendamiento'] . '"><img class="iconosagendamiento" src="icons/reloj-de-pared.png" alt="">
        <p>Direccion de la solicitud</p>
        <input type="text" id="Direccion" value="' . $value['DireccionCliente'] . '"><img src="icons/casa.png" alt="" style="height:27px;margin-left:11px;">
        <p>Tipo de Servicio</p>
        <select class="ContenedorAñadirselect" name="inputselect" name="nombre" id="Servicio">
        </select>
        <p>Escoger insumos</p>
                
        <table id="AgendarInsumos">
        <tr>
            <th>Insumo</th>
            <th>Cantidad</th>
            <th>Cantidad de Medida</th>
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
        <input type="text" id="Descripcion" value="' . $value['Descripcion'] . '"><img class="iconosagendamiento" src="icons/editar-informacion.png" alt="">
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
});
</script>
    
     ';
    }
}


function ModificarAgendamiento()
{
    $IdAcumuladas = $_POST["IdRegistrados"];
    $IdAgendamiento = $_POST["IdAgendamiento"];
    $IdUsuario = $_POST["IdUsuario"];
    $IdServicio = $_POST["IdServicio"];
    $NombreCliente = $_POST["NombreCliente"];
    $Descripcion = $_POST["Descripcion"];
    $FechaServicio = $_POST["FechaServicio"];
    $DireccionCliente = $_POST["DireccionCliente"];
    $TelefonoCliente = $_POST["TelefonoCliente"];
    $HoraAgendamiento = $_POST["HoraAgendamiento"];
    $Cantidad = $_POST["CantidadRegistrados"];
    $Descripcion = $_POST["Descripcion"];
    $Estado = "2";
    $ListaIdHerramientaInsumo = "";
    foreach ($IdAcumuladas as $key => $value) {
            $ListaIdHerramientaInsumo = "$ListaIdHerramientaInsumo $value, ";
    }
    $ListaCantidadHerramientaInsumo = "";
    foreach ($Cantidad as $key => $value) {
            $ListaCantidadHerramientaInsumo = "$ListaCantidadHerramientaInsumo $value, ";
    }
    $ListaCantidadHerramientaInsumo = substr($ListaCantidadHerramientaInsumo, 0, strlen($ListaCantidadHerramientaInsumo) - 1);
    $ListaCantidadHerramientaInsumo = substr($ListaCantidadHerramientaInsumo, 0, strlen($ListaCantidadHerramientaInsumo) - 1);
    $ListaCantidadHerramientaInsumo = trim($ListaCantidadHerramientaInsumo);

    $ListaIdHerramientaInsumo = substr($ListaIdHerramientaInsumo, 0, strlen($ListaIdHerramientaInsumo) - 1);
    $ListaIdHerramientaInsumo = substr($ListaIdHerramientaInsumo, 0, strlen($ListaIdHerramientaInsumo) - 1);
    $ListaIdHerramientaInsumo = trim($ListaIdHerramientaInsumo);
    $conexion = new PDODB();

    $conexion->Conectar();

    echo"$ListaCantidadHerramientaInsumo";
    echo"$ListaIdHerramientaInsumo";
    echo"$IdAgendamiento";

    $sql2 = "UPDATE insumoagenda SET 
    IdHerramientaInsumo = '" . $ListaIdHerramientaInsumo . "',
    Cantidad = " . $ListaCantidadHerramientaInsumo . "
    WHERE Idinsumoagenda = " . $IdAgendamiento;

    $sql = "UPDATE agendamiento SET 
        NombreCliente = '" . $NombreCliente . "',
        FechaServicio = '" . $FechaServicio . "',
        DireccionCliente = '" . $DireccionCliente . "',
        TelefonoCliente = '" . $TelefonoCliente . "',
        IdUsuario = '" . $IdUsuario . "',
        IdServicio = '" . $IdServicio . "',
        Estado = '" . $Estado . "',
        HoraAgendamiento = '" . $HoraAgendamiento . "',
        Descripcion = '" . $Descripcion . "',
        IdHerramientaInsumo = '" . $ListaIdHerramientaInsumo . "'
        WHERE IdAgendamiento = " . $IdAgendamiento;


    echo"$sql2";
    $modificado2 = $conexion->EjecutarInstruccion($sql2);
    $modificado = $conexion->EjecutarInstruccion($sql);

    if ($modificado and $modificado2 == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}


function ListarAgendamiento()
{

    $conexion = new PDODB();

    $conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM agendamiento";

    $resultado = $conexion->ObtenerDatos($InstruccionSQL);
    foreach ($resultado as $fila) {
        $IdServicio = $fila['IdServicio'];
        $IdUsuario = $fila['IdUsuario'];
        $IdAgendamiento = $fila['IdAgendamiento'];
        $InstruccionSQL4 = "SELECT Nombre FROM usuario where IdUsuario=" . $IdUsuario;
        $resultado4 = $conexion->ObtenerDatos($InstruccionSQL4);
        $InstruccionSQL5 = "SELECT Cantidad FROM insumoagenda where IdAgendamiento=" . $IdAgendamiento;
        $resultado5 = $conexion->ObtenerDatos($InstruccionSQL5);
        foreach ($resultado4 as $fila4) {
        }
        foreach ($resultado5 as $fila5) {
        }
        $InstruccionSQL2 = "SELECT Nombre FROM servicio where IdServicio=" . $IdServicio;
        $resultado2 = $conexion->ObtenerDatos($InstruccionSQL2);
        foreach ($resultado2 as $fila2) {
        }
        $IdHerramientaInsumo = $fila['IdHerramientaInsumo'];
        $StringHerrameintas = [];
        $separador = ",";
        $separadorq = "";
        $separadas = explode($separador, $IdHerramientaInsumo);
        foreach ($separadas as $key => $value) {
            if($value!="Ninguno"){
                $InstruccionSQL3 = "SELECT Nombre FROM  HerramientaInsumo where IdHerramientaInsumo=" . $value;
                $resultado3 = $conexion->ObtenerDatos($InstruccionSQL3);
    
                foreach ($resultado3 as $key => $fila3) {
                    array_push($StringHerrameintas, "$fila3[Nombre]");
                }
            }else{
                array_push($StringHerrameintas,$IdHerramientaInsumo);
    
            }
        }
        $StringEstado = "";
       
        $Color = "Estado Activo";
        if ($fila['Estado'] == "2") {
            $Color = "Estado Inactivo";
            $StringEstado = "Pendiente";
        } else {
            $StringEstado = "Realizado";
           
        }

        $StringHerrameintas = implode($separador, $StringHerrameintas);
        echo '
        <tr>
        <td >', $fila['NombreCliente'], '</td>
        <td >', $fila2['Nombre'], '</td>
        <td >', $fila['DireccionCliente'], '</td>
        <td >', $fila['TelefonoCliente'], '</td>
        <td >', $fila['FechaServicio'], '| ', $fila['HoraAgendamiento'], '  </td>
        <td >', $StringHerrameintas, '</td>
        <td >', $fila5['Cantidad'], '</td>
        <td ><button class="', $Color, '">', $StringEstado, ' </button></td>
        </tr>
        ';
    }
}


