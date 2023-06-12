<?php
include("../Modelo/Conexion.php");
switch ($_POST['metodo']) {
    case 'a':
        GuardarServicio();
        break;
        case 'e':
            ListarServicios();
            break;
            case 'i':
                DesactivarServicio();
                break;
                case 'o':
                    ModalListar();
                    break;
                    case 'u':
                        ModificarListar();
                        break;
}


function GuardarServicio()
{

    $Nombre = $_POST["Nombre"];
    $Estado = "Activado";
  
      
    $conexion = new PDODB();

    $conexion-> Conectar();

    $InstruccionSQL = "INSERT INTO servicios 
        VALUES
        (null,'" .  $Nombre . "','" .  $Estado . "')";

    $resultado = $conexion->EjecutarInstruccion($InstruccionSQL);

    if ($resultado == true) {
        echo "Se ha podido guardar con exito";
    } else {
        echo "No se ha podido guardar con exito";
    }

} 

function ListarServicios()
{
    


    $conexion = new PDODB();

    $conexion-> Conectar();

    $InstruccionSQL = "SELECT * FROM servicios";

    $resultado = $conexion->ObtenerDatos($InstruccionSQL);


    foreach ($resultado as $fila) {  
        
        $color = "verde";
        if($fila['Estado']=="Desactivado"){
            $color="rojo";
        }
      
        echo'
        <tr>
        <td >',$fila['Nombre'],'</td>
        <td >',$fila['Estado'],'</td>
      <td><a href="#"><img onclick="ModalListar(' . $fila['IdServicio'] . ')" src="assets/Iconos/editar.svg" alt="" class="IconoTabla"> </a>
        <a href="#"><img onclick="DesactivarServicio(' . $fila['IdServicio'] . ')" src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla"> </a></td>
        </tr>
       
        ';
    }
}


function DesactivarServicio(){
    $IdServicio = $_POST["IdServicio"];
    $estado1 = "Desactivado";


    $conexion = new PDODB();

    $conexion-> Conectar();

    $estadoss = "SELECT * FROM servicios WHERE IdServicio=".$IdServicio;

    $resultado = $conexion->ObtenerDatos($estadoss);

    foreach ($resultado as $key => $fila) { 
        $estado = $fila['Estado'];
    }

    if ($estado == "Desactivado"){
        $estado1 = "Activado";
    }
    if ($estado == "Desactivado" || $estado == "Activado"){

    $InstruccionSQL = "UPDATE servicios SET Estado = '" . $estado1 . "'
         WHERE IdServicio = " . $IdServicio;

    $resultado = $conexion->EjecutarInstruccion($InstruccionSQL);

    if ($resultado == true) {
        echo "Cambio Realizado";
    } else {
        echo "Cambio No Realiazado";
    }
}
}


function ModalListar()
{
    $connection = new PDODB();
    $connection-> Conectar();
    $IdServicio = $_POST['IdServicio'];
    $sql = "SELECT * FROM servicios WHERE IdServicio  = " . $IdServicio;
    $lista = $connection->ObtenerDatos($sql);
    $formHtml = "";

    foreach ($lista as $key => $value) {
        echo'
        <input id="Servicio" type="hidden" value = "'.$value['IdServicio'].'">
        <p>Nombre Del Servicio</p>
        <input type="text" id="NombreServicio" placeholder="Ingrese nombre del Servicio" ><img class="iconosagendamiento" src="icons/cliente.png" alt="">
    
     ';
    }

}


function ModificarListar()
{

    $IdServicio = $_POST["IdServicio"];
    $Nombre = $_POST["Nombre"];
    $Estado = "Activado";


    $connection = new PDODB();

    $connection-> Conectar();

    $sql = "UPDATE Servicios SET 
        Nombre = '" . $Nombre . "',
        Estado = '" . $Estado . "'
        WHERE IdServicio = " . $IdServicio  ;

    $modificado = $connection->EjecutarInstruccion($sql);

    if ($modificado == true) {
        echo "Modificado correctamente ";
    } else {
        echo "No fue posible modificar";
    }
}




