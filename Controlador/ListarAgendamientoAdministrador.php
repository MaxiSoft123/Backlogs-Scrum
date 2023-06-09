<?php
include("../Modelo/Conexion.php");
switch ($_POST['metodo']) {
        case 'e':
            ListarAgendamientoAdministrador();
            break;
            case 'i':
                CambiarEstado();
                break;
                case 'o':
                    ModalAgendamiento();
                    break;
                    case 'u':
                        ModificarAgendamiento();
                        break;
}

function ListarAgendamientoAdministrador()
{
    session_start();


    $conexion = new PDODB();

    $conexion-> Conectar();

    $InstruccionSQL = "SELECT * FROM agendamiento";

    $resultado = $conexion->ObtenerDatos($InstruccionSQL);


    foreach ($resultado as $fila) {  
        $id_servicio= $fila['IdServicio'];
        $id_empleado= $fila['IdEmpleado'];
        $InstruccionSQL4 = "SELECT Nombre FROM empleado where IdEmpleado=".$id_empleado;
        $resultado4 = $conexion->ObtenerDatos($InstruccionSQL4);
        foreach ($resultado4 as $fila4) { }
        $InstruccionSQL2 = "SELECT Nombre FROM servicios where IdServicio=".$id_servicio;
        $resultado2 = $conexion->ObtenerDatos($InstruccionSQL2);   
        foreach ($resultado2 as $fila2) { }
        $id_herramienta_e_insumo= $fila['IdHerramientaInsumo'];
        $InstruccionSQL3 = "SELECT Nombre,Cantidad FROM  HerramientaInsumo where IdHerramientaInsumo=".$id_herramienta_e_insumo;
        $resultado3 = $conexion->ObtenerDatos($InstruccionSQL3);   
        foreach ($resultado3 as $fila3) {    
            
        }
        $color = "Estado Activo";
        if($fila['Estado']=="Pendiente"){
            $color="Estado Inactivo";
        }
      
        echo'
        <tr>
        <td >',$fila4['Nombre'],'</td>
        <td >',$fila['NombreCliente'],'</td>
        <td >',$fila2['Nombre'],'</td>
        <td >',$fila['DireccionCliente'],'</td>
        <td >',$fila['TelefonoCliente'],'</td>
        <td >',$fila['FechaServicio'] ,'| ',$fila['HoraAgendamiento'],'  </td>
        <td >',$fila3['Nombre'],'</td>
        <td >',$fila3['Cantidad'],'</td>
        <td >',$fila['Estado'],'</td>
        <td> <a href="#"><img onclick="ModalAgendamiento(' . $fila['IdAgendamiento'] . ')" src="assets/Iconos/editar.svg" alt="" class="IconoTabla"> </a> </td>
        <td> <a href="#"><img onclick="CambiarEstado(' . $fila['IdAgendamiento'] . ')" src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla"> </a> </td>
        </tr>
        ';
    }
}


function CambiarEstado(){
    $id_agendamiento = $_POST["id_agendamiento"];
    $estado1 = "Pendiente";


    $conexion = new PDODB();

    $conexion-> Conectar();

    $estadoss = "SELECT * FROM agendamiento WHERE IdAgendamiento=".$id_agendamiento;

    $resultado = $conexion->ObtenerDatos($estadoss);

    foreach ($resultado as $key => $fila) { 
        $estado = $fila['Estado'];
    }

    if ($estado == "Pendiente"){
        $estado1 = "Realizado";
    }
    if ($estado == "Pendiente" || $estado == "Realizado"){

    $InstruccionSQL = "UPDATE agendamiento SET Estado = '" . $estado1 . "'
         WHERE IdAgendamiento = " . $id_agendamiento;

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
    $connection = new PDODB();
    $connection-> Conectar();
    $id_agendamiento = $_POST['id_agendamiento'];
    $sql = "SELECT * FROM agendamiento WHERE IdAgendamiento  = " . $id_agendamiento;
    $lista = $connection->ObtenerDatos($sql);
    $formHtml = "";

    foreach ($lista as $key => $value) {
        echo'
        <input id="Agendamiento" type="hidden" value = "'.$value['IdAgendamiento'].'">
        <p>Nombre Cliente</p>
        <input type="text" id="NombreCliente" placeholder="Ingrese nombre del cliente" ><img class="iconosagendamiento" src="icons/cliente.png" alt="">
        <p>Nombre del Empleado</p>
        <select  name="nombre" id="Empleado" >
        </select>
        <p>Telefono del Cliente</p>
        <input  type="text" id="Telefono" placeholder="Ingrese telefono" ><img class="iconosagendamiento" src="icons/telefono.png" alt="">
        <p>Fecha</p>
        <input type="date" id="Fecha" placeholder="Ingrese fecha" ><img class="iconosagendamiento" src="icons/calendario.png" alt="" >
        <p>Hora</p>
        <input  type="time" id="Hora" placeholder="Ingrese hora" ><img class="iconosagendamiento" src="icons/reloj-de-pared.png" alt="">
        <p>Direccion de la solicitud</p>
        <input type="text" id="Direccion" placeholder="Ingrese direccion"><img src="icons/casa.png" alt="" style="height:27px;margin-left:11px;">
        <p>Tipo de Servicio</p>
        <select class ="ContenedorAñadirselect"   name="inputselect" name="nombre" id="Servicio" >
        </select>
        <p>Insumos</p>
        <select class ="ContenedorAñadirselect" name="inputselect" name="nombre" id="Insumos" >
        </select>
        <P>Cantidad de Insumos</P>
        <input  type="text" id="CantidadInsumo" placeholder="Ingrese cantidad del insumo"><img class="iconosagendamiento" src="icons/ordenar-cantidad-ascendente.png" alt="" >
        <p>Descripcion</p>
        <input type="text" id="Descripcion" placeholder="Ingrese una descripcion"><img class="iconosagendamiento" src="icons/editar-informacion.png" alt="" >


            <script>
	$(document).ready(function() {
    SelectServicio();
	});
</script>
<script>
	$(document).ready(function() {
    SelectInsumo();
	});
</script>
<script>
	$(document).ready(function() {
    SelectEmpleado();
	});
</script>


    
     ';
    }

}


function ModificarAgendamiento()
{
    session_start();
    $IdAgendamiento = $_POST["IdAgendamiento"];
    $IdEmpleado= $_POST["IdEmpleado"];
    $IdServicio = $_POST["IdServicio"];
    $NombreCliente = $_POST["NombreCliente"];
    $Descripcion = $_POST["Descripcion"];
    $FechaServicio= $_POST["FechaServicio"];
    $DireccionCliente = $_POST["DireccionCliente"];
    $TelefonoCliente = $_POST["TelefonoCliente"];
    $HoraAgendamiento = $_POST["HoraAgendamiento"];
    $Estado = "Pendiente";
    $Cantidad = $_POST["Cantidad"];;
    $IdHerramientaInsumo= $_POST["IdHerramientaInsumo"];
    $Descripcion = $_POST["Descripcion"];

    $connection = new PDODB();

    $connection-> Conectar();

    $sql = "UPDATE agendamiento SET 
        NombreCliente = '" . $NombreCliente . "',
        FechaServicio = '" . $FechaServicio . "',
        DireccionCliente = '" . $DireccionCliente . "',
        TelefonoCliente = '" . $TelefonoCliente . "',
        IdEmpleado = '" . $IdEmpleado . "',
        IdServicio = '" . $IdServicio . "',
        IdEmpleado = '" . $IdEmpleado . "',
        Estado = '" . $Estado . "',
        Cantidad = '" . $Cantidad . "',
        HoraAgendamiento = '" . $HoraAgendamiento . "',
        Descripcion = '" . $Descripcion . "',
        IdHerramientaInsumo = " . $IdHerramientaInsumo . "
        WHERE IdAgendamiento = " . $IdAgendamiento  ;

    $modificado = $connection->EjecutarInstruccion($sql);

    if ($modificado == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}
