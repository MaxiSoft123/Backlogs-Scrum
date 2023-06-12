function RegistrarRol() {
    $.ajax({
        type: "POST",
        url: "../Controlador/Roles.php",
        data: {
            'NombreRol': $('#NombreRol').val(),
            'Permisos': $('#Permisos').val(),
            'Metodo': 'RegistrarRol'
        },
        success: function (data) {
            alert(data);
            $('#NombreRol').val('');
        }
    });
}

function ListarRoles() {
    $.ajax({
        type: "POST",
        url: "../Controlador/Roles.php",
        data: {
            'Metodo': "ListarRoles"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function ConsultarRol(IdRol) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Roles.php",
        data: {
            'IdRol': IdRol,
            'Metodo': "ConsultarRol"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}



function DesactivarActivarRol(IdRol, EstadoRol) {

    $.ajax({
        type: 'POST',
        url: "../Controlador/Roles.php",
        data: {
            'IdRol': IdRol,
            'EstadoRol': EstadoRol,
            'Metodo': 'DesactivarActivarRol'
        },
        success: function (data) {
            alert(data);
            ListarRoles();
        }
    });
}

function ModificarRol() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/Roles.php",
        data: {
            'IdRol': $('#IdRol').val(),
            'NombreRol': $('#NombreRol').val(),
            'Permisos': $('#Permisos').val(),
            'Metodo': 'ModificarRol'
        },
        success: function (data) {
            alert(data);
            CerrarModal();
        }
    });

}