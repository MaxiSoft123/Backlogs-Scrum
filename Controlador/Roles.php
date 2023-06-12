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
    $Nombre = $_POST["NombreRol"];
    $Permiso = $_POST["Permisos"];
    $FechaRol = date("d-m-Y h:i:s");
    $EstadoRol = 1;

    $Conexion = new PDODB();
    $Conexion->Conectar();

    $InstruccionSql = "INSERT INTO rol VALUES (NULL,'" . $Nombre . "', '" . $Permiso . "',  '" . $FechaRol . "', '" . $EstadoRol . "')";

    if ($Conexion->EjecutarInstruccion($InstruccionSql)) {
        echo "Registrado correctamente";
    } else {
        echo "No fue posible realizar el registro";
    }
}

function ListarRoles()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $InstruccionSql = "SELECT * FROM rol";

    $Resultado = $Conexion->ObtenerDatos($InstruccionSql);

    foreach ($Resultado as $key => $Datos) {
        $ListaPermisos = explode(",", $Datos['Permisos']);
        echo '<tr>
                <td>' . $Datos['IdRol'] . '</td>
                <td>' . $Datos['NombreRol'] . '</td>
                <td>';
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
    $Sql = "SELECT * FROM rol WHERE IdRol = " . $IdRol;
    $Lista = $Conexion->ObtenerDatos($Sql);
    $FormHtml = "";

    foreach ($Lista as $key => $Datos) {
        $FormHtml .= '
    <form method="post">
    <input type="hidden" id="IdRol" name="IdRol" value="' . $Datos['IdRol'] . '">
    <div>
    <p>Nombre rol</p>
    <input type="text" id="NombreRol" name="NombreRol" placeholder="Nombre del rol" value="' . $Datos['NombreRol'] . '">
    <div class="Permisos">
    <br>
    <label for="">
        Modulo de roles
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="Roles" onclick="FuncionRoles(0)">
            <div class="toggle-switch"></div>
        </label>
    </label>
    <label for="">
        Modulo de usuarios
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="Usuarios" onclick="FuncionRoles(1)">
            <div class="toggle-switch"></div>
        </label>
    </label>
    <label for="">
        Modulo de novedades
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="Novedades" onclick="FuncionRoles(2)">
            <div class="toggle-switch"></div>
        </label>
    </label>
    <label for="">
        Modulo de herramientas e insumos
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="HerramientasInsumos" onclick="FuncionRoles(3)">
            <div class="toggle-switch"></div>
        </label>
    </label>
    <label for="">
        Modulo de prestamos
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="Prestamos" onclick="FuncionRoles(4)">
            <div class="toggle-switch"></div>
        </label>
    </label>
    <label for="">
        Modulo de servicios
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="Servicios" onclick="FuncionRoles(5)">
            <div class="toggle-switch"></div>
        </label>
    </label>
    <label for="">
        Modulo de agendamiento
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" id="Agendamiento" onclick="FuncionRoles(6)">
            <div class="toggle-switch"></div>
        </label>
    </label>
</div>
<input type="hidden" id="Permisos" name="Permisos" value="0,0,0,0,0,0,0">
<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
</form>
    <script>
        var Permisos = [0, 0, 0, 0, 0, 0, 0]
        var Permisostxt = ""

        function cargas() {
            console.log("entro a cargas");
            let Permisos = "' . $Datos['Permisos'] . '".split(",");
            for (let index = 0; index < Permisos.length; index++) {
                switch (index) {
                    case 0:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("Roles");
                            checkBox.click();
                        }
                        break;
                    case 1:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("Usuarios");
                            checkBox.click();
                        }
                        break;
                    case 2:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("Novedades");
                            checkBox.click();
                        }
                        break;
                    case 3:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("HerramientasInsumos");
                            checkBox.click();
                        }
                        break;
                    case 4:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("Prestamos");
                            checkBox.click();
                        }
                        break;
                    case 5:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("Servicios");
                            checkBox.click();
                        }
                        break;
                    case 6:
                        if (Permisos[index] == 1) {
                            var checkBox = document.getElementById("Agendamiento");
                            checkBox.click();
                        }
                        break;
                }
            }

        }

        cargas();

        function FuncionRoles(num) {
            switch (num) {
                case 0:
                    var checkBox = document.getElementById("Roles");
                    break;
                case 1:
                    var checkBox = document.getElementById("Usuarios");
                    break;
                case 2:
                    var checkBox = document.getElementById("Novedades");
                    break;
                case 3:
                    var checkBox = document.getElementById("HerramientasInsumos");
                    break;
                case 4:
                    var checkBox = document.getElementById("Prestamos");
                    break;
                case 5:
                    var checkBox = document.getElementById("Servicios");
                    break;
                case 6:
                    var checkBox = document.getElementById("Agendamiento");
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
            var Permisohidden = document.getElementById("Permisos");
            Permisohidden.value = Permisostxt
        }
    </script>';
    }
    echo $FormHtml;
}

function ModificarRol()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $IdRol = $_POST["IdRol"];
    $NombreRol = $_POST["NombreRol"];
    $Permisos = $_POST["Permisos"];

    $Sql = "UPDATE rol SET NombreRol = '" . $NombreRol . "', 
    Permisos = '" . $Permisos . "'
    WHERE IdRol = " . $IdRol;

    $Modificado = $Conexion->EjecutarInstruccion($Sql);

    if ($Modificado == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}

function DesactivarActivarRol()
{
    $Conexion = new PDODB();

    $Conexion->Conectar();

    $IdRol = $_POST['IdRol'];
    $EstadoRol = $_POST['EstadoRol'];

    if ($EstadoRol == 1) {
        $EstadoRol = 0;
    } else {
        $EstadoRol = 1;
    }

    $Sql = "UPDATE rol SET EstadoRol = '" . $EstadoRol . "'
    WHERE IdRol = " . $IdRol;

    $Modificado = $Conexion->EjecutarInstruccion($Sql);

    if ($Modificado == true) {
        echo "Modificado correctamente";
    } else {
        echo "No fue posible modificar";
    }
}
