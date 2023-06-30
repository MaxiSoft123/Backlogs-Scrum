<div class="ContenedorAñadir">
    <div class="NombreTabla">
        <h1>Añadir Empleados</h1>
        <img src="assets/Iconos/empleados.svg" alt="">
    </div>
    <form action="" method="POST">
        <label for="IdRol">Rol</label>
        <select name="IdRol" id="IdRol">
            <?php
            require_once '../../Modelo/Conexion.php';

            $Conexion = new PDODB();
            $Conexion->Conectar();

            $InstruccionSql = "SELECT * FROM rol Where EstadoRol = 1";
            $Resultado = $Conexion->ObtenerDatos($InstruccionSql);

            foreach ($Resultado as $key => $Datos) {
                echo '<option value="' . $Datos["IdRol"] . '">' . $Datos["NombreRol"] . '</option>';
            }
            ?>
        </select>
        <br>
        <label for="Nombre">Nombres</label>
        <input type="text" name="Nombre" id="Nombre" placeholder="Nombres" required />
        <br>
        <label for="Apellido">Apellidos</label>
        <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" required />
        <br>
        <label for="TipoDocumento">Tipo de documento</label>
        <select name="TipoDocumento" id="TipoDocumento" placeholder="Tipo de documento">
            <option value="Cédula">Cédula de Ciudadanía</option>
            <option value="Tarjeta de identidad">Tarjeta de Identidad</option>
            <option value="Cedula de extrangeria">Cédula de Extrangería</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>
        <br>
        <label for="Documento">Documento</label>
        <input type="number" name="Documento" id="Documento" placeholder="Documento" required />
        <br>
        <label for="Correo">Correo</label>
        <input type="email" name="Correo" id="Correo" placeholder="Correo" required />
        <br>
        <label for="Contrasena">Contraseña</label>
        <input id="Contrasena" name="Contrasena" type="password" placeholder="Ingrese la Contraseña" required />
        <br>
        <label for="Telefono">Telefono</label>
        <input type="number" name="Telefono" id="Telefono" placeholder="Telefono" required />
        <br>
        <label for="Direccion">Direccion</label>
        <input type="text" name="Direccion" id="Direccion" placeholder="Direccion" required />

        <div class="Boton">
            <button type="submit" value="Guardar" class="BotonVerde" onclick="RegistrarUsuario()">Registrar</button>
        </div>
    </form>

</div>