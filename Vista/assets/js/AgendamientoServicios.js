
function GuardarAgendamiento() {
    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'NombreCliente': $('#NombreCliente').val(),
            'IdEmpleado': $('#Empleado').val(),
            'TelefonoCliente': $('#Telefono').val(),
            'FechaServicio': $('#Fecha').val(),
            'HoraAgendamiento': $('#Hora').val(),
            'IdServicio': $('#Servicio').val(),
            'IdHerramientaInsumo': $('#Insumos').val(),
            'Cantidad': $('#CantidadInsumo').val(),
            'Descripcion': $('#Descripcion').val(),
            'DireccionCliente': $('#Direccion').val(),
            'metodo': 'GuardarAgendamiento'
        },
        success: function (data) {
            alert(data);
            $('#NombreCliente').val('');
            $('#Telefono').val('');
            $('#Fecha').val('');
            $('#Servicio').val('');
            $('#Insumos').val('');
            $('#CantidadInsumo').val('');
            $('#Direccion').val('');
            $('#Descripcion').val('');
            
        }
    });
    Metodo("ListarAgendamientoAdmin.php")
}
function ListarAgendamiento() {

    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "ListarAgendamiento"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function GuardarServicio() {
    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'Nombre': $('#NombredelServicio').val(),
            'metodo': 'GuardarServicio'
        },
        success: function (data) {
            alert(data);
            $('#NombredelServicio').val('');
        }
    });
    Metodo("ListarServicios.php")

}
function ListarAgendamientoAdministrador() {

    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "ListarAgendamientoAdministrador"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function ListarServicios() {

    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "ListarServicios"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}


function CambiarEstado(IdAgendamiento) {
    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'id_agendamiento': IdAgendamiento,
            'metodo': "CambiarEstado"
        },
        success: function (data) {
            alert(data);
            ListarAgendamientoAdministrador();
        }
    });
}


function  SelectAgendamiento(){
    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "SelectAgendamiento"
        },
        datatype: "html",
        success: function (data) {
            $('#nombre').text("");
            $('#nombre').append(data);
        },
    });
}

function DesactivarServicio(IdServicio) {
    $.ajax({
        type: "POST",
        url: "../Controlador/AgendarServicio.php",
        data: {
            'IdServicio': IdServicio,
            'metodo': "DesactivarServicio"
        },
        success: function (data) {
            alert(data);
            ListarServicios();
        }
    });
}



function SelectServicio() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "SelectServicio"
        },
        success: function (data) {
            $('#Servicio').text("");
            $('#Servicio').append(data);
        }
    });
}

function SelectEmpleado() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "SelectEmpleado"
        },
        success: function (data) {
            $('#Empleado').text("");
            $('#Empleado').append(data);
        }
    });
}
function SelectInsumo() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/AgendarServicio.php",
        data: {
            'metodo': "SelectInsumo"
        },
        success: function (data) {
            $('#Insumos').text("");
            $('#Insumos').append(data);
        }
    });
}


function ModalAgendamiento(id_agendamiento) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/AgendarServicio.php",
        data: {
            'id_agendamiento': id_agendamiento,
            'metodo': "ModalAgendamiento"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}



function ModalListar(IdServicio) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/AgendarServicio.php",
        data: {
            'IdServicio': IdServicio,
            'metodo': "ModalListar"
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
        url: "../Controlador/ListarServicios.php",
        data: {
            'IdServicio': $('#Servicio').val(),
            'Nombre': $('#NombreServicio').val(),
            'metodo': 'ModificarListar'
        },
        success: function (data) {
            alert(data);
    
        }

    });

    Metodo("ListarServicios.php")
}





function ModificarAgendamiento() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/AgendarServicio.php",
        data: {
            'IdAgendamiento': $('#Agendamiento').val(),
            'NombreCliente': $('#NombreCliente').val(),
            'IdEmpleado': $('#Empleado').val(),
            'TelefonoCliente': $('#Telefono').val(),
            'FechaServicio': $('#Fecha').val(),
            'HoraAgendamiento': $('#Hora').val(),
            'IdServicio': $('#Servicio').val(),
            'IdHerramientaInsumo': $('#Insumos').val(),
            'Cantidad': $('#CantidadInsumo').val(),
            'Descripcion': $('#Descripcion').val(),
            'DireccionCliente': $('#Direccion').val(),
            'metodo': 'ModificarAgendamiento'
        },
        success: function (data) {
            alert(data);
            CerrarModal();
            ListarAgendamientoAdministrador();
        
        }

    });

}