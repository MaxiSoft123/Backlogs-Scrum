<div class="ContenedorAñadir">
    <div class="NombreTabla">
        <h1>Añadir Roles</h1>
        <img src="assets/Iconos/roles2.svg" alt="">
    </div>
    <form action="">
        <input type="hidden" id="IdPermiso" name="IdPermiso">
        <p id="LabelNombreRol">Nombre rol</p>
        <input type="text" id="NombreRol" name="NombreRol" placeholder="Nombre del rol">
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
                <button type="submit" value="Guardar" class="BotonVerde" onclick="RegistrarRol()">Registrar</button>
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
                <button type="submit" value="Guardar" class="BotonVerde" onclick="RegistrarRol()">Registrar</button>
            </div>
        </div>

    </form>
</div>

<script>
    var PermisosAdministrador = [0, 0, 0, 0, 0, 0, 0]
    var PermisostxtAdministrador = ""

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
            console.log('Switch activado Administrador');
            PermisosAdministrador[num] = 1
            console.log(PermisosAdministrador.toString())
        } else {
            // Aquí puedes enviar los datos si el switch está desactivado 
            console.log('Switch desactivado Administrador');
            PermisosAdministrador[num] = 0
            console.log(PermisosAdministrador.toString())
        }
        PermisostxtAdministrador = PermisosAdministrador.toString()
        var permisohidden = document.getElementById("PermisosAdministrador");
        permisohidden.value = PermisostxtAdministrador
    }

    var Permisos = [0, 0, 0]
    var Permisostxt = ""

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
            console.log('Switch activado');
            Permisos[num] = 1
            console.log(Permisos.toString())
        } else {
            // Aquí puedes enviar los datos si el switch está desactivado 
            console.log('Switch desactivado');
            Permisos[num] = 0
            console.log(Permisos.toString())
        }
        Permisostxt = Permisos.toString()
        var permisohidden = document.getElementById("PermisosEmpleado");
        permisohidden.value = Permisostxt
    }

    document.getElementById('Administrador').addEventListener('change', function() {
        var OpcionAdministrador = document.getElementById('OpcionAdministrador');
        var OpcionEmpleado = document.getElementById('OpcionEmpleado');
        var IdPermiso = document.getElementById("IdPermiso");

        if (this.checked) {
            OpcionAdministrador.style.display = 'block';
            OpcionEmpleado.style.display = 'none';
            document.getElementById('Empleado').checked = false;
            IdPermiso.value = 1;
        } else {
            OpcionAdministrador.style.display = 'none';
        }
    });

    document.getElementById('Empleado').addEventListener('change', function() {
        var OpcionAdministrador = document.getElementById('OpcionAdministrador');
        var OpcionEmpleado = document.getElementById('OpcionEmpleado');
        var IdPermiso = document.getElementById("IdPermiso");

        if (this.checked) {
            OpcionAdministrador.style.display = 'none';
            OpcionEmpleado.style.display = 'block';
            document.getElementById('Administrador').checked = false;
            IdPermiso.value = 2;
        } else {
            OpcionEmpleado.style.display = 'none';
        }
    });
</script>