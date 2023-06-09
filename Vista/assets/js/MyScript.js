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

function metododemrd(pagina) {
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
function metodo(pagina) {
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