<div class="ContenedorAñadir">
    <div class="NombreTabla">
        <h1>Añadir Roles</h1>
        <img src="assets/Iconos/roles2.svg" alt="">
    </div>
    <form action="">
        <p id="LabelNombreRol">Nombre rol</p>
        <input type="text" id="NombreRol" name="NombreRol" placeholder="Nombre del rol">
        <br><br>
        <center>
            <h1>Permisos</h1>
        </center>
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
        <div class="Boton">
            <button type="submit" value="Guardar" class="BotonVerde" onclick="RegistrarRol()">Registrar</button>
        </div>
    </form>
</div>
<script>
    var Permisos = [0, 0, 0, 0, 0, 0, 0]
    var Permisostxt = ""

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
        var permisohidden = document.getElementById("Permisos");
        permisohidden.value = Permisostxt
    }
</script>