<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        ingrese el id del cliente
        <input id="id" name="id" type="number">
        <br>
        <input type="submit" value="entrar" name="entrar"/>
    </form>
    <?php
    session_start();
    session_destroy();
if (isset($_POST["entrar"])) {
    session_start();
    $_SESSION["id"] = $_POST["id"];
    header('Location: Home.php');
        }
    ?>

<br>


<a href="Home.php">admin</a>
</body>
</html>