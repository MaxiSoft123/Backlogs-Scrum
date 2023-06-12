<?php
require_once '../Modelo/Conexion.php';

switch ($_POST['Metodo']) {
    case 'RegistrarUsuarioEmpleado':
        RegistrarUsuarioEmpleado();
        break;
    case 'ListarUsuarioEmpleado':
        ListarUsuarioEmpleado();
        break;
    case 'ConsultarUsuarioEmpleado':
        ConsultarUsuarioEmpleado();
        break;
    case 'ModificarUsuarioEmpleado':
        ModificarUsuarioEmpleado();
        break;
    case 'DesactivarActivarUsuarioEmpleado':
        DesactivarActivarUsuarioEmpleado();
        break;
}

function RegistrarUsuarioEmpleado()
{
    $IdRol = $_POST['IdRol'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST["Apellido"];
    $TipoDocumento = $_POST['TipoDocumento'];
    $Documento = $_POST['Documento'];
    $Correo = $_POST['Correo'];
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    $Contrasena = $_POST['Contrasena'];
    $Salt = 'MaxiSoft';
    $ContraseñaEncryptada =  hash('sha512', $Salt . $Contrasena);
    $Estado = true;

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionMSql = "INSERT INTO empleado VALUES (null, '" . $Nombre . "', '" . $Apellido . "','" . $TipoDocumento . "','" . $Documento . "','" . $Correo . "','" . $Telefono . "', '" . $Direccion . "', '" . $Estado . "')";

    $InstruccionSql = "INSERT INTO usuario VALUES (null,'" . $IdRol . "', '" . $Nombre . "', '" . $Apellido . "','" . $TipoDocumento . "','" . $Documento . "','" . $Correo . "','" . $ContraseñaEncryptada . "','" . $Telefono . "', '" . $Direccion . "','" . $Estado . "')";

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSql);

    $Resultados = $Conexion->EjecutarInstruccion($InstruccionMSql);


    if ($Resultado == true && $Resultados == true) {
        echo "Registrado correctamente";
    } else {
        echo "No fué posible realizar el registro";
    }
}

function ListarUsuarioEmpleado()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSql = "SELECT * FROM usuario INNER JOIN rol ON usuario.IdRol = rol.IdRol";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSql);

    foreach ($Resultado as $key => $Datos) {
        echo '<tr>
                <td class="pt-3-half" contenteditable="false">' . $Datos['IdUsuario'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['NombreRol'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['Nombre'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['Apellido'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['TipoDocumento'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['Documento'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['Correo'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['Telefono'] . '</td>
                <td class="pt-3-half" contenteditable="false">' . $Datos['Direccion'] . '</td>
                <td> <buttom class="';
        if ($Datos["Estado"] == 1) {
            echo "Estado Activo";
        } else {
            echo "Estado Inactivo";
        };
        echo '"</buttom>';
        if ($Datos["Estado"] == 1) {
            echo "Activo";
        } else {
            echo "Desactivado";
        };
        echo '</td>
        <td><img src="assets/Iconos/editar.svg" alt="" class="IconoTabla" onclick="ConsultarUsuarioEmpleado(' . $Datos['IdUsuario'] . ')"></td>
        <td><img src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla" onclick="DesactivarActivarUsuarioEmpleado(' . $Datos['IdUsuario'] . ', ' . $Datos['Estado'] . ')"></td>
    </tr>';
    }
}

function ConsultarUsuarioEmpleado()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdUsuario = $_POST['IdUsuario'];

    $Sql = "SELECT * FROM usuario WHERE IdUsuario = " . $IdUsuario;
    $InstruccionSql = "SELECT * FROM rol";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSql);
    $lista = $Conexion->ObtenerDatos($Sql);

    foreach ($lista as $key => $Datos) {
        echo '<form>
        <p>Modificar a ' . $Datos["Nombre"] . '</p>
        <input type="hidden" id="IdUsuario" name="IdUsuario" value="' . $Datos['IdUsuario'] . '">    
        <select name="IdRol" id="IdRol" placeholder="Roles">';
        foreach ($Resultado as $key => $Datos) {
            echo '<option value="' . $Datos["IdRol"] . '">' . $Datos["NombreRol"] . '</option>';
        };
        echo '
            </select>
            <input type="text" name="Nombre" id="Nombre" class="form-control" placeholder="Nombres" value="' . $Datos["Nombre"] . '" required />
            <input type="text" name="Apellido" id="Apellido" class="form-control" placeholder="Apellido" value="' . $Datos["Apellido"] . '" required />
            <select name="TipoDocumento" id="TipoDocumento" class="form-control" placeholder="Tipo de documento">
                    <option value="' . $Datos["TipoDocumento"] . '">' . $Datos["TipoDocumento"] . '</option>
                    <option value="Cédula">Cédula de Ciudadanía</option>
                    <option value="Tarjeta de identidad">Tarjeta de Identidad</option>
                    <option value="Cedula de extrangeria">Cédula de Extrangería</option>
                    <option value="Pasaporte">Pasaporte</option>
                </select>
                <input type="number" name="Documento " id="Documento" class="form-control " placeholder="Documento" value="' . $Datos["Documento"] . '" required />
                <input type="email" name="Correo " id="Correo" class="form-control " placeholder="Correo" value="' . $Datos["Correo"] . '" required />
                <input type="number" name="Telefono " id="Telefono" class="form-control" placeholder="Telefono" value="' . $Datos["Telefono"] . '" required />
                <input type="text" name="Direccion " id="Direccion" class="form-control" placeholder="Direccion" value="' . $Datos["Direccion"] . '" required />
                <select name="Estado" id="Estado" class="form-control" placeholder="Estado">
                 ';
        if ($Datos["Estado"] == 1) {
            echo '<option value="1">Activar</option>
            <option value="0">Desactivar</option>';
        } else {
            echo '<option value="0">Desactivar</option>      
            <option value="1">Activar</option>
            ';
        };
        echo '
                </select>
        </form';
    }
}

function ModificarUsuarioEmpleado()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $IdUsuario = $_POST['IdUsuario'];
    $IdRol = $_POST['IdRol'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST["Apellido"];
    $TipoDocumento = $_POST['TipoDocumento'];
    $Documento = $_POST['Documento'];
    $Correo = $_POST['Correo'];
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    $Estado = $_POST['Estado'];

    $Sqly = "UPDATE usuario SET IdRol = '" . $IdRol . "',
    Nombre = '" . $Nombre . "', 
    Apellido = '" . $Apellido . "', 
    TipoDocumento = '" . $TipoDocumento . "',
    Documento = '" . $Documento . "', 
    Correo = '" . $Correo . "',
    Telefono = '" . $Telefono . "', 
    Direccion = '" . $Direccion . "', 
    Estado = '" . $Estado . "'
    WHERE IdUsuario = " . $IdUsuario;

    $Sql = "UPDATE empleado SET Nombre = '" . $Nombre . "', 
    Apellido = '" . $Apellido . "', 
    TipoDocumento = '" . $TipoDocumento . "',
    Documento = '" . $Documento . "', 
    Correo = '" . $Correo . "',
    Telefono = '" . $Telefono . "', 
    Direccion = '" . $Direccion . "', 
    Estado = '" . $Estado . "'
    WHERE IdEmpleado = " . $IdUsuario;

    $Modificado = $Conexion->EjecutarInstruccion($Sqly);
    $Modificados = $Conexion->EjecutarInstruccion($Sql);

    if ($Modificado == true && $Modificados == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}

function DesactivarActivarUsuarioEmpleado()
{

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $IdUsuario = $_POST['IdUsuario'];
    $Estado = $_POST['Estado'];

    if ($Estado == 1) {
        $Estado = 0;
    } else {
        $Estado = 1;
    }

    $Sqly = "UPDATE usuario SET Estado = '" . $Estado . "'
    WHERE IdUsuario = " . $IdUsuario;

    $Sql = "UPDATE Empleado SET Estado = '" . $Estado . "'
    WHERE IdEmpleado = " . $IdUsuario;

    $Modificado = $Conexion->EjecutarInstruccion($Sqly);
    $Modificados = $Conexion->EjecutarInstruccion($Sql);

    if ($Modificado == true && $Modificados == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}
