<?php
include("../Modelo/Conexion.php");
switch ($_POST['Metodo']) {
    case 'ListarServicios':
        ListarServicios();
        break;
    case 'GuardarServicio':
        GuardarServicio();
        break;
    case 'DesactivarServicio':
        DesactivarServicio();
        break;
    case 'ModalListar':
        ModalListar();
        break;
    case 'ModificarListar':
        ModificarListar();
        break;
}

function GuardarServicio()
{

    $Nombre = $_POST["Nombre"];
    $Estado = "2";


    $conexion = new PDODB();

    $conexion->Conectar();

    $InstruccionSQL = "INSERT INTO servicio 
        VALUES
        (null,'" .  $Nombre . "','" .  $Estado . "')";

    $resultado = $conexion->EjecutarInstruccion($InstruccionSQL);

    if ($resultado == true) {
        echo "Se ha guardar con exito";
    } else {
        echo "No se ha guardar con exito";
    }
}

function ListarServicios()
{

    $conexion = new PDODB();

    $conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM servicio";

    $resultado = $conexion->ObtenerDatos($InstruccionSQL);


    foreach ($resultado as $fila) {
        $StringEstado = "";
        $Color = "Estado Inactivo";
        if ($fila['Estado'] == "1") {
            $Color = "Estado Activo";
            $StringEstado = "Activo";
        } else {
            $StringEstado = "Desactivado";
        }

        echo '
        <tr>
        <td >', $fila['Nombre'], '</td>
        <td ><button class="', $Color, '">', $StringEstado, ' </button> ', '</td>
      <td><a href="#"><img onclick="ModalListar(' . $fila['IdServicio'] . ')" src="assets/Iconos/editar.svg" alt="" class="IconoTabla"> </a>
        <a href="#"><img onclick="DesactivarServicio(' . $fila['IdServicio'] . ', ' . $fila['Estado'] . ')" src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla"> </a></td>
        </tr>
       
        ';
    }
}

function DesactivarServicio()
{

    $conexion = new PDODB();

    $conexion->Conectar();

    $tablaServicio = "servicio";

    $IdServicio = $_POST['IdServicio'];
    $Estado = $_POST['Estado'];
    $ArrayTablasRelacionadas = array();

    if ($Estado == 1) {
        $Estado = 0;
    } else {
        $Estado = 1;
    }

    try {
        $consultaInfoServicio = "SHOW CREATE TABLE $tablaServicio";
        $resultadoInfoServicio = $conexion->EjecutarInstruccion($consultaInfoServicio);
        $definicionServicio = $resultadoInfoServicio->fetchColumn(1);
    } catch (PDOException $e) {
        echo "Error al obtener información de la tabla servicios: " . $e->getMessage();
        return;
    }

    try {
        $consultaTablasRelacionadas = "SHOW TABLES";
        $resultadoTablasRelacionadas = $conexion->EjecutarInstruccion($consultaTablasRelacionadas);

        while ($filaTablaRelacionada = $resultadoTablasRelacionadas->fetch(PDO::FETCH_NUM)) {
            $tablaRelacionada = $filaTablaRelacionada[0];

            if ($tablaRelacionada != $tablaServicio) {
                $consultaInfoTablaRelacionada = "SHOW CREATE TABLE $tablaRelacionada";
                $resultadoInfoTablaRelacionada = $conexion->EjecutarInstruccion($consultaInfoTablaRelacionada);
                $definicionTablaRelacionada = $resultadoInfoTablaRelacionada->fetchColumn(1);

                if (strpos($definicionTablaRelacionada, 'FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`)') !== false) {

                    // Verificar si hay datos relacionados
                    $consultaDatosRelacionados = "SELECT * FROM $tablaRelacionada WHERE IdServicio IN (SELECT IdServicio FROM servicio WHERE IdServicio = $IdServicio)";
                    $resultadoDatosRelacionados = $conexion->EjecutarInstruccion($consultaDatosRelacionados);

                    if ($resultadoDatosRelacionados->rowCount() > 0) {
                        $ArrayTablasRelacionadas[] = " " . $tablaRelacionada;
                    }
                    //  else {
                    //     echo "No hay datos relacionados en la tabla $tablaRelacionada.<br>";
                    // }
                }
            }
        }
    } catch (PDOException $e) {
        echo "Error al buscar tablas relacionadas: " . $e->getMessage();
        return;
    }

    if (empty($ArrayTablasRelacionadas)) {

        $Sql = "UPDATE servicio SET Estado = '" . $Estado . "'
    WHERE IdServicio = " . $IdServicio;

        $Modificado = $conexion->EjecutarInstruccion($Sql);
        $Modificados = $conexion->EjecutarInstruccion($Sql);

        if ($Modificado == true && $Estado == 0) {
            echo "Desactivado correctamente";
        } else if ($Modificado == true && $Estado == 1) {
            echo "Activado correctamente";
        } else {
            echo "No fue posible modificar";
        }
    } else {
        echo "El usuario tiene datos relacionados en los siguientes modulos: ";
        for ($i = 0; $i < count($ArrayTablasRelacionadas); $i++) {
            echo $ArrayTablasRelacionadas[$i] . " ";
        }
    }
}


function ModalListar()
{
    $conexion = new PDODB();
    $conexion->Conectar();
    $IdServicio = $_POST['IdServicio'];
    $sql = "SELECT * FROM servicio WHERE IdServicio  = " . $IdServicio;
    $lista = $conexion->ObtenerDatos($sql);
    $formHtml = "";

    foreach ($lista as $key => $value) {
        echo '
        <input id="Servicio" type="hidden" value = "' . $value['IdServicio'] . '">
        <p>Nombre Del Servicio</p>
        <input type="text" id="NombreServicio" value="' . $value['Nombre'] . '" placeholder="Ingrese nombre del Servicio" ><img class="iconosagendamiento" src="icons/cliente.png" alt="">
    
     ';
    }
}


function ModificarListar()
{

    $IdServicio = $_POST["IdServicio"];
    $Nombre = $_POST["Nombre"];
    $Estado = "Activado";


    $conexion = new PDODB();

    $conexion->Conectar();

    $sql = "UPDATE Servicio SET 
        Nombre = '" . $Nombre . "',
        Estado = '" . $Estado . "'
        WHERE IdServicio = " . $IdServicio;

    $modificado = $conexion->EjecutarInstruccion($sql);

    if ($modificado == true) {
        echo "Modificado correctamente ";
    } else {
        echo "No fue posible modificar";
    }
}

