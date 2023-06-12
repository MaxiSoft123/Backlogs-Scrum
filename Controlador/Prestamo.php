<?php
require_once '../Modelo/Conexion.php';
switch ($_POST['Metodo']) {
    // Inicio Realizar Prestamo 
        case 'a':
            ListarRealizarP();
            break;
            case 'r':
                Prestar();
                break;
                case 'D':
                    ListarNombresEmpleado();
                    break;
                    case 'd':
                        ListarNombresHerramienta();
                        break;
                        case 'l':
                            ListarPrestamoAdmin();
                            break;
                            case 'L':
                                ListarPrestamoDañado();
                                break;
                                case 'x':
                                    DevolverHerramienta();
                                    break;
                                    case 'k':
                                        ModalModificarPrestamo();
                                        break;
                                        case 'K':
                                            ModificarPrestamo();
                                            break;
                                            case 'z':
                                                ModalDevolverHerramienta();
                                                break;
                                                case 'Z':
                                                    DevolverHerramienta();
                                                    break;
                                                    case 'V':
                                                        DevolverDañada();
                                                        break;
                                                        case 'ñ':
                                                            ListarPrestamoEmpleado();
                                                            break;
                                                            case 'Ñ':
                                                                EliminarInsumo();
                                                                break;
                                                                
    // Fin Realizar Prestamo
}
    // Inicio Realizar Prestamo 
function ListarRealizarP(){

    $Tipo = $_POST['Tipo'];
    $Conexion = new PDODB();

    $Conexion->Conectar();
    if ($Tipo != "No"){
    $Nombre = $_POST['Nombre'];

    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE Cantidad > 0 AND Nombre='" . $Nombre . "' AND Tipo='" . $Tipo . "'";
}
else{
    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE cantidad > 0";
}
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    
    foreach ($Resultado as $key => $Value) {
    echo '<tr>
        <td class="pt-3-half" contenteditable="false"><input id="Nombre'.$Value['IdHerramientaInsumo'].'" type="hidden" value="'.$Value['Nombre'].'">' . $Value['Nombre'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="'.$Value['Tipo'].'">' . $Value['Tipo'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="'.$Value['Categoria'].'">' . $Value['Categoria'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="'.$Value['Descripcion'].'">' . $Value['Descripcion'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="'.$Value['Color'].'">' . $Value['Color'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="'.$Value['Medida'].'">' . $Value['Medida'] . '</td>

        <input type="hidden" id="cantidadd'.$Value['IdHerramientaInsumo'].'" value="'.$Value['Cantidad'].'">
        <td class="pt-3-half" contenteditable="false"><input class="cantidadAsignar" onclick="Validacion('.$Value['IdHerramientaInsumo'].')"  onkeyup="Validacion('.$Value['IdHerramientaInsumo'].')" id="cantidad'.$Value['IdHerramientaInsumo'].'" type="number" value="'.$Value['Cantidad'].'"></td>
        <td><img src="../Vista/Assets/Iconos/agregar.svg" alt="" id="boton'.$Value['IdHerramientaInsumo'].'"  class="amarillo" onclick="Asignar(' . $Value['IdHerramientaInsumo'] . ')"></td>
    </tr>';
    if ($Tipo != "No"){
        echo'<script>          
            CambiarImagen('.$Value['IdHerramientaInsumo'].');
    </script>';
    }
    }
    
}

function Prestar(){
    $Ides = $_POST['Ides'];
    $Cantidad = $_POST['Cantidades'];
    $IdEmpleado = $_POST['IdEmpleado'];
    date_default_timezone_set('America/Mexico_City');

    $FechaActual = date("d-m-Y");

    $Conexion = new PDODB();

    $Conexion->Conectar();
 
for ($i=0; $i < count($Ides); $i++) { 

    $Valida = 0;

    $Cosa = 0;
    $Cosa2 = 0;
    $sql = "SELECT * FROM prestamo 
    INNER JOIN herramientainsumo USING(IdHerramientaInsumo)
    WHERE IdHerramientaInsumo = " . $Ides[$i] . " AND IdEmpleado = " . $IdEmpleado;

    $resul = $Conexion->ObtenerDatos($sql);

    foreach ($resul as $key => $Value) {
        $Valida = 1;
        $NombreHerramienta = $Value['Nombre'];
    }
    if ($Valida > 0) {
        if ($Cosa == 0){
        echo "Ya le has prestado al empleado la herramienta con el nombre: ";
    $Cosa++;    
    }
        echo $NombreHerramienta;
    } else {
        $Cosa2++;
    $InstruccionSQL = "INSERT INTO prestamo
        VALUES
        (null,'" . $IdEmpleado . "', '" . $Ides[$i] . "','" . $FechaActual . "','" . $Cantidad[$i] . "')";

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
    ActHerramienta($Ides[$i], $Cantidad[$i], "-");
}} 

    if ($Cosa2 > 0) {
        echo "\n Se han prestado las herramientas";
    }else {
            echo "\n No fué posible prestar";
        }
   
    }

function ActHerramienta($Id, $Cantidad, $Operacion){
    
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE IdHerramientaInsumo= '" .$Id."'";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        $CantidadHerramienta = $Value['Cantidad'];
    }
if($Operacion == "-"){
$Resultado = $CantidadHerramienta - $Cantidad;
}
else{
$Resultado = $CantidadHerramienta + $Cantidad;
}
$InstruccionSQL = "UPDATE herramientainsumo  
SET
Cantidad = " . $Resultado . "
WHERE IdHerramientaInsumo = '" .$Id."'";

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);

}    
function ListarNombresEmpleado(){
    $Conexion = new PDODB();

                $Conexion->Conectar();
                $InstruccionSQL = "SELECT * FROM empleado";

                $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);


                foreach ($Resultado as $key => $Value) {
                    echo '<option value="' . $Value["IdEmpleado"] . '">' . $Value["Nombre"] . '</option>';
                }
}
function ListarNombresHerramienta(){
    $Tipo = $_POST['Tipo']; 
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE Cantidad > 0 AND Tipo = '".$Tipo."'";
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<option value="' . $Value["Nombre"] . '">' . $Value["Nombre"] . '</option>';
    }
}
// Fin Realizar Prestamo

//Lista admin

function ListarPrestamoAdmin(){
    $NombreEmpleado = $_POST['NombreEmpleado'];
    $Conexion = new PDODB();
    $Conexion->Conectar();


    if ($NombreEmpleado != -999){
    $InstruccionSQL = "SELECT prestamo.IdEmpleado, prestamo.IdPrestamo, herramientainsumo.Tipo, prestamo.FechaPrestamo,
     prestamo.Cantidad AS CantidadPrestamo, empleado.Nombre AS NombreEmpleado, herramientainsumo.Nombre
      AS NombreHerramienta FROM prestamo INNER JOIN herramientansumo ON 
      prestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo INNER JOIN 
      empleado ON prestamo.IdEmpleado=empleado.IdEmpleado WHERE prestamo.IdEmpleado=" . $NombreEmpleado;
}
else{
    $InstruccionSQL = "SELECT prestamo.IdPrestamo, prestamo.FechaPrestamo, herramientainsumo.Tipo, prestamo.Cantidad AS
     CantidadPrestamo, empleado.Nombre AS NombreEmpleado, herramientainsumo.Nombre AS 
     NombreHerramienta FROM prestamo INNER JOIN herramientainsumo ON 
     prestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
     INNER JOIN empleado ON prestamo.IdEmpleado=empleado.IdEmpleado";
}
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    
    foreach ($Resultado as $key => $Value) {
    echo '<tr>
        <td class="pt-3-half" contenteditable="false">'.$Value['IdPrestamo'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['NombreEmpleado'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['NombreHerramienta'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['Tipo'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['FechaPrestamo'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['CantidadPrestamo'].'</td>
        <td>
        <img src="..\Vista\Assets\Iconos\desactivar.svg" class="IconoTabla"  onclick="ModalDevolverHerramienta(' . $Value['IdPrestamo'] . ')" >
        <img src="..\Vista\Assets\Iconos\editar.svg" class="IconoTabla" onclick="ModalModificarPrestamo(' . $Value['IdPrestamo'] . ')" ></td>
        </tr>';
    }
}

function EliminarInsumo(){
    $IdPrestamo = $_POST['IdPrestamo'];
    
    $Conexion = new PDODB();

    $Conexion->Conectar();
    $InstruccionSQL = "DELETE FROM prestamo WHERE IdPrestamo = ".$IdPrestamo;
    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
    if ($Resultado == true) {
        echo "tales de tales";
    } else {
        echo "No fué posible";
    }
}

function ListarPrestamoDañado(){
    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM detalleprestamo INNER JOIN herramientainsumo ON detalleprestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    
    foreach ($Resultado as $key => $Value) {
    echo '<tr>
    <td class="pt-3-half" contenteditable="false">'.$Value['IdDetallePrestamo'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['Nombre'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['CantidadElemento'].'</td>
        <td class="pt-3-half" contenteditable="false">'.$Value['Observacion'].'</td>
        <td><input type="button" value="Arreglado" class="Estado Activo" onclick="DevolverDañada(' . $Value['IdDetallePrestamo'] . ')">
</td>
        </tr>';
    }
}
function DevolverHerramienta(){
    $IdPrestamo = $_POST['IdPrestamo'];
    $Select = $_POST['Select'];
    $CantidadDañado = $_POST['CantidadDañado'];
        $Observacion = $_POST['Observacion'];

    $Conexion = new PDODB();

    $Conexion->Conectar();

if ($Select == "no"){
    $InstruccionSQL = "SELECT * FROM prestamo WHERE IdPrestamo = ".$IdPrestamo;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    foreach ($Resultado as $key => $Value) {
        ActHerramienta($Value['IdHerramientaInsumo'], $Value['Cantidad'], "+");
    }
    $InstruccionSQL = "DELETE FROM prestamo WHERE IdPrestamo = ".$IdPrestamo;
    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
}
else{
    $InstruccionSQL = "SELECT * FROM prestamo WHERE IdPrestamo = ".$IdPrestamo;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    foreach ($Resultado as $key => $Value) {
        $Devolver = $Value['Cantidad'] - $CantidadDañado;
        ActHerramienta($Value['IdHerramientaInsumo'], $Devolver, "+");
        $InstruccionSQL = "DELETE FROM prestamo WHERE IdPrestamo = ".$IdPrestamo;
  $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
        $InstruccionSQL = "INSERT INTO detalleprestamo  
        VALUES
        (null,'" . $Value['IdHerramientaInsumo'] . "', '" . $CantidadDañado . "', '" .$Observacion."')";
$Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
    }
}

    if ($Resultado == true) {
        echo "Se han devuelto las herramientas";
    } else {
        echo "No fué posible";
    }
}

function ModalModificarPrestamo()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdPrestamo  = $_POST['IdPrestamo'];
    $InstruccionSQL = "SELECT prestamo.IdPrestamo, prestamo.Cantidad 
    AS CantidadPrestamo, herramientainsumo.Cantidad AS CantidadHerramienta FROM prestamo  
    INNER JOIN herramientainsumo 
    ON prestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
    WHERE IdPrestamo = " . $IdPrestamo;

    $Lista = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Lista as $key => $Value) {
        $CantidadTotal = $Value['CantidadHerramienta'] + $Value['CantidadPrestamo'];
        echo '
        <input type="hidden" id="Metodo" value="Modificar">
        <h3>Cantidad a modificar</h3>
<input type="hidden" id="IdPrestamo" value="' . $Value['IdPrestamo'] . '">
<input onclick="Validacion2()" onkeyup="Validacion2()" id="CantidadPrestamo" type="number" value="'.$Value['CantidadPrestamo'].'">

<label>Cantidad disponible</label>
<br>
<input type="number" readonly id="CantidadHerramienta" value="' . $CantidadTotal . '">
';
    };
};


function ModificarPrestamo()
{
    $IdPrestamo = $_POST["IdPrestamo"];
    $CantidadPrestamo = $_POST["CantidadPrestamo"];
    $Conexion = new PDODB();

    $Conexion->Conectar();

    
    $InstruccionSQL = "SELECT * FROM prestamo WHERE IdPrestamo = ".$IdPrestamo;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    
    foreach ($Resultado as $key => $Value) {
        ActHerramienta($Value['IdHerramientaInsumo'], $Value['Cantidad'], "+");
    }

    $InstruccionSQL = "UPDATE prestamo SET Cantidad = '" . $CantidadPrestamo . "'
         WHERE IdPrestamo = " . $IdPrestamo;

    $Modificado = $Conexion->EjecutarInstruccion($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        ActHerramienta($Value['IdHerramientaInsumo'], $CantidadPrestamo, "-");
    }


    if ($Modificado == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
};

function ModalDevolverHerramienta()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdPrestamo  = $_POST['IdPrestamo'];
    $InstruccionSQL = "SELECT prestamo.IdPrestamo, herramientainsumo.Tipo, prestamo.Cantidad 
    AS CantidadPrestamo, herramientainsumo.Cantidad AS CantidadHerramienta FROM prestamo  
    INNER JOIN herramientainsumo 
    ON prestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
    WHERE IdPrestamo = " . $IdPrestamo;

    $Lista = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Lista as $key => $Value) {
        if($Value['Tipo'] == "insumo" || $Value['Tipo'] == "Insumo"){
            echo '
            <input type="hidden" id="Metodo" value="Insumo">
            <h3>¿Esta seguro?</h3>
    <input type="hidden" id="IdPrestamo3" value="' . $Value['IdPrestamo'] . '">
    ';
        }
        else{
        echo '
        <input type="hidden" id="Metodo" value="Devolver">
        <h3>¿Se ha dañado alguna herramienta?</h3>
        <br>
        <select onclick="Siono()" id="Select" name="Select">
        <option value="no">No</option>
  <option value="si">Si</option>
 </select>
 <br>
<input type="hidden" id="IdPrestamo2" value="' . $Value['IdPrestamo'] . '">
<input id="CantidadBase" disabled type="hidden" value="'.$Value['CantidadPrestamo'].'">
<br>
<label id="Label1" style="display: none;">Ingrese la cantidad de herramientas dañadas</label>

<input onclick="Validacion3()" onkeyup="Validacion3()" id="CantidadDañado" style="display: none;" type="number" value="'.$Value['CantidadPrestamo'].'">
<label id="Label2" style="display: none;">Ingrese el motivo</label>
<input type="text" id="Observacion" class="input" style="display: none;">
';
    };
}};

function DevolverDañada(){
    $Id = $_POST['Id'];

    $Conexion = new PDODB();

    $Conexion->Conectar();


    $InstruccionSQL = "SELECT * FROM detalleprestamo WHERE IdDetallePrestamo = ".$Id;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    foreach ($Resultado as $key => $Value) {
        ActHerramienta($Value['IdHerramientaInsumo'], $Value['CantidadElemento'], "+");
    }
    $InstruccionSQL = "DELETE FROM detalleprestamo WHERE IdDetallePrestamo = ".$Id;
    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);

    if ($Resultado == true) {
        echo "Se han devuelto las herramientas";
    } else {
        echo "No fué posible";
    }}

    //fin admin

    //inicio empleado

    function ListarPrestamoEmpleado(){
        session_start();
        $IdEmpleado = $_SESSION['IdUsuario'];
        $Conexion = new PDODB();
        $Conexion->Conectar();
        $InstruccionSQL = "SELECT prestamo.IdEmpleado, prestamo.IdPrestamo, herramientainsumo.Tipo, prestamo.FechaPrestamo, 
        prestamo.Cantidad AS CantidadPrestamo,
        herramientainsumo.Nombre AS NombreHerramienta FROM prestamo 
         INNER JOIN herramientainsumo 
         ON prestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
         INNER JOIN empleado ON prestamo.IdEmpleado=empleado.IdEmpleado 
         WHERE prestamo.IdEmpleado=" . $IdEmpleado;

        $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
        
        foreach ($Resultado as $key => $Value) {
        echo '<tr>
            <td class="pt-3-half" contenteditable="false">'.$Value['IdPrestamo'].'</td>
            <td class="pt-3-half" contenteditable="false">'.$Value['NombreHerramienta'].'</td>
            <td class="pt-3-half" contenteditable="false">'.$Value['Tipo'].'</td>
            <td class="pt-3-half" contenteditable="false">'.$Value['FechaPrestamo'].'</td>
            <td class="pt-3-half" contenteditable="false">'.$Value['CantidadPrestamo'].'</td>
      </tr>';
        }   
    }