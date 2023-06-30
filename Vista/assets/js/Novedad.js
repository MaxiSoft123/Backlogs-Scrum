function GuardarNovedad() {
    event.preventDefault();
    var FechaActual = new Date().toLocaleString("en-US", { timeZone: "America/Bogota" });
    var FechaHoraActual = new Date(FechaActual);
    var FechaLimite = new Date(FechaActual);
    FechaLimite.setMonth(FechaLimite.getMonth() + 1);
    var FechaLimite = new Date(FechaLimite);
    var HoraInicioPermitida = new Date(FechaActual);
    HoraInicioPermitida.setHours(8, 0, 0); // 8:00 a.m.
    var HoraInicioPermitida = formatTime(HoraInicioPermitida);
    var HoraFinalPermitida = new Date(FechaActual);
    HoraFinalPermitida.setHours(17, 0, 0); // 5:00 p.m.
    var HoraFinalPermitida = formatTime(HoraFinalPermitida);

    function formatTime(date) {
        var hours = date.getHours().toString().padStart(2, "0");
        var minutes = date.getMinutes().toString().padStart(2, "0");
        return hours + ":" + minutes;
    }

    // Obtener los valores de los campos
    var Peticion = $('#Peticion').val();
    var Descripcion = $('#Descripcion').val();
    var Cambio = $('#Cambio').val();
    var HoraInicio = $('#HoraInicio').val();
    var HoraFinal = $('#HoraFinal').val();
    var FechaInicio = $('#FechaInicio').val();
    var FechaFinal = $('#FechaFinal').val();

    // Validar
    if (Peticion === '' || Descripcion === '' || Cambio === '' || FechaInicio === '' || FechaFinal === '') {
        alert('Por favor, completa todos los campos obligatorios.');
        return;
    }
    if (Peticion.trim() !== Peticion || Descripcion.trim() !== Descripcion) {
        alert('Los campos no deben tener espacios al principio.');
        return;
    }
    if (FechaInicio && FechaFinal) {
        var FechaInicio1 = new Date(FechaInicio);
        var FechaFinal1 = new Date(FechaFinal);

        if (FechaInicio1 > FechaFinal1) {
            alert("La fecha de inicio es mayor que la fecha final");
            return;
        }
        if (FechaInicio1 < FechaHoraActual || FechaFinal1 < FechaHoraActual) {
            alert("La fecha ingresada es invalida. La solicitud debe tener 1 o mas dias de anticipación");
            return;
        }
        if (FechaFinal1 > FechaLimite) {
            alert("La fecha ingresada supera el límite de un mes.");
            return;
        }
    }
    if (HoraInicio && HoraFinal) {

        if (HoraInicio > HoraFinal) {
            alert("La hora de inicio es mayor que la hora final");
            return;
        }
        if (HoraInicio < HoraInicioPermitida || HoraInicio > HoraFinalPermitida ||
            HoraFinal < HoraInicioPermitida || HoraFinal > HoraFinalPermitida) {
            alert("La hora ingresada está fuera del rango permitido (8:00 a.m. - 5:00 p.m.).");
            return;
        }
    }
    if (Cambio === 'Si') {
        if (HoraInicio === '' || FechaFinal === '') {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }
    }

    $.ajax({
        type: "POST",
        url: "../Controlador/Novedad.php",
        data: {
            'Peticion': $('#Peticion').val(),
            'Descripcion': $('#Descripcion').val(),
            'Cambio': $('#Cambio').val(),
            'HoraInicio': $('#HoraInicio').val(),
            'HoraFinal': $('#HoraFinal').val(),
            'FechaInicio': $('#FechaInicio').val(),
            'FechaFinal': $('#FechaFinal').val(),
            'metodo': 'GuardarNovedad'
        },
        success: function(data) {
            alert(data);
            $('#Peticion').val('');
            $('#Descripcion').val('');
            $('#HoraInicio').val('');
            $('#HoraFinal').val('');
            $('#FechaInicio').val('');
            $('#FechaFinal').val('');
        }
    });
}

function ListarNovedad(ListarNovedad) {
    $.ajax({
        type: "POST",
        url: "../Controlador/Novedad.php",
        data: {
            'EstadoLista': ListarNovedad,
            'metodo': "ListarNovedad"
        },
        datatype: "html",
        success: function(data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function ListarNovedades(EstadoNovedad) {
    $.ajax({
        type: "POST",
        url: "../Controlador/Novedad.php",
        data: {
            'EstadoLista': EstadoNovedad,
            'metodo': 'ListarNovedades'
        },
        datatype: "html",
        success: function(data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}


function ModalNovedad(IdNovedad) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Novedad.php",
        data: {
            'IdNovedad': IdNovedad,
            'metodo': "ModalNovedad"
        },
        success: function(data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}

function ModalAceptarNovedad(IdNovedad) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Novedad.php",
        data: {
            'IdNovedad': IdNovedad,
            'metodo': "ModalAceptarNovedad"
        },
        success: function(data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
            listarNovedades(1);
        }
    });
}

function ModalRechazarNovedad(IdNovedad) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Novedad.php",
        data: {
            'IdNovedad': IdNovedad,
            'metodo': "ModalRechazarNovedad"
        },
        success: function(data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
            listarNovedades(0);
        }
    });
}

function ModificarNovedad() {
    event.preventDefault();
    var FechaActual = new Date().toLocaleString("en-US", { timeZone: "America/Bogota" });
    var FechaHoraActual = new Date(FechaActual);
    var FechaLimite = new Date(FechaActual);
    FechaLimite.setMonth(FechaLimite.getMonth() + 1);
    var FechaLimite = new Date(FechaLimite);
    var HoraInicioPermitida = new Date(FechaActual);
    HoraInicioPermitida.setHours(8, 0, 0); // 8:00 a.m.
    var HoraInicioPermitida = formatTime(HoraInicioPermitida);
    var HoraFinalPermitida = new Date(FechaActual);
    HoraFinalPermitida.setHours(17, 0, 0); // 5:00 p.m.
    var HoraFinalPermitida = formatTime(HoraFinalPermitida);

    function formatTime(date) {
        var hours = date.getHours().toString().padStart(2, "0");
        var minutes = date.getMinutes().toString().padStart(2, "0");
        return hours + ":" + minutes;
    }

    // Obtener los valores de los campos
    var Peticion = $('#Peticion').val();
    var Descripcion = $('#Descripcion').val();
    var Cambio = $('#Cambio').val();
    var HoraInicio = $('#HoraInicio').val();
    var HoraFinal = $('#HoraFinal').val();
    var FechaInicio = $('#FechaInicio').val();
    var FechaFinal = $('#FechaFinal').val();

    // Validar
    if (Peticion === '' || Descripcion === '' || Cambio === '' || FechaInicio === '' || FechaFinal === '') {
        alert('Por favor, completa todos los campos obligatorios.');
        return;
    }
    if (Peticion.trim() !== Peticion || Descripcion.trim() !== Descripcion) {
        alert('Los campos no deben tener espacios al principio.');
        return;
    }
    if (FechaInicio && FechaFinal) {
        var FechaInicio1 = new Date(FechaInicio);
        var FechaFinal1 = new Date(FechaFinal);

        if (FechaInicio1 > FechaFinal1) {
            alert("La fecha de inicio es mayor que la fecha final");
            return;
        }
        if (FechaInicio1 < FechaHoraActual || FechaFinal1 < FechaHoraActual) {
            alert("La fecha ingresada es invalida. La solicitud debe tener 1 o mas dias de anticipación");
            return;
        }
        if (FechaFinal1 > FechaLimite) {
            alert("La fecha ingresada supera el límite de un mes.");
            return;
        }
    }
    if (HoraInicio && HoraFinal) {

        if (HoraInicio > HoraFinal) {
            alert("La hora de inicio es mayor que la hora final");
            return;
        }
        if (HoraInicio < HoraInicioPermitida || HoraInicio > HoraFinalPermitida ||
            HoraFinal < HoraInicioPermitida || HoraFinal > HoraFinalPermitida) {
            alert("La hora ingresada está fuera del rango permitido (8:00 a.m. - 5:00 p.m.).");
            return;
        }
    }
    if (Cambio === 'Si') {
        if (HoraInicio === '' || FechaFinal === '') {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }
    }
    $.ajax({
        type: 'POST',
        url: "../Controlador/Novedad.php",
        data: {
            'IdNovedad': $('#IdNovedad').val(),
            'Peticion': $('#Peticion').val(),
            'Descripcion': $('#Descripcion').val(),
            'Cambio': $('#Cambio').val(),
            'HoraInicio': $('#HoraInicio').val(),
            'HoraFinal': $('#HoraFinal').val(),
            'FechaInicio': $('#FechaInicio').val(),
            'FechaFinal': $('#FechaFinal').val(),
            'metodo': 'ModificarNovedad'
        },
        success: function(data) {
            alert(data);
            CerrarModal();
            ListarNovedad();
        }

    });
}

function AceptarRechazarNovedad() {
    $.ajax({
        type: "POST",
        url: "../Controlador/Novedad.php",
        data: {
            'IdNovedad': $('#IdNovedad').val(),
            'opcion': $('#opcion').val(),
            'metodo': "AceptarRechazarNovedad"
        },
        success: function(data) {
            alert(data);
            CerrarModal();
            ListarNovedades(2);
        }
    });
} // Cerrar modal

function CerrarModal() {
    const modal = document.querySelector("#modal");
    modal.classList.add("hide");
    modal.addEventListener("animationend", function close() {
        modal.classList.remove("hide");
        modal.close();
        modal.removeEventListener("animationend", close);
    });
}