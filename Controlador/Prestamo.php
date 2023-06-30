<?php
require_once '../Modelo/Conexion.php';
switch ($_POST['Metodo']) {
        // Inicio Realizar Prestamo 
    case 'ListarRealizarP':
        ListarRealizarP();
        break;
    case 'Prestar':
        Prestar();
        break;
    case 'ListarNombresEmpleado':
        ListarNombresEmpleado();
        break;
    case 'ListarNombresHerramienta':
        ListarNombresHerramienta();
        break;
    case 'ListarPrestamoAdmin':
        ListarPrestamoAdmin();
        break;
    case 'ListarPrestamoDañado':
        ListarPrestamoDañado();
        break;
    case 'DevolverHerramienta':
        DevolverHerramienta();
        break;
    case 'ModalModificarPrestamo':
        ModalModificarPrestamo();
        break;
    case 'ModificarPrestamo':
        ModificarPrestamo();
        break;
    case 'ModalDevolverHerramienta':
        ModalDevolverHerramienta();
        break;
    case 'DevolverHerramienta':
        DevolverHerramienta();
        break;
    case 'DevolverDañada':
        DevolverDañada();
        break;
    case 'ListarPrestamoEmpleado':
        ListarPrestamoEmpleado();
        break;
    case 'EliminarInsumo':
        EliminarInsumo();
        break;
    case 'ListarDanadaEmpleado':
        ListarDanadaEmpleado();
        break;
    case 'CambiarAdmin':
        CambiarAdmin();
        break;
        case 'CambiarEmpleado':
            CambiarEmpleado();
            break;
            case 'ListarNombresEmpleadoPrestados':
                ListarNombresEmpleadoPrestados();
                break;

        // Fin Realizar Prestamo
}
// Inicio Realizar Prestamo 
function ListarRealizarP()
{

    $Tipo = $_POST['Tipo'];
    $Conexion = new PDODB();

    $Conexion->Conectar();
    if ($Tipo != "No") {
        $Nombre = $_POST['Nombre'];

        $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE Cantidad > 0 AND Nombre='" . $Nombre . "' AND Tipo='" . $Tipo . "' AND Estado = 1";
    } else {
        $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE Cantidad > 0 AND Estado = 1";
    }
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<tr>
        <td class="pt-3-half" contenteditable="false"><input id="Nombre' . $Value['IdHerramientaInsumo'] . '" type="hidden" value="' . $Value['Nombre'] . '">' . $Value['Nombre'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" id="Tipo' . $Value['IdHerramientaInsumo'] . '" value="' . $Value['Tipo'] . '">' . $Value['Tipo'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="' . $Value['Categoria'] . '">' . $Value['Categoria'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="' . $Value['Descripcion'] . '">' . $Value['Descripcion'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="' . $Value['Color'] . '">' . $Value['Color'] . '</td>
        <td class="pt-3-half" contenteditable="false"><input type="hidden" value="' . $Value['Medida'] . '">' . $Value['Medida'] . '</td>

        <input type="hidden" id="cantidadd' . $Value['IdHerramientaInsumo'] . '" value="' . $Value['Cantidad'] . '">
        <td class="pt-3-half" contenteditable="false"><input class="cantidadAsignar" onclick="Validacion(' . $Value['IdHerramientaInsumo'] . ')"  onkeyup="Validacion(' . $Value['IdHerramientaInsumo'] . ')" id="cantidad' . $Value['IdHerramientaInsumo'] . '" type="number" value="' . $Value['Cantidad'] . '"></td>
        <td><img src="../Vista/Assets/Iconos/agregar.svg" alt="" id="boton' . $Value['IdHerramientaInsumo'] . '"  class="amarillo" onclick="Asignar(' . $Value['IdHerramientaInsumo'] . ')"></td>
    </tr>';
        if ($Tipo != "No") {
            echo '<script>          
            CambiarImagen(' . $Value['IdHerramientaInsumo'] . ');
    </script>';
        }
    }
}





































function GuardarDetallePrestamo($Cantidad, $Ides, $IdPrestamo, $Conexion)
{
    //validar si ya se ha prestado
    for ($i = 0; $i < count($Ides); $i++) {
        $Valida = 0;
        $Cosa = 0;
        $Cosa2 = 0;
        $sql = "SELECT * FROM detalleprestamo 
        INNER JOIN herramientainsumo USING(IdHerramientaInsumo)
        WHERE IdHerramientaInsumo = " . $Ides[$i] . " AND IdPrestamo = " . $IdPrestamo;

        $resul = $Conexion->ObtenerDatos($sql);

        foreach ($resul as $key => $Value) {
            $Valida = 1;
            $NombreHerramienta = $Value['Nombre'];
        }
        if ($Valida > 0) {
            if ($Cosa == 0) {
                echo "Ya le has prestado al empleado la herramienta con el nombre: ";
                $Cosa++;
            }
            echo $NombreHerramienta;
        }
        //si no se ha prestado tons se hara
        else {
            $Cosa2++;
            $InstruccionSQL = "INSERT INTO detalleprestamo
            VALUES
            (null,'" . $IdPrestamo . "', '" . $Ides[$i] . "','" . $Cantidad[$i] . "')";

            $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
            ActHerramienta($Ides[$i], $Cantidad[$i], "-");
        }
    }
    if ($Cosa2 > 0) {
        echo "\n Se ha realizado el prestamo";
    } else {
        echo "\n No fué posible prestar";
    }
}
function ObtenerIdPrestamo($IdEmpleado, $Conexion)
{
    $sql = "SELECT * FROM prestamo
    WHERE IdUsuario = " . $IdEmpleado;
    $resul = $Conexion->ObtenerDatos($sql);
    foreach ($resul as $key => $Value) {
        return $Value['IdPrestamo'];
    }
}
function Prestar()
{
    $Ides = $_POST['Ides'];
    $Cantidad = $_POST['Cantidades'];
    $IdEmpleado = $_POST['IdEmpleado'];
    date_default_timezone_set('America/Mexico_City');

    $FechaActual = date("d-m-Y");

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $sql = "SELECT * FROM prestamo
    WHERE IdUsuario = " . $IdEmpleado;

    $resul = $Conexion->ObtenerDatos($sql);
    $Valida = 0;
    foreach ($resul as $key => $Value) {
        $Valida = 1;
    }
    if ($Valida == 0) {
        $InstruccionSQL = "INSERT INTO prestamo
        VALUES
        (null,'" . $IdEmpleado . "','" . $FechaActual . "')";
        $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
    }
    GuardarDetallePrestamo($Cantidad, $Ides, ObtenerIdPrestamo($IdEmpleado, $Conexion), $Conexion);
}





























function ActHerramienta($Id, $Cantidad, $Operacion)
{

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE IdHerramientaInsumo= '" . $Id . "'";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        $CantidadHerramienta = $Value['Cantidad'];
    }
    if ($Operacion == "-") {
        $Resultado = $CantidadHerramienta - $Cantidad;
    } else {
        $Resultado = $CantidadHerramienta + $Cantidad;
    }
    $InstruccionSQL = "UPDATE herramientainsumo  
SET
Cantidad = " . $Resultado . "
WHERE IdHerramientaInsumo = '" . $Id . "'";

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
}
function ListarNombresEmpleado()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();
    $InstruccionSQL = "SELECT * FROM usuario";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);


    foreach ($Resultado as $key => $Value) {
        echo '<option value="' . $Value["IdUsuario"] . '">' . $Value["Nombre"] . '</option>';
    }
}
function ListarNombresHerramienta()
{
    $Tipo = $_POST['Tipo'];
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE Cantidad > 0 AND Tipo = '" . $Tipo . "'";
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<option value="' . $Value["Nombre"] . '">' . $Value["Nombre"] . '</option>';
    }
}
// Fin Realizar Prestamo

//Lista admin

function ListarPrestamoAdmin()
{
    $NombreEmpleado = $_POST['NombreEmpleado'];
    $Conexion = new PDODB();
    $Conexion->Conectar();


    if ($NombreEmpleado != -999) {
        $InstruccionSQL = "SELECT detalleprestamo.IdPrestamo, detalleprestamo.IdDetallePrestamo, prestamo.FechaPrestamo, herramientainsumo.Tipo, detalleprestamo.CantidadElemento AS
    CantidadPrestamo, usuario.Nombre AS NombreEmpleado, herramientainsumo.Nombre AS 
    NombreHerramienta FROM detalleprestamo INNER JOIN herramientainsumo ON 
    detalleprestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
    INNER JOIN prestamo ON 
     detalleprestamo.IdPrestamo=prestamo.IdPrestamo
     INNER JOIN usuario ON prestamo.IdUsuario=usuario.IdUsuario WHERE prestamo.IdUsuario=" . $NombreEmpleado;
    } else {
        $InstruccionSQL = "SELECT detalleprestamo.IdPrestamo, detalleprestamo.IdDetallePrestamo, prestamo.FechaPrestamo, herramientainsumo.Tipo, detalleprestamo.CantidadElemento AS
     CantidadPrestamo, usuario.Nombre AS NombreEmpleado, herramientainsumo.Nombre AS 
     NombreHerramienta FROM detalleprestamo INNER JOIN herramientainsumo ON 
     detalleprestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
     INNER JOIN prestamo ON 
      detalleprestamo.IdPrestamo=prestamo.IdPrestamo
      INNER JOIN usuario ON prestamo.IdUsuario=usuario.IdUsuario";
    }
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<tr>
        <td class="pt-3-half" contenteditable="false">' . $Value['IdPrestamo'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['IdDetallePrestamo'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['NombreEmpleado'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['NombreHerramienta'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['Tipo'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['FechaPrestamo'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['CantidadPrestamo'] . '</td>
        <td>
        <img src="..\Vista\Assets\Iconos\devolver.svg" class="IconoTabla"  onclick="ModalDevolverHerramienta(' . $Value['IdDetallePrestamo'] . ')" >
        &nbsp; &nbsp;
        <img src="..\Vista\Assets\Iconos\editar.svg" class="IconoTabla" onclick="ModalModificarPrestamo(' . $Value['IdDetallePrestamo'] . ')" ></td>
        </tr>';
    }
}

function ListarNombresEmpleadoPrestados()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();
    $InstruccionSQL = "SELECT * FROM prestamo INNER JOIN usuario USING(IdUsuario) WHERE IdUsuario = IdUsuario";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);


    foreach ($Resultado as $key => $Value) {
        echo '<option value="' . $Value["IdUsuario"] . '">' . $Value["Nombre"] . '</option>';
    }
}

function EliminarInsumo()
{
    $IdDetallePrestamo = $_POST['IdDetallePrestamo'];

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM detalleprestamo WHERE IdDetallePrestamo = " . $IdDetallePrestamo;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    foreach ($Resultado as $key => $Value) {
        $IdPrestamo = $Value['IdPrestamo'];
    }

    $InstruccionSQL = "DELETE FROM detalleprestamo WHERE IdDetallePrestamo = " . $IdDetallePrestamo;
    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);


    CasoEliminarPrestamo($IdPrestamo, $Conexion);


    if ($Resultado == true) {
        echo "Se han usado los insumos";
    } else {
        echo "No fué posible";
    }
}

function ListarPrestamoDañado()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSQL = "SELECT herramientadanada.IdHerramientaDanada, herramientadanada.CantidadElemento, herramientadanada.Observacion, herramientainsumo.Nombre AS NombreHerramienta, usuario.Nombre AS NombreEmpleado  FROM herramientadanada INNER JOIN herramientainsumo USING(IdHerramientaInsumo) INNER JOIN usuario USING(IdUsuario)";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<tr>
    <td class="pt-3-half" contenteditable="false">' . $Value['IdHerramientaDanada'] . '</td>
    <td class="pt-3-half" contenteditable="false">' . $Value['NombreEmpleado'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['NombreHerramienta'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['CantidadElemento'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['Observacion'] . '</td>
        <td><input type="button" value="Arreglado" class="Estado Activo" onclick="DevolverDañada(' . $Value['IdHerramientaDanada'] . ')">
</td>
        </tr>';
    }
}
function DevolverHerramienta()
{
    $IdDetallePrestamo = $_POST['IdDetallePrestamo'];
    $Select = $_POST['Select'];
    $CantidadDañado = $_POST['CantidadDañado'];
    $Observacion = $_POST['Observacion'];

    $Conexion = new PDODB();

    $Conexion->Conectar();

    if ($Select == "no") {
        $InstruccionSQL = "SELECT * FROM detalleprestamo WHERE IdDetallePrestamo = " . $IdDetallePrestamo;
        $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
        foreach ($Resultado as $key => $Value) {
            ActHerramienta($Value['IdHerramientaInsumo'], $Value['CantidadElemento'], "+");
            $IdPrestamo = $Value['IdPrestamo'];
        }
        $InstruccionSQL = "DELETE FROM detalleprestamo WHERE IdDetallePrestamo = " . $IdDetallePrestamo;
        $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
    } else {
        $InstruccionSQL = "SELECT * FROM detalleprestamo INNER JOIN prestamo USING(IdPrestamo) WHERE IdDetallePrestamo = " . $IdDetallePrestamo;
        $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
        foreach ($Resultado as $key => $Value) {
            $Devolver = $Value['CantidadElemento'] - $CantidadDañado;
            ActHerramienta($Value['IdHerramientaInsumo'], $Devolver, "+");
            $InstruccionSQL = "DELETE FROM detalleprestamo WHERE IdDetallePrestamo = " . $IdDetallePrestamo;
            $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
            $InstruccionSQL = "INSERT INTO herramientadanada  
        VALUES
        (null,'" . $Value['IdHerramientaInsumo'] . "','" . $Value['IdUsuario'] . "', '" . $CantidadDañado . "', '" . $Observacion . "')";
            $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
            $IdPrestamo = $Value['IdPrestamo'];
        }
    }
    CasoEliminarPrestamo($IdPrestamo, $Conexion);
    if ($Resultado == true) {
        echo "Se han devuelto las herramientas";
    } else {
        echo "No fué posible";
    }
}

function CasoEliminarPrestamo($IdPrestamo, $Conexion)
{
    $InstruccionSQL = "SELECT * FROM detalleprestamo WHERE IdPrestamo = " . $IdPrestamo;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    $Valida = 0;
    foreach ($Resultado as $key => $Value) {
        $Valida = 1;
    }
    if ($Valida == 0) {
        $InstruccionSQL = "DELETE FROM prestamo WHERE IdPrestamo = " . $IdPrestamo;
        $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
    }
}

function ModalModificarPrestamo()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdDetallePrestamo  = $_POST['IdDetallePrestamo'];
    $InstruccionSQL = "SELECT detalleprestamo.IdDetallePrestamo, detalleprestamo.CantidadElemento 
    AS CantidadPrestamo, herramientainsumo.Cantidad AS CantidadHerramienta FROM detalleprestamo  
    INNER JOIN herramientainsumo 
    ON detalleprestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
    WHERE IdDetallePrestamo = " . $IdDetallePrestamo;

    $Lista = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Lista as $key => $Value) {
        $CantidadTotal = $Value['CantidadHerramienta'] + $Value['CantidadPrestamo'];
        echo '
        <input type="hidden" id="Metodo2" value="Modificar">
        <h3>Cantidad a modificar</h3>
<input type="hidden" id="IdDetallePrestamo" value="' . $Value['IdDetallePrestamo'] . '">
<input onclick="Validacion2()" onkeyup="Validacion2()" id="CantidadPrestamo" type="number" value="' . $Value['CantidadPrestamo'] . '">

<label>Cantidad disponible</label>
<br>
<input type="number" readonly id="CantidadHerramienta" value="' . $CantidadTotal . '">
';
    };
};


function ModificarPrestamo()
{
    $IdDetallePrestamo = $_POST["IdDetallePrestamo"];
    $CantidadPrestamo = $_POST["CantidadPrestamo"];
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM detalleprestamo WHERE IdDetallePrestamo = " . $IdDetallePrestamo;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        ActHerramienta($Value['IdHerramientaInsumo'], $Value['CantidadElemento'], "+");
    }

    $InstruccionSQL = "UPDATE detalleprestamo SET CantidadElemento = '" . $CantidadPrestamo . "'
         WHERE IdDetallePrestamo = " . $IdDetallePrestamo;

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
    $IdDetallePrestamo  = $_POST['IdDetallePrestamo'];
    $InstruccionSQL = "SELECT detalleprestamo.IdDetallePrestamo, herramientainsumo.Tipo, detalleprestamo.CantidadElemento 
    AS CantidadPrestamo, herramientainsumo.Cantidad AS CantidadHerramienta FROM detalleprestamo  
    INNER JOIN herramientainsumo 
    ON detalleprestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
    WHERE IdDetallePrestamo = " . $IdDetallePrestamo;

    $Lista = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Lista as $key => $Value) {
        if ($Value['Tipo'] == "insumo" || $Value['Tipo'] == "Insumo") {
            echo '
            <input type="hidden" id="Metodo2" value="Insumo">
            <h3>¿Esta seguro de que utilizo los insumos?</h3>
    <input type="hidden" id="IdDetallePrestamo3" value="' . $Value['IdDetallePrestamo'] . '">
    ';
        } else {
            echo '
        <input type="hidden" id="Metodo2" value="Devolver">
        <h3>¿Se ha dañado alguna herramienta?</h3>
        <br>
        <select onclick="Siono()" id="Select" name="Select">
        <option value="no">No</option>
  <option value="si">Si</option>
 </select>
 <br>
<input type="hidden" id="IdDetallePrestamo2" value="' . $Value['IdDetallePrestamo'] . '">
<input id="CantidadBase" disabled type="hidden" value="' . $Value['CantidadPrestamo'] . '">
<br>
<label id="Label1" style="display: none;">Ingrese la cantidad de herramientas dañadas</label>

<input onclick="Validacion3()" onkeyup="Validacion3()" id="CantidadDañado" style="display: none;" type="number" value="' . $Value['CantidadPrestamo'] . '">
<label id="Label2" style="display: none;">Ingrese el motivo</label>
<input type="text" id="Observacion" class="input" style="display: none;">
';
        };
    }
};

function DevolverDañada()
{
    $Id = $_POST['Id'];

    $Conexion = new PDODB();

    $Conexion->Conectar();


    $InstruccionSQL = "SELECT * FROM herramientadanada WHERE IdHerramientaDanada = " . $Id;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    foreach ($Resultado as $key => $Value) {
        ActHerramienta($Value['IdHerramientaInsumo'], $Value['CantidadElemento'], "+");
    }
    $InstruccionSQL = "DELETE FROM herramientadanada WHERE IdHerramientaDanada = " . $Id;
    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);

    if ($Resultado == true) {
        echo "Se han devuelto las herramientas";
    } else {
        echo "No fué posible";
    }
}

function CambiarAdmin(){
    if ($_POST['Cambio'] == "Dañada"){
        echo '
    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Empleado</th>
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
    <script>
    $(document).ready(function() {
 
        ListarPrestamoDañado();

    });
</script>
    '
    ;
    }    
    else {
        echo '
        
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
        <script>
    $(document).ready(function() {
        ListarPrestamoAdmin(-999);
        ListarNombresEmpleado();
    });
</script>
';
    }
}

//fin admin

//inicio empleado

function ListarPrestamoEmpleado()
{
    session_start();
    $IdEmpleado = $_SESSION['IdUsuario'];
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $InstruccionSQL = "SELECT prestamo.IdUsuario, detalleprestamo.IdPrestamo, detalleprestamo.IdDetallePrestamo ,herramientainsumo.Tipo, prestamo.FechaPrestamo, 
        detalleprestamo.CantidadElemento AS CantidadPrestamo,
        herramientainsumo.Nombre AS NombreHerramienta FROM detalleprestamo 
         INNER JOIN herramientainsumo 
         ON detalleprestamo.IdHerramientaInsumo=herramientainsumo.IdHerramientaInsumo 
         INNER JOIN prestamo 
         ON detalleprestamo.IdPrestamo=prestamo.IdPrestamo 
         INNER JOIN usuario ON prestamo.IdUsuario=usuario.IdUsuario 
         WHERE prestamo.IdUsuario=" . $IdEmpleado;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<tr>
            <td class="pt-3-half" contenteditable="false">' . $Value['IdDetallePrestamo'] . '</td>
            <td class="pt-3-half" contenteditable="false">' . $Value['NombreHerramienta'] . '</td>
            <td class="pt-3-half" contenteditable="false">' . $Value['Tipo'] . '</td>
            <td class="pt-3-half" contenteditable="false">' . $Value['FechaPrestamo'] . '</td>
            <td class="pt-3-half" contenteditable="false">' . $Value['CantidadPrestamo'] . '</td>
      </tr>';
    }
}

function ListarDanadaEmpleado()
{
    session_start();
    $IdEmpleado = $_SESSION['IdUsuario'];
    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSQL = "SELECT herramientadanada.IdHerramientaDanada, herramientadanada.CantidadElemento, herramientadanada.Observacion, herramientainsumo.Nombre AS NombreHerramienta, usuario.Nombre AS NombreEmpleado  FROM herramientadanada INNER JOIN herramientainsumo USING(IdHerramientaInsumo) INNER JOIN usuario USING(IdUsuario) WHERE IdUsuario =".$IdEmpleado;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<tr>
    <td class="pt-3-half" contenteditable="false">' . $Value['IdHerramientaDanada'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['NombreHerramienta'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['CantidadElemento'] . '</td>
        <td class="pt-3-half" contenteditable="false">' . $Value['Observacion'] . '</td>
</td>
   </tr>';
    }
}

function CambiarEmpleado(){
    if ($_POST['Cambio'] == "Dañada"){
echo '

<main class="table">
    <section class="TableBody">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Herramienta</th>
                    <th>Cantidad</th>
                    <th>Observacion</th>
                </tr>
            </thead>
            <tbody id="ListarDanadaEmpleado">
            </tbody>
        </table>
    </section>
</main>
<script>
    $(document).ready(function() {
        ListarDanadaEmpleado();
    });
</script>
';
    }
    else{
        echo '   

    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Herramienta</th>
                    <th>Tipo</th>
                    <th>Fecha Registro</th>
                    <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="ListarPrestamoEmpleado">


 
            
                </tbody>
            </table>
        </section>
    </main>
    <script>
    $(document).ready(function() {
        ListarPrestamoEmpleado();
    });
</script>
    ';
    }}