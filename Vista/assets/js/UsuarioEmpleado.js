
function RegistrarUsuarioEmpleado() {
    $.ajax({
        type: "POST",
        url: "../Controlador/UsuarioEmpleado.php",
        data: {
            'IdRol': $('#IdRol').val(),
            'Nombre': $('#Nombre').val(),
            'Apellido': $('#Apellido').val(),
            'TipoDocumento': $('#TipoDocumento').val(),
            'Documento': $('#Documento').val(),
            'Correo': $('#Correo').val(),
            'Contrasena': $('#Contrasena').val(),
            'Telefono': $('#Telefono').val(),
            'Direccion': $('#Direccion').val(),
            'Metodo': 'RegistrarUsuarioEmpleado'
        },
        success: function(data) {
            alert(data);
            $('#Nombre').val('');
            $('#Apellido').val('');
            $('#Documento').val('');
            $('#Correo').val('');
            $('#Contrasena').val('');
            $('#Telefono').val('');
            $('#Direccion').val('');
        }
    });
}

function ListarUsuarioEmpleado() {
    $.ajax({
        type: "POST",
        url: "../Controlador/UsuarioEmpleado.php",
        data: {
            'Estado': $('#Estado').val(),
            'Metodo': "ListarUsuarioEmpleado"
        },
        datatype: "html",
        success: function(data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function ConsultarUsuarioEmpleado(IdUsuario) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/UsuarioEmpleado.php",
        data: {
            'IdUsuario': IdUsuario,
            'Metodo': "ConsultarUsuarioEmpleado"
        },
        success: function(data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}

function ModificarUsuarioEmpleado() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/UsuarioEmpleado.php",
        data: {
            'IdUsuario': $('#IdUsuario').val(),
            'IdRol': $('#IdRol').val(),
            'Nombre': $('#Nombre').val(),
            'Apellido': $('#Apellido').val(),
            'TipoDocumento': $('#TipoDocumento').val(),
            'Documento': $('#Documento').val(),
            'Correo': $('#Correo').val(),
            'Telefono': $('#Telefono').val(),
            'Direccion': $('#Direccion').val(),
            'Estado': $('#Estado').val(),
            'Metodo': 'ModificarUsuarioEmpleado'
        },
        success: function(data) {
            alert(data);
            cerrarModal();
            ListarUsuarioEmpleado();
        }
    });
}

function DesactivarActivarUsuarioEmpleado(IdUsuario, Estado) {

    $.ajax({
        type: 'POST',
        url: "../Controlador/UsuarioEmpleado.php",
        data: {
            'IdUsuario': IdUsuario,
            'Estado': Estado,
            'Metodo': 'DesactivarActivarUsuarioEmpleado'
        },
        success: function(data) {
            alert(data);
            ListarUsuarioEmpleado();
        }
    });
}