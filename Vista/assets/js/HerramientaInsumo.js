
function guardarHerramienta() {
    Nombre = document.getElementById('Nombre').value
    Descripcion = document.getElementById('Descripcion').value
    Color = document.getElementById('Color').value
    Cantidad = document.getElementById('Cantidad').value
    if(Nombre == "" || Descripcion == "" || Color == "" || Cantidad == ""){
        alert("Llene todos los campos")
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
            'Metodo': 'g'
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
            'Metodo': "awa"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}


function ModalHerramienta(Id) {

    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Id': Id,
            'Metodo': "kk"
        },
        datatype: "html",
        success: function (data) {
            $('macaco').text("");
            $('macaco').append(data);
        },
    });
}
function cerrarModal(){
    const modal = document.querySelector("#modal");

    modal.classList.add("hide");
    modal.addEventListener("animationend", function close() {
    modal.classList.remove("hide");
    modal.close();
    modal.removeEventListener("animationend", close);
  });
}

function ModificarHerramientas(){
    $.ajax({
        type: "POST",
        url: "../Controlador/HerramientaInsumo.php",
        data: {
            'Id': $('#Id').val(),
            'Nombre': $('#Nombre').val(),
            'Tipo': $('#Tipo').val(),
            'Categoria': $('#Categoria').val(),
            'Descripcion': $('#Descripcion').val(),
            'Color': $('#Color').val(),
            'Medida': $('#Medida').val(),
            'Cantidad': $('#Cantidad').val(),
            'Metodo': 'pollo'
        },
        success: function (data) {
            alert(data);
            ListarHerramienta();
        },
    })
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