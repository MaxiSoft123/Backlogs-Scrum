var menuItems = document.querySelectorAll('.has-submenu');

menuItems.forEach(function (item) {
    item.addEventListener('click', function () {
        this.classList.toggle('open');
        var submenu = this.querySelector('.submenu');
        submenu.classList.toggle('open');
    });
});

function cargarpagina(urlPagina) {
    $.ajax({
        type: "POST",
        url: urlPagina,
        data: {},
        success: function (datos) {
            $('#EspacioHijo').html(datos);
        }
    });
}

// Funcionalidad del menu modal
var abrirMenuBtn = document.getElementById('abrir-menu');
var menuModal = document.getElementById('menu-modal');

abrirMenuBtn.addEventListener('click', function () {
    menuModal.style.display = 'block';
});

menuModal.addEventListener('click', function (e) {
    if (e.target === menuModal) {
        menuModal.style.display = 'none';
    }
});

// metodo para pasar de pagina
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

// Cerrar modal
function cerrarModal(){
    const modal = document.querySelector("#modal");
    modal.classList.add("hide");
    modal.addEventListener("animationend", function close() {
    modal.classList.remove("hide");
    modal.close();
    modal.removeEventListener("animationend", close);
  });
}
