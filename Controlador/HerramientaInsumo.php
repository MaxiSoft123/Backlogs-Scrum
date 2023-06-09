<?php
require_once '../Modelo/Conexion.php';

switch ($_POST['Metodo']) {
    case 'g':
        GuardarHerramienta();
        break;
    case 'awa':
        ListarHerramientas();
        break;
    case 'kk':
        ModalHerramienta();
        break;
    case 'pollo':
        Modificar();
        break;
}



function ListarHerramientas()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo '<tr>  
            <td class="space_master_herramienta" contenteditable="false">' . $Value['IdHerramientaInsumo'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Nombre'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Tipo'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Categoria'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Color'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Descripcion'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Medida'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['Cantidad'] . ' </td>
                <td class="space_master_herramienta" contenteditable="false">' . $Value['FechaCompra'] . ' </td>

                <td class="space_master_herramienta" contenteditable="false"> <img class="IconoTabla" onclick="window.modal.showModal(); ModalHerramienta(' . $Value['IdHerramientaInsumo'] . ')" src="assets/Iconos/editar.svg" alt="">  </td>                
            </tr> 

            ';
    }
}

function GuardarHerramienta()
{
    $Nombre = $_POST['Nombre'];
    $Tipo = $_POST["Tipo"];
    $Categoria = $_POST["Categoria"];
    $Descripcion = $_POST['Descripcion'];
    $Color = $_POST['Color'];
    $Medida = $_POST['Medida'];
    date_default_timezone_set('America/Mexico_City');

    $FechaCompra = date("d-m-Y");


    $Cantidad = $_POST['Cantidad'];


    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "INSERT INTO herramientainsumo  
        VALUES
        (null,'" . $Nombre . "', '" . $Tipo . "','" . $Categoria . "','" . $Descripcion . "','" . $Color . "','" . $FechaCompra . "', '" . $Cantidad . "', '" . $Medida . "')";

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);

    if ($Resultado == true) {
        echo "Agregado Correctamente";
    } else {
        echo "No fué posible guardar";
    }
}

function ModalHerramienta()
{
    $Id = $_POST["Id"];
    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE IdHerramientaInsumo = ".$Id;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo ' <form action="" class="ContenedorAñadir">
        <ul>
          <center><h1>Modificar herramientas e insumos</h1></center>
          <input
            type="hidden"
            value="' . $Value['IdHerramientaInsumo'] . '"
            id="Id"
            class="input_modificar_herramienta"
          />
          <p>Nombre</p>
          <input
            type="text"
            value="' . $Value['Nombre'] . '"
            id="Nombre"
            class="input_modificar_herramienta"
          />
          <p>Tipo</p>
          <select
            onclick="Cambio()"
            value="' . $Value['Tipo'] . '"
            id="Tipo"
            class="input_modificar_herramienta"
          >
            <option value="Herramienta">Herramienta</option>
            <option value="Insumo">Insumo</option>
          </select>
          <p>Categoria</p>
          <select
            value="' . $Value['Categoria'] . '"
            id="Categoria"
            class="input_modificar_herramienta"
          >
            <option id="Manual" value="Manual">Manual</option>
            <option id="Electrica" value="electrica">Electrica</option>
            <option id="Mecanica" value="mecanica">Mecánica</option>
            <option id="Cable" style="display: none" value="Cable">Cable</option>
            <option id="Router" style="display: none" value="Router">Router</option>
            <option id="Switch" style="display: none" value="Switch">Switch</option>
          </select>
          <p>Descripcion</p>
          <input
            type="text"
            value="' . $Value['Descripcion'] . '"
            id="Descripcion"
            class="input_modificar_herramienta"
          />
          <p>Color</p>
          <input
            type="text"
            value="' . $Value['Color'] . '"
            id="Color"
            class="input_modificar_herramienta"
          />
        
          <p>Medida</p>
          <select
            value="' . $Value['Medida'] . '"
            id="Medida"
            class="input_modificar_herramienta"
          >
            <option value="m">Metros</option>
            <option value="cm">Centímetros</option>
            <option value="km">Kilometros</option>
            <option value="c">Cantidad</option>
          </select>
      
          <p>Cantidad</p>
          <input
            type="text"
            value="' . $Value['Cantidad'] . '"
            id="Cantidad"
            class="input_modificar_herramienta"
          />
      
          ';
    }
}

function Modificar()
{
    $Nombre = $_POST['Nombre'];
    $Tipo = $_POST["Tipo"];
    $Categoria = $_POST["Categoria"];
    $Descripcion = $_POST['Descripcion'];
    $Color = $_POST['Color'];
    $Id = $_POST['Id'];
    $Medida = $_POST['Medida'];
    $Cantidad = $_POST['Cantidad'];

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "UPDATE herramientainsumo SET 
    Nombre = '" . $Nombre . "',
    Tipo = '" . $Tipo . "',
    Categoria = '" . $Categoria . "',
    Descripcion = '" . $Descripcion . "',
    Color = '" . $Color . "',
    Cantidad = " . $Cantidad . ",
    Medida = '" . $Medida . "'
    WHERE
    IdHerramientaInsumo = " . $Id ;

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);

    if ($Resultado == true) {
        echo "Modificado Correctamente";
    } else {
        echo "No fué posible guardar";
    }
}
