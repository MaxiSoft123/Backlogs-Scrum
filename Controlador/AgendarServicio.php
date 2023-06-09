<?php
include("../Modelo/Conexion.php");
switch ($_POST['metodo']) {
    case 'a':
        GuardarAgendamiento();
        break;
        case 'e':
            ListarServicios();
            break;
            case 'i':
                SelectInsumo();
                break;
                case 'o':
                    SelectServicio();
                    break;
                    case 'u':
                        SelectEmpleado();
                        break;
}
function GuardarAgendamiento()
{
    session_start();
    $IdEmpleado= $_POST["IdEmpleado"];
    $IdServicio = $_POST["IdServicio"];
    $NombreCliente = $_POST["NombreCliente"];
    $Descripcion = $_POST["Descripcion"];
    $FechaServicio= $_POST["FechaServicio"];
    $DireccionCliente = $_POST["DireccionCliente"];
    $TelefonoCliente = $_POST["TelefonoCliente"];
    $Cantidad = $_POST["Cantidad"];
    $HoraAgendamiento = $_POST["HoraAgendamiento"];
    $IdHerramientaInsumo= $_POST["IdHerramientaInsumo"];
    $Estado = "Pendiente";
  
      
    $conexion = new PDODB();

    $conexion-> Conectar();

    $InstruccionSQL = "INSERT INTO agendamiento
        VALUES
        (null,'" .$IdEmpleado . "','" . $IdServicio. "','" . $NombreCliente. "','" .$Descripcion. "','" .$FechaServicio."','" .$HoraAgendamiento. "','" .$DireccionCliente. "', '" .$TelefonoCliente. "','" .$Cantidad. "','" .$Estado. "','".$IdHerramientaInsumo."')";

echo $InstruccionSQL;
    $resultado = $conexion->EjecutarInstruccion($InstruccionSQL);

    if ($resultado == true) {
        echo "Se ha podido guardar";
        
    } else {
        echo "No se ha podido guardar";
    }

} 
function SelectServicio()
    {
        $connection = new PDODB();
        $connection-> Conectar();
    
        $sql = "SELECT * FROM servicios";
        $lista = $connection->ObtenerDatos($sql);
        $formHtml = "";
    
        foreach ($lista as $key => $value) {
    echo'
    
                <option value="'.$value['IdServicio'] .'">'.$value['Nombre'] .'</option>
            ';
      }
    
    }

    function SelectInsumo()
    {
        $connection = new PDODB();
        $connection-> Conectar();
    
        $sql = "SELECT * FROM  HerramientaInsumo";
        $lista = $connection->ObtenerDatos($sql);
        $formHtml = "";
    
        foreach ($lista as $key => $value) {
    echo'
    
                <option value="'.$value['IdHerramientaInsumo'] .'">'.$value['Nombre'] .'</option>
            ';
      }
    
    }

    function SelectEmpleado()
    {
        $connection = new PDODB();
        $connection-> Conectar();
    
        $sql = "SELECT * FROM empleado";
        $lista = $connection->ObtenerDatos($sql);
        $formHtml = "";
    
        foreach ($lista as $key => $value) {
    echo'
    
                <option  value="'.$value['IdEmpleado'] .'">'.$value['Nombre'] .'</option>
            ';
      }
    
    }


        

