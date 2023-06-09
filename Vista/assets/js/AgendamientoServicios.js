
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
            'metodo': 'a'
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
        url: "../Controlador/ListarAgendamientoEmpleado.php",
        data: {
            'metodo': "e"
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
        url: "../Controlador/ListarServicios.php",
        data: {
            'Nombre': $('#NombredelServicio').val(),
            'metodo': 'a'
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
        url: "../Controlador/ListarAgendamientoAdministrador.php",
        data: {
            'metodo': "e"
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
        url: "../Controlador/ListarServicios.php",
        data: {
            'metodo': "e"
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
        url: "../Controlador/ListarAgendamientoAdministrador.php",
        data: {
            'id_agendamiento': IdAgendamiento,
            'metodo': "i"
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
            'metodo': "i"
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
        url: "../Controlador/ListarServicios.php",
        data: {
            'IdServicio': IdServicio,
            'metodo': "i"
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
            'metodo': "o"
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
            'metodo': "u"
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
            'metodo': "i"
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
        url: "../Controlador/ListarAgendamientoAdministrador.php",
        data: {
            'id_agendamiento': id_agendamiento,
            'metodo': "o"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}


function CerrarModal(){
    const modal = document.querySelector("#modal");
    modal.classList.add("hide");
    modal.addEventListener("animationend", function close() {
    modal.classList.remove("hide");
    modal.close();
    modal.removeEventListener("animationend", close);
  });
}

function ModalListar(IdServicio) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/ListarServicios.php",
        data: {
            'IdServicio': IdServicio,
            'metodo': "o"
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
            'metodo': 'u'
        },
        success: function (data) {
            alert(data);
    
        }

    });

    Metodo("ListarServicios.php")
}



function Metodo(pagina) {
    $.ajax({
        type: "POST",
        url: pagina,
        data: {},
        success: function (data) {
            $("#qCarga").html(data);
        }
    }
    );
};


function ModificarAgendamiento() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/ListarAgendamientoAdministrador.php",
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
            'metodo': 'u'
        },
        success: function (data) {
            alert(data);
            ListarAgendamientoAdministrador();
        
        }

    });
    Metodo("ListarAgendamientoAdmin:.php")
}