var Asigna = 0
var IdRegistrados = []
var CantidadRegistrados = []
var Nombres = []
var UnidadDeMedida = []
var NuevaCantidad=0

function GuardarAgendamiento() {

    if (CantidadRegistrados.length === 0 && IdRegistrados.length===0) { 
        CantidadRegistrados=['0']
        IdRegistrados=['Ninguno']
        $.ajax({
            type: "POST",
            url: "../Controlador/Agendamiento.php",
            data: {
                'NombreCliente': $('#NombreCliente').val(),
                'IdUsuario': $('#Empleado').val(),
                'CantidadRegistrados': CantidadRegistrados,
                'IdRegistrados': IdRegistrados,
                'TelefonoCliente': $('#Telefono').val(),
                'FechaServicio': $('#Fecha').val(),
                'HoraAgendamiento': $('#Hora').val(),
                'IdServicio': $('#Servicio').val(),
                'IdHerramientaInsumo': $('#Insumos').val(),
                'Cantidad': $('#Cantidad').val(),
                'Descripcion': $('#Descripcion').val(),
                'DireccionCliente': $('#Direccion').val(),
                'Metodo': 'GuardarAgendamiento'
            },
            success: function (data) {
                alert(data);
                $('#NombreCliente').val('');
                $('#Telefono').val('');
                $('#Fecha').val('');
                $('#Servicio').val('');
                $('#Insumos').val('');
                $('#Cantidad').val('');
                $('#Direccion').val('');
                $('#Descripcion').val('');
                
            }
        });
        Metodo("ListarAgendamientoAdministrador.php")
    }else{
        $.ajax({
            type: "POST",
            url: "../Controlador/Agendamiento.php",
            data: {
                'NombreCliente': $('#NombreCliente').val(),
                'IdUsuario': $('#Empleado').val(),
                'CantidadRegistrados': CantidadRegistrados,
                'IdRegistrados': IdRegistrados,
                'TelefonoCliente': $('#Telefono').val(),
                'FechaServicio': $('#Fecha').val(),
                'HoraAgendamiento': $('#Hora').val(),
                'IdServicio': $('#Servicio').val(),
                'IdHerramientaInsumo': $('#Insumos').val(),
                'Cantidad': $('#Cantidad').val(),
                'Descripcion': $('#Descripcion').val(),
                'DireccionCliente': $('#Direccion').val(),
                'Metodo': 'GuardarAgendamiento'
            },
            success: function (data) {
                alert(data);
                $('#NombreCliente').val('');
                $('#Telefono').val('');
                $('#Fecha').val('');
                $('#Servicio').val('');
                $('#Insumos').val('');
                $('#Cantidad').val('');
                $('#Direccion').val('');
                $('#Descripcion').val('');
                
            }
        });
        Metodo("ListarAgendamientoAdmin.php")

    }
   
}

function GuardarInsumosAgendamiento() {

    var table = document.getElementById("AgendarInsumos");
    var Cantidad = document.getElementById("Cantidad");
    var Medida= document.getElementById("Medida");
    var Insumo = document.getElementById("Insumos");
    var Medida = document.getElementById("Medida");
    var CantidadActual = document.getElementById("CantidadActual"+Insumo.value);
    var IdInsumo = document.getElementById("IdInsumo"+Insumo.value);
    if (Cantidad != "" && Insumo.value!="" && Medida.value!="" ) {
    NuevaCantidad=CantidadActual.value-Cantidad.value;
    console.log(NuevaCantidad);
    if (NuevaCantidad>=0) {
        var row = table.insertRow(2);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        IdRegistrados.push(IdInsumo.value)
        CantidadRegistrados.push(Cantidad.value)
        UnidadDeMedida.push(Medida.value)
        Nombres.push(Insumo.value)
        cell1.innerHTML = Insumo.value;
        cell2.innerHTML = Cantidad.value;
        cell3.innerHTML = Medida.value;
        cell4.innerHTML = '<button  class="BotonRojo" onclick="EliminarInsumosAgendamiento()">Eliminar</button>';

        $.ajax({
            type: "POST",
            url: "../Controlador/Agendamiento.php",
            data: {
                
                'IdHerramientaInsumo': $('#Insumos').val(),
                'CantidadRegistrados': CantidadRegistrados,
                'IdRegistrados': IdRegistrados,
                'UnidadDeMedida': UnidadDeMedida,
                'NuevaCantidad': NuevaCantidad,
                'Cantidad': $('#Cantidad').val(),
                'Id': $('#IdInsumo').val(),
                'Metodo': 'GuardarInsumosAgendamiento'
            },
            success: function (data) {
                alert(data);
                SelectInsumo();
                $('#Insumos').val('');
                $('#Cantidad').val('');
                $('#Medida').val('');
                
            }
        });
 
}else{
    alert("Cantidad de Insumo Insuficiente,Tiene esta cantidad de Insumo disponible : "+CantidadActual.value)
    EliminarInsumosAgendamiento()
}
    }
}

function ValidacionAgendamiento(){
    var NombreCliente = document.getElementById("NombreCliente");
    var Telefono = document.getElementById("Telefono");
    var Fecha = document.getElementById("Fecha");
    var Hora = document.getElementById("Hora");
    var Direccion = document.getElementById("Direccion");
    var Descripcion = document.getElementById("Descripcion");
    NombreCliente= NombreCliente.value.trim();
    Telefono= Telefono.value.trim();
    Fecha= Fecha.value.trim();
    Hora= Hora.value.trim();
    Direccion=Direccion.value.trim();
    Descripcion= Descripcion.value.trim();
    if(NombreCliente=="" || Telefono=="" || Fecha=="" || Hora=="" || Direccion=="" || Descripcion==""){
        alert("Por favor llenar todos los campos")
    }else{
        GuardarAgendamiento();
    }
}


function EliminarInsumosAgendamiento() {
    $.ajax({
        type: "POST",
        url: "../Controlador/Agendamiento.php",
        data: {
            
            'CantidadRegistrados': CantidadRegistrados,
            'IdRegistrados': IdRegistrados,
            'NuevaCantidad': NuevaCantidad,
            'Metodo': 'EliminarInsumosAgendamiento'
        },
        success: function (data) {
            alert(data);
            SelectInsumo();
            $('#Insumos').val('');
            $('#Cantidad').val('');
            $('#Medida').val('');
            
        }
    });
    $(document).on('click', '.BotonRojo', function(event) {
        event.preventDefault();
        $(this).closest('tr').remove();
      });

      var table = document.getElementById("AgendarInsumos");
      var Cantidad = document.getElementById("Cantidad");
      var Insumo = document.getElementById("Insumos");
      var IdInsumo = document.getElementById("IdInsumo"+Insumo.value);
      for (let i = 0; i < Nombres.length; i++) {
        const Numero = Nombres[i];
        console.log(Numero)
        if(Numero==Nombres[i]) {
            IdRegistrados.splice(i, 1);
            CantidadRegistrados.splice(i, 1);
            Nombres.splice(i, 1); 
        }  }

}

function ListarAgendamiento() {

    $.ajax({
        type: "POST",
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "ListarAgendamiento"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function ListarAgendamientoAdministrador() {

    $.ajax({
        type: "POST",
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "ListarAgendamientoAdministrador"
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
        url: "../Controlador/Agendamiento.php",
        data: {
            'IdAgendamiento': IdAgendamiento,
            'Metodo': "CambiarEstado"
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
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "SelectAgendamiento"
        },
        datatype: "html",
        success: function (data) {
            $('#nombre').text("");
            $('#nombre').append(data);
        },
    });
}




function SelectServicio() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "SelectServicio"
        },
        success: function (data) {
            $('#Servicio').text("");
            $('#Servicio').append(data);
        }
    });
}

function SelectUsuario() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "SelectUsuario"
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
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "SelectInsumo"
        },
        success: function (data) {
            $('#Insumos').text("");
            $('#Insumos').append(data);
        }
    });
}

function SelectUnidadMedida() {
    $.ajax({
        type: 'POST',
        url: "../Controlador/Agendamiento.php",
        data: {
            'Metodo': "SelectUnidadMedida"
        },
        success: function (data) {
            $('#Medida').text("");
            $('#Medida').append(data);
        }
    });
}


function ModalAgendamiento(IdAgendamiento) {
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Agendamiento.php",
        data: {
            'IdAgendamiento': IdAgendamiento,
            'Metodo': "ModalAgendamiento"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}








function ModificarAgendamiento() {


    if (CantidadRegistrados.length === 0 && IdRegistrados.length===0) { 
        CantidadRegistrados=['0']
        IdRegistrados=['Ninguno']
        $.ajax({
            type: "POST",
            url: "../Controlador/Agendamiento.php",
            data: {
                'IdAgendamiento': $('#Agendamiento').val(),
                'NombreCliente': $('#NombreCliente').val(),
                'IdUsuario': $('#Empleado').val(),
                'CantidadRegistrados': CantidadRegistrados,
                'IdRegistrados': IdRegistrados,
                'TelefonoCliente': $('#Telefono').val(),
                'FechaServicio': $('#Fecha').val(),
                'HoraAgendamiento': $('#Hora').val(),
                'IdServicio': $('#Servicio').val(),
                'IdHerramientaInsumo': $('#Insumos').val(),
                'Cantidad': $('#Cantidad').val(),
                'Descripcion': $('#Descripcion').val(),
                'DireccionCliente': $('#Direccion').val(),
                'Metodo': 'ModificarAgendamiento'
            },
            success: function (data) {
                alert(data);
                CerrarModal();
                ListarAgendamientoAdministrador();
                
            }
        });
        Metodo("ListarAgendamientoAdministrador.php")
    }else{
        $.ajax({
            type: "POST",
            url: "../Controlador/Agendamiento.php",
            data: {
                'IdAgendamiento': $('#Agendamiento').val(),
                'NombreCliente': $('#NombreCliente').val(),
                'IdUsuario': $('#Empleado').val(),
                'CantidadRegistrados': CantidadRegistrados,
                'IdRegistrados': IdRegistrados,
                'TelefonoCliente': $('#Telefono').val(),
                'FechaServicio': $('#Fecha').val(),
                'HoraAgendamiento': $('#Hora').val(),
                'IdServicio': $('#Servicio').val(),
                'IdHerramientaInsumo': $('#Insumos').val(),
                'Cantidad': $('#Cantidad').val(),
                'Descripcion': $('#Descripcion').val(),
                'DireccionCliente': $('#Direccion').val(),
                'Metodo': 'ModificarAgendamiento'
            },
            success: function (data) {
                alert(data);
                CerrarModal();
                ListarAgendamientoAdministrador();
                
            }
        });
        Metodo("ListarAgendamientoAdmin.php")

    }

}