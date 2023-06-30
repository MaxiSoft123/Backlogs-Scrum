function ValidarCorreo(Correo) {
    // Expresión regular para validar el formato del correo electrónico
    var Patron = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Verificar si el correo coincide con el patrón
    if (Patron.test(Correo)) {
        return true; // El correo es válido
    } else {
        return false; // El correo no es válido
    }
}

function RegistrarUsuario() {
    event.preventDefault();
    // Obtener los valores de los campos
    var IdRol = $('#IdRol').val();
    var Nombre = $('#Nombre').val();
    var Apellido = $('#Apellido').val();
    var TipoDocumento = $('#TipoDocumento').val();
    var Documento = $('#Documento').val();
    var Correo = $('#Correo').val();
    var Contrasena = $('#Contrasena').val();
    var Telefono = $('#Telefono').val();
    var Direccion = $('#Direccion').val();

    // Validar campos vacíos
    if (IdRol === '' || Nombre === '' || Apellido === '' || TipoDocumento === '' || Documento === '' || Correo === '' || Direccion === '') {
        alert('Por favor, completa todos los campos obligatorios.');
        return;
    } else if (Nombre.trim() !== Nombre || Apellido.trim() !== Apellido || TipoDocumento.trim() !== TipoDocumento || Documento.trim() !== Documento || Correo.trim() !== Correo || Telefono.trim() !== Telefono || Direccion.trim() !== Direccion) {
        alert('Los campos no deben tener espacios al principio.');
        return;
    } else if (Documento.length < 6 || Documento.length > 15) {
        alert("El numero de Documento es invalido");
        return;
    } else if (Nombre.length < 10 || Nombre.length > 100) {
        alert("El Nombre del empleado es invalido (Minimo 10 caracteres Maximo 100)");
        return;
    } else if (Apellido.length < 10 || Apellido.length > 100) {
        alert("El Apellido del empleado es invalido (Minimo 10 caracteres Maximo 100)");
        return;
    } else if (Contrasena.length < 8 || Nombre.length > 128) {
        alert("La contraseña es invalida (Minimo 8 caracteres Maximo 128)");
        return;
    } else if (Telefono.length < 10 || Telefono.length > 10) {
        alert("El numero de Telefono es invalido (Debe tener 10 caracteres)");
        return;
    } else if (!ValidarCorreo(Correo)) {
        console.log("El correo no es válido");
    }

    $.ajax({
        type: "POST",
        url: "../Controlador/Usuario.php",
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
            'Metodo': 'RegistrarUsuario'
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

function ListarUsuario(ListarUsuario) {
    $.ajax({
        type: "POST",
        url: "../Controlador/Usuario.php",
        data: {
            'ListarUsuario': ListarUsuario,
            'Metodo': "ListarUsuario"
        },
        datatype: "html",
        success: function(data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function ConsultarUsuario(IdUsuario) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Usuario.php",
        data: {
            'IdUsuario': IdUsuario,
            'Metodo': "ConsultarUsuario"
        },
        success: function(data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}

function ModificarUsuario() {
    event.preventDefault();
    // Obtener los valores de los campos
    var IdRol = $('#IdRol').val();
    var Nombre = $('#Nombre').val();
    var Apellido = $('#Apellido').val();
    var TipoDocumento = $('#TipoDocumento').val();
    var Documento = $('#Documento').val();
    var Correo = $('#Correo').val();
    var Contrasena = $('#Contrasena').val();
    var Telefono = $('#Telefono').val();
    var Direccion = $('#Direccion').val();

    // Validar campos vacíos
    if (IdRol === '' || Nombre === '' || Apellido === '' || TipoDocumento === '' || Documento === '' || Correo === '' || Direccion === '') {
        alert('Por favor, completa todos los campos obligatorios.');
        return;
    } else if (Nombre.trim() !== Nombre || Apellido.trim() !== Apellido || TipoDocumento.trim() !== TipoDocumento || Documento.trim() !== Documento || Correo.trim() !== Correo || Telefono.trim() !== Telefono || Direccion.trim() !== Direccion) {
        alert('Los campos no deben tener espacios al principio.');
        return;
    } else if (Documento.length < 6 || Documento.length > 15) {
        alert("El numero de Documento es invalido");
        return;
    } else if (Nombre.length < 10 || Nombre.length > 100) {
        alert("El Nombre del empleado es invalido (Minimo 10 caracteres Maximo 100)");
        return;
    } else if (Apellido.length < 10 || Apellido.length > 100) {
        alert("El Apellido del empleado es invalido (Minimo 10 caracteres Maximo 100)");
        return;
    } else if (Contrasena.length < 8 || Nombre.length > 128) {
        alert("La contraseña es invalida (Minimo 8 caracteres Maximo 128)");
        return;
    } else if (Telefono.length < 10 || Telefono.length > 10) {
        alert("El numero de Telefono es invalido (Debe tener 10 caracteres)");
        return;
    } else if (!ValidarCorreo(Correo)) {
        console.log("El correo no es válido");
    }
    $.ajax({
        type: 'POST',
        url: "../Controlador/Usuario.php",
        data: {
            'IdUsuario': $('#IdUsuario').val(),
            'IdRol': $('#IdRol').val(),
            'Nombre': $('#Nombre').val(),
            'Apellido': $('#Apellido').val(),
            'TipoDocumento': $('#TipoDocumento').val(),
            'Documento': $('#Documento').val(),
            'Correo': $('#Correo').val(),
            'Contrasena': $('#Contrasena').val(),
            'Telefono': $('#Telefono').val(),
            'Direccion': $('#Direccion').val(),
            'Metodo': 'ModificarUsuario'
        },
        success: function(data) {
            alert(data);
            cerrarModal();
            ListarUsuario(1);
        }
    });
}

function DesactivarActivarUsuario(IdUsuario, Estado) {
    $.ajax({
        type: 'POST',
        url: "../Controlador/Usuario.php",
        data: {
            'IdUsuario': IdUsuario,
            'Estado': Estado,
            'Metodo': 'DesactivarActivarUsuario'
        },
        success: function(data) {
            alert(data);
            ListarUsuario(1);
        }
    });
}