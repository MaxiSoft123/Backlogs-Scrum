<?php
require_once '../Modelo/Conexion.php';

switch ($_POST['Metodo']) {
    case 'RegistrarUsuario':
        RegistrarUsuario();
        break;
    case 'ListarUsuario':
        ListarUsuario();
        break;
    case 'ConsultarUsuario':
        ConsultarUsuario();
        break;
    case 'ModificarUsuario':
        ModificarUsuario();
        break;
    case 'DesactivarActivarUsuario':
        DesactivarActivarUsuario();
        break;
}

function RegistrarUsuario()
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

    $BuscarSql = "SELECT * FROM usuario";

    $Buscar = $Conexion->ObtenerDatos($BuscarSql);

    foreach ($Buscar as $key => $Datos) {
        if ($Datos['Documento'] == $Documento) {
            echo 'El numero de documento ya existe en la base de datos';
            return;
        }else if ($Datos['Telefono'] == $Telefono) {
            echo 'El numero de Telefono ya existe en la base de datos';
            return;
        }else if ($Datos['Correo'] == $Telefono) {
            echo 'El correo ya existe en la base de datos';
            return;
        }
    }

    $InstruccionSql = "INSERT INTO usuario VALUES (null,'" . $IdRol . "', '" . $Nombre . "', '" . $Apellido . "','" . $TipoDocumento . "','" . $Documento . "','" . $Correo . "','" . $ContraseñaEncryptada . "','" . $Telefono . "', '" . $Direccion . "','" . $Estado . "')";

    $Resultado = $Conexion->EjecutarInstruccion($InstruccionSql);

    if ($Resultado == true) {
        echo "Registrado correctamente";
    } else {
        echo "No fué posible realizar el registro";
    }
}

function ListarUsuario()
{

    $ListarUsuario = $_POST['ListarUsuario'];

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSql = "SELECT * FROM usuario INNER JOIN rol ON usuario.IdRol = rol.IdRol WHERE Estado = $ListarUsuario";

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
        <td><img src="assets/Iconos/editar.svg" alt="" class="IconoTabla" onclick="ConsultarUsuario(' . $Datos['IdUsuario'] . ')"></td>
        <td><img src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla" onclick="DesactivarActivarUsuario(' . $Datos['IdUsuario'] . ', ' . $Datos['Estado'] . ')"></td>
    </tr>';
    }
}

// SELECT * FROM usuario INNER JOIN rol ON usuario.IdRol = rol.IdRol INNER JOIN permiso ON rol.IdPermiso = permiso.IdPermiso WHERE usuario.IdUsuario = IdUsuario;

function ConsultarUsuario()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdUsuario = $_POST['IdUsuario'];

    $Sql = "SELECT * FROM usuario WHERE IdUsuario = " . $IdUsuario;
    $InstruccionSql = "SELECT * FROM rol";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSql);
    $Lista = $Conexion->ObtenerDatos($Sql);

    foreach ($Lista as $key => $Datos) {
        echo '<form>
        <p>Modificar a ' . $Datos["Nombre"] . '</p>
        <input type="hidden" id="IdUsuario" name="IdUsuario" value="' . $Datos['IdUsuario'] . '">    
        <select name="IdRol" id="IdRol" placeholder="Roles">';
        foreach ($Resultado as $key => $DatosRol) {
            echo '<option value="' . $DatosRol["IdRol"] . '">' . $DatosRol["NombreRol"] . '</option>';
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
                <input type="password" name="Contrasena " id="Contrasena" class="form-control " placeholder="Contraseña" required />
                <input type="number" name="Telefono " id="Telefono" class="form-control" placeholder="Telefono" value="' . $Datos["Telefono"] . '" required />
                <input type="text" name="Direccion " id="Direccion" class="form-control" placeholder="Direccion" value="' . $Datos["Direccion"] . '" required />
        </form';
    }
}

function ModificarUsuario()
{
    session_start();
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $IdUsuario = $_POST['IdUsuario'];
    $IdRol = $_POST['IdRol'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST["Apellido"];
    $TipoDocumento = $_POST['TipoDocumento'];
    $Documento = $_POST['Documento'];
    $Correo = $_POST['Correo'];
    $Contrasena = $_POST['Contrasena'];
    $Salt = 'MaxiSoft';
    $ContraseñaEncryptada =  hash('sha512', $Salt . $Contrasena);
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    
    $BuscarSql = "SELECT * FROM usuario WHERE IdUsuario != $IdUsuario";

    $Buscar = $Conexion->ObtenerDatos($BuscarSql);

    // $DocumentoRegistrado = 0;
    // $TelefonoRegistrado = 0;
    // $CorreoRegistrado = 0;
    foreach ($Buscar as $key => $Datos) {
        if ($Datos['Documento'] == $Documento) {
            // $DocumentoRegistrado++;
            echo 'El numero de documento ya existe en la base de datos';
            return;
        }else if ($Datos['Telefono'] == $Telefono) {
            // $TelefonoRegistrado++;
            echo 'El numero de telefono ya existe en la base de datos';
            return;
        }else if ($Datos['Correo'] == $Correo) {
            // $CorreoRegistrado++;
            echo 'El correo ya existe en la base de datos';
            return;
        }
    }

    // if ($DocumentoRegistrado > 1) {
    //     echo 'El Numero de documento'
    // }else if ($TelefonoRegistrado > 1) {
    //     # code...
    // }else if ($CorreoRegistrado > 1) {
    //     # code...
    // }

    $Sqly = "UPDATE usuario SET IdRol = '" . $IdRol . "',
    Nombre = '" . $Nombre . "', 
    Apellido = '" . $Apellido . "', 
    TipoDocumento = '" . $TipoDocumento . "',
    Documento = '" . $Documento . "', 
    Correo = '" . $Correo . "',
    Contrasena = '" . $ContraseñaEncryptada . "',
    Telefono = '" . $Telefono . "', 
    Direccion = '" . $Direccion . "'
    WHERE IdUsuario = " . $IdUsuario; 

    $Modificado = $Conexion->EjecutarInstruccion($Sqly);

    if ($Modificado == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}

function DesactivarActivarUsuario()
{

    $Conexion = new PDODB();

    $Conexion->Conectar();

    $tablaUsuario = "usuario";

    $IdUsuario = $_POST['IdUsuario'];
    $Estado = $_POST['Estado'];
    $ArrayTablasRelacionadas = array();

    if ($Estado == 1) {
        $Estado = 0;
    } else {
        $Estado = 1;
    }

    try {
        $consultaInfoUsuario = "SHOW CREATE TABLE $tablaUsuario";
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

            if ($tablaRelacionada != $tablaUsuario) {
                $consultaInfoTablaRelacionada = "SHOW CREATE TABLE $tablaRelacionada";
                $resultadoInfoTablaRelacionada = $Conexion->EjecutarInstruccion($consultaInfoTablaRelacionada);
                $definicionTablaRelacionada = $resultadoInfoTablaRelacionada->fetchColumn(1);

                if (strpos($definicionTablaRelacionada, 'FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`)') !== false) {

                    // Verificar si hay datos relacionados
                    $consultaDatosRelacionados = "SELECT * FROM $tablaRelacionada WHERE IdUsuario IN (SELECT IdUsuario FROM usuario WHERE IdUsuario = $IdUsuario)";
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
        $Sqly = "UPDATE usuario SET Estado = '" . $Estado . "'
        WHERE IdUsuario = " . $IdUsuario;

        $Modificado = $Conexion->EjecutarInstruccion($Sqly);

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
