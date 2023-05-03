<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista agendamiento Empleado</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<div class="contenedor">
        <div class="logoytitulo"> 
            <img src="../unnamed.png" alt="" class="logoytitulo">
        </div>
        <h2 class="logoytitulo">Trabajo Pendiente</h2>
        <br>
      
            <table class="table">
                <tr>
                <th>Nombre del <br> cliente</th>
                <th>Tipo de Servicio</th>
                <th>Lugar del Servicio</th>
                <th>Telefono</th>
                <th>Fecha/Hora</th>
                <th>Insumos</th>
                <th>Cantidad</th>
                <th>Estado</th>
                </tr>
                <?php include("php/Listado_Agendamiendo_Empleado.php")  ?>
            </table>
            <?php 
                      if(isset($_POST['estado'])){
                        $id=$_POST['id'];
                        $estado2=$_POST['estado'];
                        $estado1 = "pendiente";
                        if ($estado2 == "pendiente"){
                            $color="rojo";
                            $estado1 = "realizado";
                        }
                        $actualizarestado="UPDATE agendamiento SET estado='$estado1' WHERE id_agendamiento='$id'";
                        $resultado2 = mysqli_query($conex,$actualizarestado);
                        if($resultado2){
                            echo "Cambio realizado";
                        }
                        header('Location: listar_agendamiento_empleado.php');
                
                    }
                
                
                            
                            ?>   

    </div>
<script src="../../js/"></script>
