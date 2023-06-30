<?php
require_once '../Modelo/Conexion.php';

switch ($_POST['Metodo']) {
    case 'GuardarHerramienta':
        GuardarHerramienta();
        break;
    case 'ListarHerramientas':
        ListarHerramientas();
        break;

    case 'ModificarHerramientas':
        ModificarHerramientas();
        break;
        case 'DesactivarHerramientaInsumo':
          DesactivarHerramientaInsumo();
          break;
          case 'EliminarHerramienta':
            EliminarHerramienta();
            break;
            case 'Busqueda':
              Busqueda();
              break;
              case 'ModalModificarHerramienta':
                ModalModificarHerramienta();
                break;
                case 'ModalEliminarHerramienta':
                    ModalEliminarHerramienta();
                    break;

}


function ListarHerramientas()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        if ($Value['Estado'] == 1){
            $Estado = "<buttom class='Estado Activo'>Activo</buttom>";
          }
          else{
              $Estado = "<buttom class='Estado Inactivo'>Desactivado</buttom>";
          }
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
                <td class="space_master_herramienta" contenteditable="false">' . $Estado . ' </td>

                <td class="space_master_herramienta" contenteditable="false"> <img class="IconoTabla" onclick="window.modal.showModal(); ModalModificarHerramienta(' . $Value['IdHerramientaInsumo'] . ')" src="assets/Iconos/editar.svg" alt="">  <img class="IconoTabla" onclick="DesactivarHerramientaInsumo(' . $Value['IdHerramientaInsumo'] . ', ' . $Value['Estado'] . ')" src="assets/Iconos/desactivar.svg" alt=""> <img class="IconoTabla" onclick="window.modal.showModal(); ModalEliminarHerramienta(' . $Value['IdHerramientaInsumo'] . ')" src="assets/Iconos/basura.svg" alt="">   </td>                
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
      if ($Tipo == "Herramienta"){
        $Medida = "U";
      }
      date_default_timezone_set('America/Mexico_City');
  
      $FechaCompra = date("d-m-Y");
  
  
      $Cantidad = $_POST['Cantidad'];
  
      $Conexion = new PDODB();
  
      $Conexion->Conectar();

      $InstruccionSQL = "SELECT * FROM herramientainsumo";
  
      $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
  
      foreach ($Resultado as $key => $Value) {
        if ($Value['Nombre'] == $Nombre){
            echo "Ya existe una herramienta con el mismo nombre";
            return;
        } 
      }
  
      $InstruccionSQL = "INSERT INTO herramientainsumo  
          VALUES
          (null,'" . $Nombre . "', '" . $Tipo . "','" . $Categoria . "','" . $Descripcion . "','" . $Color . "','" . $FechaCompra . "', '" . $Cantidad . "', '" . $Medida . "', 1)";
  
      $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
  
      if ($Resultado == true) {
          echo "Agregado Correctamente";
      } else {
          echo "No fué posible guardar";
      }
  }


  function ModalEliminarHerramienta(){
    $Id = $_POST["Id"];
    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE IdHerramientaInsumo = ".$Id;
    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);
    foreach ($Resultado as $key => $Value) {
      
    echo'<center><h3>¿Esta seguro de eliminarlo?</h3></center>
    <input id="Caso" type="hidden" value="Eliminar">
    <input id="Id" value="'.$Value['IdHerramientaInsumo'].'" type="hidden">
    ';
}
}

function ModalModificarHerramienta()
{
    $Id = $_POST["Id"];
    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE IdHerramientaInsumo = ".$Id;

    $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

    foreach ($Resultado as $key => $Value) {
        echo ' 	<form action="/">
        <input id="Id" value="'.$Value['IdHerramientaInsumo'].'" type="hidden">
				<p class="letra">Nombre</p>
                <input id="Caso" type="hidden" value="Modificar">
				<input name="NombreHerramienta" id="NombreHerramienta" type="text" value="'.$Value['Nombre'].'">
				<br><br>

				<label class="letra" for="">Tipo</label>

				<select value="'.$Value['Tipo'].'" onclick="Cambio()" name="Tipo" id="Tipo">
					<option value="Herramienta">Herramienta</option>
					<option value="Insumo">Insumo</option>
				</select>
				<br>
				<br>

				<label class="letra" for="">Categoria</label>
				<select value="'.$Value['Categoria'].'" name="Categoria" id="Categoria">
					<option id="Manual" value="Manual">Manual</option>
					<option id="Electrica" value="Electrica">Electrica</option>
					<option id="Mecanica" value="Mecanica">Mecánica</option>
					<option id="Cable" style="display: none;" value="Cable">Cable</option>
					<option id="Router" style="display: none;" value="Router">Router</option>
					<option id="Switch" style="display: none;" value="Switch">Switch</option>
				</select>
				<br>
				<br>
				<label class="letra" for="">Descripcion</label>
				<input name="Descripcion" id="Descripcion" type="text" value="'.$Value['Descripcion'].'">
				<br>
				<br>
				<label class="letra" for="">Color</label>
				<input name="Color" id="Color" type="text" value="'.$Value['Color'].'">
				<br><br>


				<label class="letra" for="">Tipo de Medida</label>
				<br>
				<select disabled name="Medida" id="Medida" value="'.$Value['Medida'].'">			
					<option value="U">Unidad</option>
					<option value="M">Metros</option>
					<option value="Cm">Centímetros</option>
					<option value="Km">Kilometros</option>
				</select>
				<br><br>

				<label class="label_registrar_herramienta" for="">Cantidad</label>
				<input onclick="ValidarCantidad()" onkeyup="ValidarCantidad()" name="Cantidad" id="Cantidad" type="number" value="'.$Value['Cantidad'].'">
				<br><br>


				</div>
			</div>
		
</form>
          ';
    }
}

function ModificarHerramientas()
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
        echo "No fué posible modificar";
    }
}


function DesactivarHerramientaInsumo(){
  $IdHerramientaInsumo = $_POST['IdHerramientaInsumo'];
  $Estado = $_POST['Estado'];
  $Conexion = new PDODB();
  $Conexion->Conectar();
  if ($Estado == 1){
    $Estado = 0;
  }
  else if ($Estado == 0){
    $Estado = 1;
  }
  $InstruccionSQL = "UPDATE herramientainsumo SET 
  Estado = '" . $Estado . "'
  WHERE
  IdHerramientaInsumo = " . $IdHerramientaInsumo ;

  $Resultado = $Conexion->EjecutarInstruccion($InstruccionSQL);
  if ($Resultado == true) {
    echo "Se ha ambiado el estado";
} else {
    echo "No fué posible Cambiar";
}
}

function EliminarHerramienta(){
  $IdHerramientaInsumo = $_POST['IdHerramientaInsumo'];
  $Conexion = new PDODB();
  $Conexion->Conectar();
  try {
    $consultaInfoUsuario = "SHOW CREATE TABLE herramientainsumo";
    $resultadoInfoUsuario = $Conexion->EjecutarInstruccion($consultaInfoUsuario);
    $definicionUsuario = $resultadoInfoUsuario->fetchColumn(1);
} catch (PDOException $e) {
    echo "Error al obtener información de la tabla Usuario: " . $e->getMessage();
    return;
}

try {
    $consultaTablasRelacionadas = "SHOW TABLES";
    $resultadoTablasRelacionadas = $Conexion->EjecutarInstruccion($consultaTablasRelacionadas);

    while ($filaTablaRelacionada = $resultadoTablasRelacionadas->fetch(PDO::FETCH_NUM)) {
        $tablaRelacionada = $filaTablaRelacionada[0];

        if ($tablaRelacionada != "herramientainsumo") {
            $consultaInfoTablaRelacionada = "SHOW CREATE TABLE $tablaRelacionada";
            $resultadoInfoTablaRelacionada = $Conexion->EjecutarInstruccion($consultaInfoTablaRelacionada);
            $definicionTablaRelacionada = $resultadoInfoTablaRelacionada->fetchColumn(1);

            if (strpos($definicionTablaRelacionada, 'FOREIGN KEY (`IdHerramientaInsumo`) REFERENCES `herramientainsumo` (`IdHerramientaInsumo`)') !== false) {

                // Verificar si hay datos relacionados
                $consultaDatosRelacionados = "SELECT * FROM $tablaRelacionada WHERE IdHerramientaInsumo IN (SELECT IdHerramientaInsumo FROM herramientainsumo WHERE IdHerramientaInsumo = $IdHerramientaInsumo)";
                $resultadoDatosRelacionados = $Conexion->EjecutarInstruccion($consultaDatosRelacionados);

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
    $Sqly = "DELETE FROM herramientainsumo
    WHERE IdHerramientaInsumo = " . $IdHerramientaInsumo;

    $Eliminado = $Conexion->EjecutarInstruccion($Sqly);

    if ($Eliminado == true) {
        echo "Eliminado correctamente";
    } else {
        echo "No fue posible eliminar";
    }
} else {
    echo "La herramienta o insumo tiene datos relacionados en los siguientes modulos: ";
    for ($i = 0; $i < count($ArrayTablasRelacionadas); $i++) {
        echo $ArrayTablasRelacionadas[$i] . " ";
    }
}
}


function Busqueda()
{
  $Conexion = new PDODB();
  $Nombre = $_POST['Nombre'];
  $Conexion->Conectar();

  $InstruccionSQL = "SELECT * FROM herramientainsumo WHERE Nombre  LIKE  '%$Nombre%'";

  $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

  foreach ($Resultado as $key => $Value) {
    if ($Value['Estado'] == 1){
      $Estado = "<buttom class='Estado Activo'>Activo</buttom>";
    }
    else{
        $Estado = "<buttom class='Estado Inactivo'>Desactivado</buttom>";
    }
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
              <td class="space_master_herramienta" contenteditable="false">' . $Estado . ' </td>

              <td class="space_master_herramienta" contenteditable="false"> <img class="IconoTabla" onclick="window.modal.showModal(); ModalModificarHerramienta(' . $Value['IdHerramientaInsumo'] . ')" src="assets/Iconos/editar.svg" alt="">  <img class="IconoTabla" onclick="DesactivarHerramientaInsumo(' . $Value['IdHerramientaInsumo'] . ', ' . $Value['Estado'] . ')" src="assets/Iconos/desactivar.svg" alt=""> <img class="IconoTabla" onclick="window.modal.showModal(); ModalEliminarHerramienta(' . $Value['IdHerramientaInsumo'] . ')" src="assets/Iconos/basura.svg" alt="">   </td>                
              </tr> 

          ';      
  }

}




