<?php
include("../Modelo/Conexion.php");
switch ($_POST['metodo']) {
        case 'e':
            ListarAgendamiento();
            break;
            case 'i':
                CambiarEstado();
                break;
}

        


function ListarAgendamiento()
{
    session_start();


    $conexion = new PDODB();

    $conexion-> Conectar();

    $InstruccionSQL = "SELECT * FROM agendamiento";

    $resultado = $conexion->ObtenerDatos($InstruccionSQL);


    foreach ($resultado as $fila) {  
        $id_servicio= $fila['IdServicio'];
        $InstruccionSQL2 = "SELECT Nombre FROM servicios where IdServicio =".$id_servicio;
        $resultado2 = $conexion->ObtenerDatos($InstruccionSQL2);   
        foreach ($resultado2 as $fila2) { }
        $id_herramienta_e_insumo= $fila['IdHerramientaInsumo'];
        $InstruccionSQL3 = "SELECT Nombre,Cantidad FROM  HerramientaInsumo where IdHerramientaInsumo=".$id_herramienta_e_insumo;
        $resultado3 = $conexion->ObtenerDatos($InstruccionSQL3);   
        foreach ($resultado3 as $fila3) {    
            
        }
        $color = "Estado Activo";
        if($fila['Estado']=="Pendiente"){
            $color="Estado Inactivo";
        }
      
        echo'
        <tr>
        <td >',$fila['NombreCliente'],'</td>
        <td >',$fila2['Nombre'],'</td>
        <td >',$fila['DireccionCliente'],'</td>
        <td >',$fila['TelefonoCliente'],'</td>
        <td >',$fila['FechaServicio'],'|',$fila['HoraAgendamiento'],'</td>
        
        <td >',$fila3['Nombre'],'</td>
        <td >',$fila3['Cantidad'],'</td>
        <td >',$fila['Estado'],' </td>
        </tr>
        ';
    }
}


