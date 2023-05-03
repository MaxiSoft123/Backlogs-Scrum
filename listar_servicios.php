<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<main class="tabla_servicios">
        <div class="contenedor">

<center>
    <img src="../unnamed.png" alt="logo" class="logoytitulo">
            <h2 class="logoytitulo">Lista de Servicios</h2>
            <br>
            
                <table class="table">
                <tr class="fila_servicios">
                            <th class="encabezado_servicios">Nombre</th class="encabezado_servicios">
                           <th class="encabezado_servicios">  Estado</th class="encabezado_servicios">
                            <th class="encabezado_servicios">Operación</th class="encabezado_servicios">
                        </tr>
                        <tr class="fila_servicios">
                        <?php include("php/listar.php")  ?>          
                </table>
            
            </center>
        </div>
    </main>
    <?php 
                      if(isset($_POST['estado'])){
                        $id=$_POST['id'];
                        $estado2=$_POST['estado'];
                        $estado1 = "Desactivado";
                        if ($estado2 == "Desactivado"){
                            $color="rojo";
                            $estado1 = "Activo";
                        }
                        $consulta2="UPDATE servicios SET estado='$estado1' WHERE id_servicios='$id'";
                        $resultado2 = mysqli_query($conex,$consulta2);
                        if($resultado2){
                            echo "Cambio realizado";
                        }
                        header('Location: listar_servicios.php');
                
                    }
                
                
                            
                            ?>