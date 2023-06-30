<?php
include("../Modelo/Conexion.php");
switch ($_POST['metodo']) {
    case 'GuardarNovedad':
        GuardarNovedad();
        break;
    case 'ListarNovedad':
        ListarNovedad();
        break;
    case 'ModalNovedad':
        ModalNovedad();
        break;
    case 'ModificarNovedad':
        ModificarNovedad();
        break;
    case 'ListarNovedades':
        ListarNovedades();
        break;
    case 'ModalAceptarNovedad':
        ModalAceptarNovedad();
        break;
    case 'ModalRechazarNovedad':
        ModalRechazarNovedad();
        break;
    case 'AceptarRechazarNovedad':
        AceptarRechazarNovedad();
        break;
}
function GuardarNovedad()
{
    session_start();
    date_default_timezone_set('America/Bogota');
    $IdUsuario = $_SESSION["IdUsuario"];
    $Peticion = $_POST["Peticion"];
    $Descripcion = $_POST["Descripcion"];
    $Cambio = $_POST["Cambio"];
    $HoraInicio = $_POST["HoraInicio"];
    $HoraFinal = $_POST["HoraFinal"];
    $FechaInicio = $_POST["FechaInicio"];
    $FechaFinal = $_POST["FechaFinal"];
    $EstadoNovedad = 2;
    $FechaRegistro = date('d/m/Y H:i:s');

    if ($Cambio == "No") {
        $HoraInicio = "No";
        $HoraFinal = "No";
    }

    $Conexion = new PDODB();

    $Conexion->Conectar();

    try {
        $InstruccionSQL = "INSERT INTO novedad VALUES (null,'" . $IdUsuario . "', '" . $Peticion . "','" . $Descripcion . "','" . $FechaRegistro . "','" . $FechaInicio . "','" . $FechaFinal . "','" . $HoraInicio . "', '" . $HoraFinal . "', '" . $EstadoNovedad . "')";
        $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
        echo "Novedad guardada correctamente";
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }

    if ($Resultado == true) {
        echo "GUARDADO CORRECTAMENTE";
    } else {
        echo "NO SE PUDO GUARDAR";
    }
}

// LISTAR MIS NOVEDADES
function ListarNovedad()
{
    session_start();

    $IdUsuario = $_SESSION["IdUsuario"];

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM novedad WHERE IdUsuario=" . $IdUsuario;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $fila) {
        echo '
        <tr >
        <td >', $fila['FechaRegistro'], '</td>
        <td >', $fila['Peticion'], '</td>
        <td >', $fila['Descripcion'], '</td>
        <td >', $fila['FechaInicio'], '</td>
        <td >', $fila['FechaFinal'], '</td>
        <td >', $fila['HoraInicio'], '</td>
        <td >', $fila['HoraFinal'], '</td><td> <buttom class="';
        //ESTADOS
        if ($fila["EstadoNovedad"] == 0) {
            echo "Estado Rechazado";
        } else if ($fila["EstadoNovedad"] == 1) {
            echo "Estado Aceptado";
        } else if ($fila["EstadoNovedad"] == 2) {
            echo "Estado Espera";
        }

        echo '"</buttom>';
        if ($fila["EstadoNovedad"] == 0) {
            echo "Rechazado";
        } else if ($fila["EstadoNovedad"] == 1) {
            echo "Aceptado";
        } else if ($fila["EstadoNovedad"] == 2) {
            echo "En Espera";
        } else {
            echo "Ups, hubo un error";
        }
        echo '</td>
        <td >
            <center>';
        if ($fila['EstadoNovedad'] == 1) {
            echo '<a>Ya esta aceptado</a>';
        } else if ($fila['EstadoNovedad'] == 2) {
            echo '<a onclick="ModalNovedad(' . $fila['IdNovedad'] . '); window.modal.showModal();" name="EditarNovedad">
                <img src="../Vista/Assets/Iconos/editar.svg" alt="" class="IconoTabla">&nbsp;&nbsp;</a>
                <a onclick="DesactivarNovedad(' . $fila['IdNovedad'] . ',' . $fila['EstadoNovedad'] . ')" name="desactivar_novedad">
                <img src="../Vista/Assets/Iconos/desactivar.svg" alt="" class="IconoTabla"></a>
                </a>';
        } else {
            echo '<a>Ya esta rechazada</a>';
        }
        echo '</center>
        </td>
        </tr>
        ';
    }
}


function AceptarRechazarNovedad()
{
    $IdNovedad = $_POST["IdNovedad"];
    $Cambio = $_POST["opcion"];

    $Conexion = new PDODB();

    $Conexion->Conectar();


    $InstruccionSQL = "UPDATE novedad SET EstadoNovedad = '" . $Cambio . "' WHERE IdNovedad = " . $IdNovedad;

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);

    if ($Cambio == 1 && $Resultado == true) {
        echo "Novedad aceptada con exito";
    } else if ($Cambio == 0 && $Resultado == true) {
        echo "Novedad rechazada con exito";
    } else {
        echo "Ups, hubo un error";
    }
}

function ModalNovedad()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdNovedad  = $_POST['IdNovedad'];
    $sql = "SELECT * FROM novedad WHERE IdNovedad  = " . $IdNovedad;
    $lista = $Conexion->ObtenerDatos($sql);

    foreach ($lista as $key => $value) {
        echo '

<input type="hidden" id="IdNovedad" name="IdNovedad" value="' . $value['IdNovedad'] . '">
    <center>
        <img src="icons/logo.png" alt="logo">
        <br><br>
    </center>
    <div class="caja_registrar_novedad">
        <label for="">Petición</label>
        <br>
        <input class="input_largo_registrar_novedad" type="text" name="Peticion" id="Peticion" value="' . $value['Peticion'] . '">
        <br><br>
        <label for="">Descripción</label>
        <br>
        <input class="input_largo_registrar_novedad" type="text" name="Descripcion" id="Descripcion" value="' . $value['Descripcion'] . '">
        <br><br>
        <label for="">Desea hacer un Cambio en el horario de trabajo?</label>';

        if ($value['HoraFinal'] == "No") {

            echo '
        <select name="Cambio" id="Cambio">
            <option value="no">No</option>
            <option value="si">Si</option>
        </select>
        <br><br>
        <label for="">Desde la hora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta la hora</label>
        <br>
        <input type="time" class="input_pequeño_registrar_novedad" name="HoraInicio" id="HoraInicio" disabled>&nbsp;&nbsp;&nbsp;<input type="time"
            class="input_pequeño_registrar_novedad" name="HoraFinal" id="HoraFinal" disabled>';
        } else {

            echo '
            <select name="Cambio" id="Cambio">
            <option value="si">Si</option>
            <option value="no">No</option>
            </select>
            <br><br>
            <label for="">Desde la hora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta la hora</label>
            <br>
            <input type="time" class="input_pequeño_registrar_novedad" name="HoraInicio" id="HoraInicio" value="' . $value['HoraInicio'] . '">&nbsp;&nbsp;&nbsp;<input type="time" class="input_pequeño_registrar_novedad" name="HoraFinal" id="HoraFinal" value="' . $value['HoraFinal'] . '">';
        }


        echo '       <br><br>
        <label for="">Desde el dia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta el dia</label>
        <br>
        <input type="date" class="input_pequeño_registrar_novedad" name="FechaInicio" id="FechaInicio" value="' . $value['FechaInicio'] . '">&nbsp;&nbsp;&nbsp;<input type="date"
            class="input_pequeño_registrar_novedad" name="FechaFinal" id="FechaFinal" value="' . $value['FechaFinal'] . '">
        <br><br>
    </div>


<script>
document.getElementById("Cambio") .onclick = function() { 
    if (document.getElementById("Cambio").value == "si") 
    {
        document.getElementById("HoraInicio").disabled = false 
        document.getElementById("HoraFinal").disabled = false
    }
    else{
        
        document.getElementById("HoraInicio").disabled = true 
        document.getElementById("HoraFinal").disabled = true
    }
    }; </script>

     ';
    }
}

function ModalAceptarNovedad()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdNovedad  = $_POST['IdNovedad'];
    $sql = "SELECT * FROM novedad WHERE IdNovedad  = " . $IdNovedad;
    $lista = $Conexion->ObtenerDatos($sql);

    foreach ($lista as $key => $value) {
        echo '
        <h3>¿Estas seguro de aceptar esta novedad?</h3>
        <input type="hidden" id="IdNovedad" name="IdNovedad" value="' . $value['IdNovedad'] . '">
        <input type="hidden" id="opcion" name="opcion" value="1">';
    };
};

function ModalRechazarNovedad()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdNovedad  = $_POST['IdNovedad'];
    $sql = "SELECT * FROM novedad WHERE IdNovedad  = " . $IdNovedad;
    $lista = $Conexion->ObtenerDatos($sql);

    foreach ($lista as $key => $value) {
        echo '
        <h3>¿Estas seguro de rechazar esta novedad?</h3>
        <input type="hidden" id="IdNovedad" name="IdNovedad" value="' . $value['IdNovedad'] . '">
        <input type="hidden" id="opcion" name="opcion" value="2">';
    };
};


function ModificarNovedad()
{
    $IdNovedad = $_POST["IdNovedad"];
    $Peticion = $_POST["Peticion"];
    $Descripcion = $_POST["Descripcion"];
    $Cambio = $_POST["Cambio"];
    $HoraInicio = $_POST["HoraInicio"];
    $HoraFinal = $_POST["HoraFinal"];
    $FechaInicio = $_POST["FechaInicio"];
    $FechaFinal = $_POST["FechaFinal"];

    if ($Cambio == "no") {
        $HoraInicio = "No";
        $HoraFinal = "No";
    }

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $sql = "UPDATE novedad SET Peticion = '" . $Peticion . "', 
         Descripcion = '" . $Descripcion . "', 
         HoraInicio = '" . $HoraInicio . "', 
         HoraFinal = '" . $HoraFinal . "', 
         FechaInicio = '" . $FechaInicio . "', 
         FechaFinal = '" . $FechaFinal . "'
         WHERE IdNovedad = " . $IdNovedad;

    $modificado = $Conexion->EjecutarInstruccion($sql);

    if ($modificado == true) {
        echo "Modificado correctamente 7u7";
    } else {
        echo "No fue posible modificar OwO";
    }
};

// LISTAR NOVEDADES DE LOS usuarioS
function listarNovedades()
{

    $EstadoLista = $_POST["EstadoLista"];

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM novedad INNER JOIN usuario ON novedad.IdUsuario=usuario.IdUsuario WHERE EstadoNovedad  = '" . $EstadoLista . "'";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $fila) {
        echo '
        <tr class="tr_lista_listar_novedad">
            <td>', $fila['IdNovedad'], '</td>
            <td>', $fila['Nombre'], '</td>
            <td>', $fila['FechaRegistro'], '</td>
            <td>', $fila['Peticion'], '</td>
            <td>', $fila['Descripcion'], '</td>
            <td>', $fila['FechaInicio'], '</td>
            <td>', $fila['FechaFinal'], '</td>
            <td>', $fila['HoraInicio'], '</td>
            <td>', $fila['HoraFinal'], '</td><td> <buttom class="';
        if ($fila["EstadoNovedad"] == 0) {
            echo "Estado Rechazado";
        } else if ($fila["EstadoNovedad"] == 1) {
            echo "Estado Aceptado";
        } else if ($fila["EstadoNovedad"] == 2) {
            echo "Estado Espera";
        };
        echo '"</buttom>';
        if ($fila["EstadoNovedad"] == 0) {
            echo "Rechazado";
        } else if ($fila["EstadoNovedad"] == 1) {
            echo "Aceptado";
        } else if ($fila["EstadoNovedad"] == 2) {
            echo "En Espera";
        } else {
            echo "Ups, hubo un error";
        }
        echo '</td>
        <td >
            <center>';
        if ($fila['EstadoNovedad'] == 1) {
            echo '<a>Ya esta aceptado</a>';
        } else if ($fila['EstadoNovedad'] == 2) {
            echo '<a onclick="ModalAceptarNovedad(' . $fila['IdNovedad'] . '); window.modal.showModal();">
            <img src="../Vista/Assets/Iconos/check.svg" class="IconoTabla" alt=""></a>&nbsp;&nbsp;
            <a class="" onclick="ModalRechazarNovedad(' . $fila['IdNovedad'] . '); window.modal.showModal();">
            <img src="../Vista/Assets/Iconos/x.svg" class="IconoTabla" alt=""></a> </center>';
        } else {
            echo '<a>Ya esta rechazada</a>';
        }
        echo '</center>
        </td>
        </tr>
        ';
    }
}
