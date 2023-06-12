<div class="ContenedorAñadir">
    <div class="NombreTabla">
        <h1>Añadir Roles</h1>
        <img src="assets/Iconos/roles2.svg" alt="">
    </div>
    <form action="">
        <select name="IdRol" id="IdRol" placeholder="Roles">
            <?php
            require_once '../Modelo/Conexion.php';

            $Conexion = new PDODB();

            $Conexion->Conectar();

            $InstruccionSQL = "SELECT * FROM rol";

            $Resultado = $Conexion->ObtenerDatos($InstruccionSQL);

            foreach ($Resultado as $key => $Datos) {
                echo '<option value="' . $Datos["IdRol"] . '">' . $Datos["NombreRol"] . '</option>';
            }
            ?>
        </select>

        <input type="text" name="Nombre" id="Nombre" placeholder="Nombres" required />
        <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" required />
        <select name="TipoDocumento" id="TipoDocumento" placeholder="Tipo de documento">
            <option value="Cédula">Cédula de Ciudadanía</option>
            <option value="Tarjeta de identidad">Tarjeta de Identidad</option>
            <option value="Cedula de extrangeria">Cédula de Extrangería</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>

        <input type="number" name="Documento " id="Documento" placeholder="Documento" required />
        <input type="email" name="Correo " id="Correo" placeholder="Correo" required />
        <input id="Contrasena" name="Contrasena" type="password" placeholder="Ingrese la Contraseña" required />
        <input type="number" name="Telefono " id="Telefono" placeholder="Telefono" required />
        <input type="text" name="Direccion " id="Direccion" placeholder="Direccion" required />
        <div class="Boton">
            <button type="submit" value="Guardar" class="BotonVerde" onclick="RegistrarUsuarioEmpleado()">Registrar</button>
        </div>
    </form>
</div>