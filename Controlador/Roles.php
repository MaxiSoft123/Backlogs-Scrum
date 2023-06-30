<?php
require_once '../Modelo/Conexion.php';

switch ($_POST['Metodo']) {
    case 'RegistrarRol':
        RegistrarRol();
        break;
    case 'ListarRoles':
        ListarRoles();
        break;
    case 'ConsultarRol':
        ConsultarRol();
        break;
    case 'ModificarRol':
        ModificarRol();
        break;
    case 'DesactivarActivarRol':
        DesactivarActivarRol();
        break;
}

function RegistrarRol()
{
    date_default_timezone_set('America/Bogota');
    $NombreRol = $_POST["NombreRol"];
    $IdPermiso = $_POST["IdPermiso"];
    $Permiso = $_POST["Permisos"];
    $FechaRol = date("d-m-Y h:i:s");
    $EstadoRol = 1;
    $NombreRolEnUsuo = array();
    $PermisoRolEnUsuo = array();

    $Conexion = new PDODB();
    $Conexion->Conectar();

    $Averiguar = "SELECT * FROM rol";

    $Resultado = $Conexion->ObtenerDatos($Averiguar);

    foreach ($Resultado as $key => $Datos) {

        if ($Datos["NombreRol"] == $NombreRol) {
            $NombreRolEnUsuo[] = $Datos["NombreRol"];
        }
        if ($Datos["Permisos"] == $Permiso) {
            $PermisoRolEnUsuo[] = $Datos["Permisos"];
        }
    }

    if ($NombreRolEnUsuo) {
        echo "Ya existe un rol con el mismo nombre ";
    } else if ($PermisoRolEnUsuo) {
        echo "Ya existe un rol con los mismos permisos ";
    } else {
        $InstruccionSql = "INSERT INTO rol VALUES (NULL,'" . $NombreRol . "','" . $IdPermiso . "', '" . $Permiso . "',  '" . $FechaRol . "', '" . $EstadoRol . "')";

        if ($Conexion->EjecutarInstruccion($InstruccionSql)) {
            echo "Registrado correctamente";
        } else {
            echo "No fue posible realizar el registro";
        }
    }
}

function ListarRoles()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSql = "SELECT * FROM rol INNER JOIN permiso ON rol.IdPermiso = permiso.IdPermiso";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSql);

    foreach ($Resultado as $key => $Datos) {
        $ListaPermisos = explode(",", $Datos['Permisos']);
        echo '<tr>
                <td>' . $Datos['IdRol'] . '</td>
                <td>' . $Datos['NombreRol'] . '</td>
                <td>';
        if ($Datos['IdPermiso'] == 1) {
            if ($ListaPermisos[0] == 1) {
                echo 'Modulo de roles<br>';
            }
            if ($ListaPermisos[1] == 1) {
                echo 'Modulo de usuarios<br>';
            }
            if ($ListaPermisos[2] == 1) {
                echo 'Modulo de novedades<br>';
            }
            if ($ListaPermisos[3] == 1) {
                echo 'Modulo de herramientas e insumos<br>';
            }
            if ($ListaPermisos[4] == 1) {
                echo 'Modulo de prestamos<br>';
            }
            if ($ListaPermisos[5] == 1) {
                echo 'Modulo de servicios<br>';
            }
            if ($ListaPermisos[6] == 1) {
                echo 'Modulo de agendamiento';
            }
        } else {
            if ($ListaPermisos[0] == 1) {
                echo 'Modulo de novedades<br>';
            }
            if ($ListaPermisos[1] == 1) {
                echo 'Modulo de prestamos<br>';
            }
            if ($ListaPermisos[2] == 1) {
                echo 'Modulo de agendamiento';
            }
        }
        echo '</td>
        <td>' . $Datos["FechaRol"] . '</td>
                <td> <buttom class="';
        if ($Datos["EstadoRol"] == 1) {
            echo "Estado Activo";
        } else {
            echo "Estado Inactivo";
        };
        echo '"</buttom>';
        if ($Datos["EstadoRol"] == 1) {
            echo "Activo";
        } else {
            echo "Desactivado";
        };
        echo '</td>
                <td><img src="assets/Iconos/editar.svg" alt="" class="IconoTabla" onclick="ConsultarRol(' . $Datos['IdRol'] . ')"></td>
                <td><img src="assets/Iconos/desactivar.svg" alt="" class="IconoTabla" onclick="DesactivarActivarRol(' . $Datos['IdRol'] . ', ' . $Datos['EstadoRol'] . ')"></td>
            </tr>';
    }
}

function ConsultarRol()
{
    $Conexion = new PDODB();
    $Conexion->Conectar();
    $IdRol = $_POST['IdRol'];
    $Sql = "SELECT * FROM rol 
    INNER JOIN permiso ON rol.IdPermiso = permiso.IdPermiso
    WHERE rol.IdRol = " . $IdRol;
    $Lista = $Conexion->ObtenerDatos($Sql);
    $FormHtml = "";

    foreach ($Lista as $key => $Datos) {
        $FormHtml .= '    
        <form method="post">
        <input type="hidden" id="IdRol" name="IdRol" value="' . $Datos['IdRol'] . '">
        <input type="hidden" id="IdRolNombre" name="IdRolNombre" value="' . $Datos['NombreRol'] . '">
        <input type="hidden" id="IdPermiso" name="IdPermiso" value="' . $Datos['IdPermiso'] . '">
        <p id="LabelNombreRol">Nombre rol</p>
        <input type="text" id="NombreRol" name="NombreRol" placeholder="Nombre del rol" value="' . $Datos['NombreRol'] . '">
        <br><br>
        <center>
            <h1>Permisos</h1>
        </center>

        <div class="CheckboxRol">
            <label for="Administrador">Administrador</label>
            <input type="checkbox" id="Administrador" name="Administrador">
        </div>

        <div class="CheckboxRol">
            <label for="Empleado">Empleado</label>
            <input type="checkbox" id="Empleado" name="Empleado">
        </div>

        <div id="OpcionAdministrador" style="display: none;">
            <div class="Permisos">
                <br>
                <label for="">
                    Modulo de roles
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="RolesAdministrador" onclick="FuncionRolesAdministrador(0)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de usuarios
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="UsuariosAdministrador" onclick="FuncionRolesAdministrador(1)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de novedades
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="NovedadesAdministrador" onclick="FuncionRolesAdministrador(2)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de herramientas e insumos
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="HerramientasInsumosAdministrador" onclick="FuncionRolesAdministrador(3)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de prestamos
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="PrestamosAdministrador" onclick="FuncionRolesAdministrador(4)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de servicios
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="ServiciosAdministrador" onclick="FuncionRolesAdministrador(5)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de agendamiento
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="AgendamientoAdministrador" onclick="FuncionRolesAdministrador(6)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
            </div>
            <input type="hidden" id="PermisosAdministrador" name="PermisosAdministrador" value="0,0,0,0,0,0,0">
            <div class="Boton">
                <button class="BotonVerde" onclick="ModificarRol()">Aceptar</button>
                <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
            </div>
        </div>

        <div id="OpcionEmpleado" style="display: none;">

            <div class="Permisos">
                <br>
                <label for="">
                    Modulo de novedades
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="NovedadesEmpleado" onclick="FuncionRolesEmpleado(0)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de prestamos
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="PrestamosEmpleado" onclick="FuncionRolesEmpleado(1)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
                <label for="">
                    Modulo de agendamiento
                    <label class="toggle">
                        <input class="toggle-checkbox" type="checkbox" id="AgendamientoEmpleado" onclick="FuncionRolesEmpleado(2)">
                        <div class="toggle-switch"></div>
                    </label>
                </label>
            </div>
            <input type="hidden" id="PermisosEmpleado" name="PermisosEmpleado" value="0,0,0">
            <div class="Boton">
                <button class="BotonVerde" onclick="ModificarRol()">Aceptar</button>
                <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
            </div>
        </div>
    </form>
    <script>
    var PermisosAdministrador = [0, 0, 0, 0, 0, 0, 0]
    var Permisos = [0, 0, 0]
    var Permisostxt = ""
    var PermisostxtAdministrador = ""

    function Cargas() {
        console.log("entro a cargas");
        if ("' . $Datos['IdPermiso'] . '" == 1) {
            let PermisosAdministrador = "' . $Datos['Permisos'] . '".split(",");
            for (let index = 0; index < PermisosAdministrador.length; index++) {
                switch (index) {
                    case 0:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("RolesAdministrador");
                            checkBox.click();
                        }
                        break;
                    case 1:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("UsuariosAdministrador");
                            checkBox.click();
                        }
                        break;
                    case 2:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("NovedadesAdministrador");
                            checkBox.click();
                        }
                        break;
                    case 3:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("HerramientasInsumosAdministrador");
                            checkBox.click();
                        }
                        break;
                    case 4:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("PrestamosAdministrador");
                            checkBox.click();
                        }
                        break;
                    case 5:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("ServiciosAdministrador");
                            checkBox.click();
                        }
                        break;
                    case 6:
                        if (PermisosAdministrador[index] == 1) {
                            var checkBox = document.getElementById("AgendamientoAdministrador");
                            checkBox.click();
                        }
                        break;
                }
            }
        } else {
            let Permisos = "' . $Datos['Permisos'] . '".split(",");
            for (let index = 0; index < Permisos.length; index++) {
                switch (index) {
                    case 0:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("NovedadesEmpleado");
                            checkBox.click();
                        }
                        break;
                    case 1:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("PrestamosEmpleado");
                            checkBox.click();
                        }
                        break;
                    case 2:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("AgendamientoEmpleado");
                            checkBox.click();
                        }
                        break;
                }
            }
        }
    }

    Cargas();

    function FuncionRolesAdministrador(num) {
        switch (num) {
            case 0:
                var checkBox = document.getElementById("RolesAdministrador");
                break;
            case 1:
                var checkBox = document.getElementById("UsuariosAdministrador");
                break;
            case 2:
                var checkBox = document.getElementById("NovedadesAdministrador");
                break;
            case 3:
                var checkBox = document.getElementById("HerramientasInsumosAdministrador");
                break;
            case 4:
                var checkBox = document.getElementById("PrestamosAdministrador");
                break;
            case 5:
                var checkBox = document.getElementById("ServiciosAdministrador");
                break;
            case 6:
                var checkBox = document.getElementById("AgendamientoAdministrador");
                break;
        }

        if (checkBox.checked == true) {
            // Aquí puedes enviar los datos si el switch está activado 
            console.log("Switch activado Administrador");
            PermisosAdministrador[num] = 1
            console.log(PermisosAdministrador.toString())
        } else {
            // Aquí puedes enviar los datos si el switch está desactivado 
            console.log("Switch desactivado Administrador");
            PermisosAdministrador[num] = 0
            console.log(PermisosAdministrador.toString())
        }
        PermisostxtAdministrador = PermisosAdministrador.toString()
        var permisohidden = document.getElementById("PermisosAdministrador");
        permisohidden.value = PermisostxtAdministrador
    }

    function FuncionRolesEmpleado(num) {
        switch (num) {
            case 0:
                var checkBox = document.getElementById("NovedadesEmpleado");
                break;
            case 1:
                var checkBox = document.getElementById("PrestamosEmpleado");
                break;
            case 2:
                var checkBox = document.getElementById("AgendamientoEmpleado");
                break;
        }
        if (checkBox.checked == true) {
            // Aquí puedes enviar los datos si el switch está activado 
            console.log("Switch activado");
            Permisos[num] = 1
            console.log(Permisos.toString())
        } else {
            // Aquí puedes enviar los datos si el switch está desactivado 
            console.log("Switch desactivado");
            Permisos[num] = 0
            console.log(Permisos.toString())
        }
        Permisostxt = Permisos.toString()
        var permisohidden = document.getElementById("PermisosEmpleado");
        permisohidden.value = Permisostxt
    }

    
    document.getElementById("Administrador").addEventListener("change", function() {
        var OpcionAdministrador = document.getElementById("OpcionAdministrador");
        var OpcionEmpleado = document.getElementById("OpcionEmpleado");
        var IdPermiso = document.getElementById("IdPermiso");

        if (this.checked) {
            OpcionAdministrador.style.display = "block";
            OpcionEmpleado.style.display = "none";
            document.getElementById("Empleado").checked = false;
            IdPermiso.value = 1;
        } else {
            OpcionAdministrador.style.display = "none";
        }
    });

    document.getElementById("Empleado").addEventListener("change", function() {
        var OpcionAdministrador = document.getElementById("OpcionAdministrador");
        var OpcionEmpleado = document.getElementById("OpcionEmpleado");
        var IdPermiso = document.getElementById("IdPermiso");

        if (this.checked) {
            OpcionAdministrador.style.display = "none";
            OpcionEmpleado.style.display = "block";
            document.getElementById("Administrador").checked = false;
            IdPermiso.value = 2;
        } else {
            OpcionEmpleado.style.display = "none";
        }
    });

    </script>
    ';
    }
    echo $FormHtml;
}

function ModificarRol()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $IdRol = $_POST["IdRol"];
    $IdRolNombre = $_POST["IdRolNombre"];
    $IdPermiso = $_POST["IdPermiso"];
    $NombreRol = $_POST["NombreRol"];
    $Permisos = $_POST["Permisos"];
    $NombreRolEnUsuo = array();
    $PermisoRolEnUsuo = array();

    $Averiguar = "SELECT * FROM rol";

    $Resultado = $Conexion->ObtenerDatos($Averiguar);

    foreach ($Resultado as $key => $Datos) {

        if ($Datos["NombreRol"] == $NombreRol && $Datos["NombreRol"] != $IdRolNombre) {
            $NombreRolEnUsuo[] = $Datos["NombreRol"];
        }
        if ($Datos["Permisos"] == $Permisos) {
            $PermisoRolEnUsuo[] = $Datos["Permisos"];
        }
    }

    if ($NombreRolEnUsuo) {
        echo "Ya existe un rol con el mismo nombre ";
    } else if ($PermisoRolEnUsuo) {
        echo "Ya existe un rol con los mismos permisos ";
    } else {

        $Sql = "UPDATE rol SET NombreRol = '" . $NombreRol . "', 
    IdPermiso = '" . $IdPermiso . "', 
    Permisos = '" . $Permisos . "'
    WHERE IdRol = " . $IdRol;

        $Modificado = $Conexion->EjecutarInstruccion($Sql);

        if ($Modificado == true) {
            echo "Modificado correctamente";
        } else {
            echo "No fue posible modificar";
        }
    }
}

function DesactivarActivarRol()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $TablaRol = "rol";

    $IdRol = $_POST['IdRol'];
    $EstadoRol = $_POST['EstadoRol'];
    $ArrayEmpleadosRoles = array();

    if ($EstadoRol == 1) {
        $EstadoRol = 0;
    } else {
        $EstadoRol = 1;
    }

    try {
        $consultaInfoRol = "SHOW CREATE TABLE $TablaRol";
        $resultadoInfoRol = $Conexion->EjecutarInstruccion($consultaInfoRol);
        $definicionRol = $resultadoInfoRol->fetchColumn(1);
    } catch (PDOException $e) {
        echo "Error al obtener información de la tabla rol: " . $e->getMessage();
        return;
    }

    try {
        $consultaTablasRelacionadas = "SHOW TABLES";
        $resultadoTablasRelacionadas = $Conexion->EjecutarInstruccion($consultaTablasRelacionadas);

        while ($filaTablaRelacionada = $resultadoTablasRelacionadas->fetch(PDO::FETCH_NUM)) {
            $tablaRelacionada = $filaTablaRelacionada[0];

            if ($tablaRelacionada != $TablaRol) {
                $consultaInfoTablaRelacionada = "SHOW CREATE TABLE $tablaRelacionada";
                $resultadoInfoTablaRelacionada = $Conexion->EjecutarInstruccion($consultaInfoTablaRelacionada);
                $definicionTablaRelacionada = $resultadoInfoTablaRelacionada->fetchColumn(1);

                if (strpos($definicionTablaRelacionada, 'FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`)') !== false) {

                    // Verificar si hay datos relacionados
                    $consultaDatosRelacionados = "SELECT * FROM $tablaRelacionada WHERE IdRol IN (SELECT IdRol FROM Rol WHERE IdRol = $IdRol)";
                    $resultadoDatosRelacionados = $Conexion->EjecutarInstruccion($consultaDatosRelacionados);

                    if ($resultadoDatosRelacionados->rowCount() > 0) {
                        foreach ($resultadoDatosRelacionados as $fila) {
                            // Aquí puedes acceder a los datos de cada fila con $fila['nombre_columna']
                            // y almacenarlos en el array o hacer cualquier otra operación necesaria
                            $ArrayEmpleadosRoles[] = $fila["Nombre"];
                        }
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

    if (empty($ArrayEmpleadosRoles)) {

        $Sql = "UPDATE rol SET EstadoRol = '" . $EstadoRol . "'
        WHERE IdRol = " . $IdRol;

        $Modificado = $Conexion->EjecutarInstruccion($Sql);

        if ($Modificado == true && $EstadoRol == 0) {
            echo "Desactivado correctamente";
        } else if ($Modificado == true && $EstadoRol == 1) {
            echo "Activado correctamente";
        } else {
            echo "No fue posible modificar";
        }
    } else {
        echo "El rol esta en uso por los siguientes empleados: ";
        for ($i = 0; $i < count($ArrayEmpleadosRoles); $i++) {
            echo $ArrayEmpleadosRoles[$i] . " ";
        }
    }
}
