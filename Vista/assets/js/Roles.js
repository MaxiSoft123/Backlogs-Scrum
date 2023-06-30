function RegistrarRol() {
    event.preventDefault();

    var AdministradorEmpleado = $('#IdPermiso').val();
    var NombreRol = $('#NombreRol').val();
    var IdPermiso = 0;
    var Permisos = null

    if (AdministradorEmpleado == 1) {
        console.log("Administrador Registrar")
        IdPermiso = 1;
        Permisos = $('#PermisosAdministrador').val();
    } else {
        console.log("Empleado Registrar")
        IdPermiso = 2;
        Permisos = $('#PermisosEmpleado').val();
    }

    // Validar campos vacíos
    if (NombreRol === '') {
        alert('Por favor, ingresa un nombre.');
        return;
    } else if (Permisos === '0,0,0' || Permisos === '0,0,0,0,0,0,0') {
        alert('Por favor, ingresa permisos.');
        return;
    } else if (NombreRol.trim() !== NombreRol) {
        alert('El nombre no debe tener espacios al principio.');
        return;
    }

    $.ajax({
        type: "POST",
        url: "../Controlador/Roles.php",
        data: {
            'NombreRol': $('#NombreRol').val(),
            'IdPermiso': IdPermiso,
            'Permisos': Permisos,
            'Metodo': 'RegistrarRol'
        },
        success: function(data) {
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
        success: function(data) {
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
        success: function(data) {
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
        success: function(data) {
            alert(data);
            ListarRoles();
        }
    });
}

function ModificarRol() {
    event.preventDefault();

    var AdministradorEmpleado = $('#IdPermiso').val();
    var NombreRol = $('#NombreRol').val();
    var IdPermiso = 0;
    var Permisos = null

    if (AdministradorEmpleado == 1) {
        console.log("Administrador Registrar")
        IdPermiso = 1;
        Permisos = $('#PermisosAdministrador').val();
    } else {
        console.log("Empleado Registrar")
        IdPermiso = 2;
        Permisos = $('#PermisosEmpleado').val();
    }

    // Validar campos vacíos
    if (NombreRol === '') {
        alert('Por favor, ingresa un nombre.');
        return;
    } else if (Permisos === '0,0,0' || Permisos === '0,0,0,0,0,0,0') {
        alert('Por favor, ingresa permisos.');
        return;
    } else if (NombreRol.trim() !== NombreRol) {
        alert('El nombre no debe tener espacios al principio.');
        return;
    }
    $.ajax({
        type: 'POST',
        url: "../Controlador/Roles.php",
        data: {
            'IdRol': $('#IdRol').val(),
            'IdRolNombre': $('#IdRolNombre').val(),
            'NombreRol': $('#NombreRol').val(),
            'IdPermiso': IdPermiso,
            'Permisos': Permisos,
            'Metodo': 'ModificarRol'
        },
        success: function(data) {
            alert(data);
            CerrarModal();
        }
    });
}