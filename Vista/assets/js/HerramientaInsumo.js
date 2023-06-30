
function guardarHerramienta() {
    event.preventDefault();
    Nombre = document.getElementById('Nombre').value
    Descripcion = document.getElementById('Descripcion').value
    Color = document.getElementById('Color').value
    Cantidad = document.getElementById('Cantidad').value
    if(Nombre == "" || Descripcion == "" || Color == "" || Cantidad == ""){
        alert("Llene todos los campos")
    }
    else if(Nombre.trim() !== Nombre ||  Descripcion.trim() !== Descripcion || Color.trim() !== Color || Cantidad.trim() !== Cantidad){
        alert("El campo no puede iniciar con un espacio"); 
    }
    else{
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Nombre': $('#Nombre').val(),
            'Tipo': $('#Tipo').val(),
            'Categoria': $('#Categoria').val(),
            'Descripcion': $('#Descripcion').val(),
            'Color': $('#Color').val(),
            'Medida': $('#Medida').val(),
            'Cantidad': $('#Cantidad').val(),
            'Metodo': 'GuardarHerramienta'
        },
        success: function (data) {
            alert(data);
            $('#Nombre').val('');
            $('#Descripcion').val('');
            $('#Color').val('');
            $('#Cantidad').val('');
        }
    }
    )
}
}


function ListarHerramienta() {

    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Metodo': "ListarHerramientas"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}


function ModalModificarHerramienta(Id) {
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Id': Id,
            'Metodo': "ModalModificarHerramienta"
        },
        datatype: "html",
        success: function (data) {
            $('macaco').text("");
            $('macaco').append(data);
        },
    });
}


function ModalEliminarHerramienta(Id) {
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Id': Id,
            'Metodo': "ModalEliminarHerramienta"
        },
        datatype: "html",
        success: function (data) {
            $('macaco').text("");
            $('macaco').append(data);
        },
    });
}
 

function CasoModal() {
    if (document.getElementById('Caso').value == "Modificar"){
        ModificarHerramientas()
    }
    else{
        EliminarHerramienta()
    }
}


function ModificarHerramientas(){
    event.preventDefault();
    Nombre = document.getElementById('NombreHerramienta').value
    Descripcion = document.getElementById('Descripcion').value
    Color = document.getElementById('Color').value
    Cantidad = document.getElementById('Cantidad').value
    if(Nombre == "" || Descripcion == "" || Color == "" || Cantidad == ""){
        alert("Llene todos los campos")
    }
    else if(Nombre.trim() !== Nombre ||  Descripcion.trim() !== Descripcion || Color.trim() !== Color || Cantidad.trim() !== Cantidad){
        alert("El campo no puede iniciar con un espacio"); 
    }
    else{
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Id': $('#Id').val(),
            'Nombre': $('#NombreHerramienta').val(),
            'Tipo': $('#Tipo').val(),
            'Categoria': $('#Categoria').val(),
            'Descripcion': $('#Descripcion').val(),
            'Color': $('#Color').val(),
            'Medida': $('#Medida').val(),
            'Cantidad': $('#Cantidad').val(),
            'Metodo': 'ModificarHerramientas'
        },
        success: function (data) {
            alert(data);
            ListarHerramienta();
            CerrarModal();
        },
    })
}
}

function Cambio(){
    var tipo= document.getElementById('Tipo').value;
    var medida = document.getElementById('Medida');
     if (tipo == 'Herramienta'){
        medida.disabled = true
        document.getElementById('Manual').style.display = 'block';
        document.getElementById('Electrica').style.display = 'block';
        document.getElementById('Mecanica').style.display = 'block';
        document.getElementById('Cable').style.display = 'none';
        document.getElementById('Switch').style.display = 'none';
        document.getElementById('Router').style.display = 'none';
        document.getElementById('Categoria').value = "Manual"
    }
    if (tipo == 'Insumo'){
        medida.disabled = false
        document.getElementById('Manual').style.display = 'none';
        document.getElementById('Electrica').style.display = 'none';
        document.getElementById('Mecanica').style.display = 'none';
        document.getElementById('Cable').style.display = 'block';
        document.getElementById('Switch').style.display = 'block';
        document.getElementById('Router').style.display = 'block';
        document.getElementById('Categoria').value = "Cable"
    }
    
}
function DesactivarHerramientaInsumo(IdHerramientaInsumo, Estado){
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'IdHerramientaInsumo': IdHerramientaInsumo,
            'Estado': Estado,

            'Metodo': 'DesactivarHerramientaInsumo'
        },
        success: function (data) {
            alert(data);
            ListarHerramienta();
        },
    })
}


function EliminarHerramienta(){
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'IdHerramientaInsumo':  $('#Id').val(),
            'Metodo': 'EliminarHerramienta'
        },
        success: function (data) {
            alert(data);
            ListarHerramienta();
        },
    })  
}

function ValidarCantidad(){
    CantidadHerramienta = document.getElementById("Cantidad").value
    Faull = document.getElementById("Cantidad")
    CantidadHerramienta = CantidadHerramienta.replace(/[^0-9]/g, '');
    $(Faull).val(CantidadHerramienta);
    CantidadHerramienta = parseInt(CantidadHerramienta)
    if (CantidadHerramienta <= 1){
        $(Faull).val(1);
    }
}

function Busqueda() {
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Nombre': $('#Nombre').val(),
            'Metodo': "Busqueda"
        },
        datatype: "html",
      success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}