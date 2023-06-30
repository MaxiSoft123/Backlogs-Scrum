
function GuardarServicio() {
    $.ajax({
        type: "POST",
        url: "../Controlador/Servicio.php",
        data: {
            'Nombre': $('#NombredelServicio').val(),
            'Metodo': 'GuardarServicio'
        },
        success: function (data) {
            alert(data);
            $('#NombredelServicio').val('');
        }
    });
    Metodo("ListarServicios.php")

}

function ValidacionServicio(){
    var NombreCliente = document.getElementById("NombredelServicio");
    NombreCliente= NombreCliente.value.trim();
    if(NombreCliente=="" || Telefono=="" || Fecha=="" || Hora=="" || Direccion=="" || Descripcion==""){
        alert("Por favor llenar todos los campos")
    }else{
        GuardarServicio();
    }
}


function ListarServicios() {

    $.ajax({
        type: "POST",
        url: "../Controlador/Servicio.php",
        data: {
            'Metodo': "ListarServicios"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}


function DesactivarServicio(IdServicio, Estado) {
    $.ajax({
        type: "POST",
        url: "../Controlador/Servicio.php",
        data: {
            'IdServicio': IdServicio,
            'Estado': Estado,
            'Metodo': "DesactivarServicio"
        },
        success: function (data) {
            alert(data);
            ListarServicios();
        }
    });
}




function ModalListar(IdServicio) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Servicio.php",
        data: {
            'IdServicio': IdServicio,
            'Metodo': "ModalListar"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}


function ModificarListar() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/Servicio.php",
        data: {
            'IdServicio': $('#Servicio').val(),
            'Nombre': $('#NombreServicio').val(),
            'Metodo': 'ModificarListar'
        },
        success: function (data) {
            alert(data);
    
        }

    });

    Metodo("ListarServicios.php")
}
