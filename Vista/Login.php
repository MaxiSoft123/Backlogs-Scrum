<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "maxisoft";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$bdname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "No se establecio la conexion: " . $e->getMessage();
}
function verificar_Correo($Correo, $Contrasena)
{
    global $connection;

    $consulta = "SELECT * FROM usuario INNER JOIN rol WHERE usuario.IdRol = rol.IdRol AND Correo = :Correo";
    $stmt = $connection->prepare($consulta);
    $stmt->bindParam(':Correo', $Correo);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && $Contrasena == $resultado['Contrasena']) {
        return $resultado;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Correo = $_POST['Correo'];
    $ContrasenaEncryptada = $_POST['Contrasena'];
    $Salt = 'MaxiSoft';
    $Contrasena =  hash('sha512', $Salt . $ContrasenaEncryptada);

    $datos_Correo = verificar_Correo($Correo, $Contrasena);

    if ($datos_Correo) {
        session_start();
        $_SESSION['sesion_iniciada'] = true;
        $_SESSION['IdUsuario'] = $datos_Correo['IdUsuario'];
        $_SESSION['Nombre'] = $datos_Correo['Nombre'];
        $_SESSION['NombreRol'] = $datos_Correo['NombreRol'];
        $_SESSION['Permisos'] = explode(",", $datos_Correo['Permisos']);
        $_SESSION['Apellido'] = $datos_Correo['Apellido'];
        $_SESSION['Documento'] = $datos_Correo['Documento'];
        $_SESSION['Contrasena'] = $datos_Correo['Contrasena'];
        $_SESSION['Telefono'] = $datos_Correo['Telefono'];
        $_SESSION['Estado'] = $datos_Correo['Estado'];

        header('Location: home.php');
        exit;
    } else {
        $mensaje_error = 'Correo o Contraseña son incorrectos';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Maxisoft</title>
    <link rel="stylesheet" href="assets/css/Login.css">
    <link rel="shortcut icon" href="assets/img/MaxiwifiLogo.png" />
</head>

<body>
    <div class="Contenedor">
        <div class="login">
            <form action="#" method="post">
                <img src="assets/img/MaxiwifiLogo.png" alt="">
                <!-- <h1>Login</h1> -->
                <br>
                <label for="">Correo</label>
                <input id="Correo" name="Correo" type="email" placeholder="Ingrese su correo elecronico">
                <label for="">Contrasena</label>
                <input id="Contrasena" name="Contrasena" type="password" placeholder="Ingrese la Contraseña">
                <br>
                <button type="submit" class="BotonEntrar">Iniciar sesion</button>
            </form>
            <?php if (isset($mensaje_error)) { ?>
                <p style="color: red;"><?php echo $mensaje_error; ?></p>
            <?php } ?>
        </div>
    </div>
    <br>
</body>

</html>