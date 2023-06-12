// Inicio para realizar Prestamo
var Asigna = 0
var IdRegistrados = []
function ConsultaRealizarP() {
    Nombre = document.getElementById("Nombre").value
    Tipo = document.getElementById("Tipo").value
    ListarRealizarP(Nombre, Tipo)
}
function DefectoRealizarP() {
    ListarRealizarP("No", "No")
}
function ListarRealizarP(Nombre, Tipo) {
    $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'Nombre': Nombre,
            'Tipo': Tipo,
            'Metodo': "a"
        },
        datatype: "html",
        success: function (data) {
            $('tbody').text("");
            $('tbody').append(data);
        },
    });
}

function CambiarImagen(Id){
    if (IdRegistrados.includes(Id)) {
        Boton = document.getElementById("boton"+Id)
        Boton.src = '../Vista/Assets/Iconos/desactivar.svg'
    }
}

function Asignar(Id) {

    Boton = document.getElementById("boton"+Id)
    if (IdRegistrados.includes(Id)) {
        Referencia = document.getElementById("referencia" + Id)
        Div = Referencia.parentNode
        Referencia.parentNode.parentNode.removeChild(Div)
        for (let i = 0; i < IdRegistrados.length; i++) {
            if (Id == IdRegistrados[i]) {
                IdRegistrados.splice(i, 1);
            }}
        Boton.src = `../Vista/Assets/Iconos/agregar.svg`
    }
    else {
        Boton.src = '../Vista/Assets/Iconos/eliminar.svg'
        Asigna++
        Nombre = document.getElementById("Nombre" + Id).value


    

        Cantidad = document.getElementById("cantidad" + Id).value
         if(Cantidad == ""){
            Cantidad = 1 
            document.getElementById("cantidad"+Id).value = 1
         }
        
        var Cosa = document.createElement('tr');
        Cosa.setAttribute("id", "div" + Asigna);
        Cosa.setAttribute("class", "divAsigna");
        var Th = document.createElement("th");
        var Input = document.createElement("input");
        Input.setAttribute("type", "text");
        Input.setAttribute("id", "Nombres" + Asigna);
        Input.setAttribute("class", "campoprestar");
        Input.setAttribute("value", Nombre);
        Input.setAttribute("readonly", true)
        Th.appendChild(Input)
        Cosa.appendChild(Th)
        var Th = document.createElement("th");
        var Input = document.createElement("input");
        Input.setAttribute("type", "text");
        Input.setAttribute("id", "cantidades" + Asigna);
        Input.setAttribute("class", "campoprestar");
        Input.setAttribute("value", Cantidad);
        Input.setAttribute("readonly", true)
        Th.appendChild(Input)
        Cosa.appendChild(Th)
        var Th = document.createElement("th");
        var Input = document.createElement("input");
        Input.setAttribute("type", "hidden");
        Input.setAttribute("id", "ides" + Asigna);
        Input.setAttribute("value", Id);
        Th.appendChild(Input)
        Cosa.appendChild(Th)
        var Input = document.createElement("div");
        Input.setAttribute("id", "referencia" + Id);
        Cosa.appendChild(Input)
        
        document.getElementById("herramienta").appendChild(Cosa);
        IdRegistrados.push(Id)
    }
}
function Prestar() {
    if (IdRegistrados.length != 0) {
        Empleado = document.getElementById("id_empleado").value
        Cantidades = []
        Id = []
        Ins = 1
        Inst = 0
            while (Ins <= IdRegistrados.length) {
                Inst++
                try {
                    Cantidades.push(document.getElementById("cantidades" + Inst).value)
                    Id.push(document.getElementById("ides" + Inst).value)
                    Ins++
                }
                catch (error) {
                    console.log(Ins)
                }
            }
        
        console.log(Cantidades)
        $.ajax({
            type: "POST",
            url: "../Controlador/Prestamo.php",
            data: {
                'Ides': Id,
                'Cantidades': Cantidades,
                'IdEmpleado': Empleado,
                'Metodo': "r"
            },
            datatype: "html",
            success: function (data) {
                alert(data);
                ListarRealizarP("No", "No")
                Borrado()
            },
        });
    }
}
function Borrado() {
    Todo = document.getElementById("todo")
    Viejo = document.getElementById("herramienta")
    Todo.removeChild(Viejo)
    var Nuevo = document.createElement("table");
    Nuevo.setAttribute("id", "herramienta");
    Todo.appendChild(Nuevo)
    Asigna = 0
    IdRegistrados = []
}
function ListarNombresEmpleado(){
    $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'Metodo': "D"
        },
        datatype: "html",
        success: function (data) {
            $('#id_empleado').text("");
            $('#id_empleado').append(data);
        },
    });
}
function ListarNombresHerramienta(){
    Tipo = document.getElementById("Tipo").value
    $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'Metodo': "d",
            'Tipo': Tipo
        },
        datatype: "html",
        success: function (data) {
            $('#Nombre').text("");
            $('#Nombre').append(data);
        },
    });
}
function Validacion(Values){
    Cantidadd = document.getElementById("cantidadd"+Values).value
    Cantidad = document.getElementById("cantidad"+Values).value
    Faull = document.getElementById("cantidad"+Values)
    Cantidad = Cantidad.replace(/[^0-9]/g, '');
    $(Faull).val(Cantidad);
    Cantidad = parseInt(Cantidad)
    Cantidadd = parseInt(Cantidadd)
    if (Cantidad <= 1){
        $(Faull).val(1);
    }
    if (Cantidad > Cantidadd){
        $(Faull).val(Cantidadd);
    }
}
// Fin para realizar Prestamo

// Lista admin
function ListarPrestamoAdmin(NombreEmpleado){
$.ajax({
    type: "POST",
    url: "../Controlador/Prestamo.php",
    data: {
        'NombreEmpleado': NombreEmpleado,
        'Metodo': "l"
    },
    datatype: "html",
    success: function (data) {
        $('#ListarPrestamoAdmin').text("");
        $('#ListarPrestamoAdmin').append(data);
    },
});
}
function ListarPrestamoDañado(){
$.ajax({
    type: "POST",
    url: "../Controlador/Prestamo.php",
    data: {
        'Metodo': "L"
    },
    datatype: "html",
    success: function (data) {
        $('#ListarPrestamoDañado').text("");
        $('#ListarPrestamoDañado').append(data);
    },
});
}

function ConsultaEmpleadoPrestamo(){
    ListarPrestamoAdmin(document.getElementById("id_empleado").value)
}


function ModalModificarPrestamo(IdPrestamo){
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Prestamo.php",
        data: {
            'IdPrestamo': IdPrestamo,
            'Metodo': "k"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}

function Validacion2(){
    CantidadHerramienta = document.getElementById("CantidadHerramienta").value
    CantidadPrestamo = document.getElementById("CantidadPrestamo").value
    Faull = document.getElementById("CantidadPrestamo")
    CantidadPrestamo = CantidadPrestamo.replace(/[^0-9]/g, '');
    $(Faull).val(CantidadPrestamo);
    CantidadPrestamo = parseInt(CantidadPrestamo)
    CantidadHerramienta = parseInt(CantidadHerramienta)
    if (CantidadPrestamo <= 1){
        $(Faull).val(1);
    }
    if (CantidadPrestamo > CantidadHerramienta){
        $(Faull).val(CantidadHerramienta);
    }
}
function ModificarPrestamo(){
    CantidadPrestamo = document.getElementById("CantidadPrestamo").value
    IdPrestamo = document.getElementById("IdPrestamo").value
    if (CantidadPrestamo == ""){
        alert("Ingrese una Cantidad");
    }
    else{
        cerrarModal();
        $.ajax({
            type: 'POST',
            url: "../Controlador/Prestamo.php",
            data: {
                'CantidadPrestamo': CantidadPrestamo,
                'IdPrestamo': IdPrestamo,
                'Metodo': 'K'
            },
            success: function (data) {
                alert(data);
                ListarPrestamoAdmin(-999);
            }    
        });
    }
}

function ModalDevolverHerramienta(IdPrestamo){
    window.modal.showModal();
    $.ajax({
        type: 'POST',
        url: "../Controlador/Prestamo.php",
        data: {
            'IdPrestamo': IdPrestamo,
            'Metodo': "z"
        },
        success: function (data) {
            $('.modal-body').text("");
            $('.modal-body').append(data);
        }
    });
}

function Siono(){
    if (document.getElementById("Select").value == "si") 
    {
        document.getElementById("CantidadDañado").style.display = 'block' 
        document.getElementById("Observacion").style.display = 'block' 
        document.getElementById("Label1").style.display = 'block' 
        document.getElementById("Label2").style.display = 'block' 
    }
    else{
        document.getElementById("CantidadDañado").style.display = 'none'
        document.getElementById("Observacion").style.display = 'none' 
        document.getElementById("Label1").style.display = 'none'
        document.getElementById("Label2").style.display = 'none' 
    }
}

function Validacion3() {
    CantidadBase = document.getElementById("CantidadBase").value
    CantidadDañado = document.getElementById("CantidadDañado").value
    Faull = document.getElementById("CantidadDañado")
    CantidadDañado = CantidadDañado.replace(/[^0-9]/g, '');
    $(Faull).val(CantidadDañado);
    CantidadDañado = parseInt(CantidadDañado)
    CantidadBase = parseInt(CantidadBase)
    if (CantidadDañado <= 1){
        $(Faull).val(1);
    }
    if (CantidadDañado > CantidadBase){
        $(Faull).val(CantidadBase);
    }
}

function MetodoModal(){
    Metodo = document.getElementById("Metodo").value
    if (Metodo == "Modificar"){
    ModificarPrestamo()
}
    else if (Metodo == "Devolver"){
    DevolverHerramienta()
    }
    else if (Metodo == "Insumo"){
        EliminarInsumo()
        }
}

function EliminarInsumo(){
    IdPrestamo = document.getElementById("IdPrestamo3").value
    cerrarModal();
    $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'IdPrestamo': IdPrestamo,
            'Metodo': "Ñ"
        },
        datatype: "html",
        success: function (data) {
            alert(data);
            ListarPrestamoAdmin(-999)
            ListarPrestamoDañado()
        },
    });
}

function DevolverHerramienta(){
    IdPrestamo = document.getElementById("IdPrestamo2").value
    Select = document.getElementById("Select").value
    CantidadDañado = ""
    Observacion = ""
    if (Select == "si") 
    {
        CantidadDañado = document.getElementById("CantidadDañado").value
        Observacion = document.getElementById("Observacion").value
    }
    if (Select == "si" && CantidadDañado == ""){
        alert("Ingrese una Cantidad");
    }
    else if(Select == "si" && Observacion == ""){
        alert("Ingrese el motivo");
    }
    else{
    cerrarModal();
    $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'IdPrestamo': IdPrestamo,
            'Select': Select,
            'CantidadDañado': CantidadDañado,
            'Observacion': Observacion,
            'Metodo': "Z"
        },
        datatype: "html",
        success: function (data) {
            alert(data);
            ListarPrestamoAdmin(-999)
            ListarPrestamoDañado()
        },
    });}
}

function DevolverDañada(Id){
       $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'Id': Id,
            'Metodo': "V"
        },
        datatype: "html",
        success: function (data) {
            alert(data);
            ListarPrestamoAdmin(-999)
            ListarPrestamoDañado()
        },
    });
}

//lista empleado
function ListarPrestamoEmpleado(){
    $.ajax({
        type: "POST",
        url: "../Controlador/Prestamo.php",
        data: {
            'Metodo': "ñ"
        },
        datatype: "html",
        success: function (data) {
            $('#ListarPrestamoEmpleado').text("");
            $('#ListarPrestamoEmpleado').append(data);
        },
    });
    }