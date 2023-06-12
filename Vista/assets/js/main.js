var menuItems = document.querySelectorAll('.has-submenu');

menuItems.forEach(function (item) {
    item.addEventListener('click', function () {
        this.classList.toggle('open');
        var submenu = this.querySelector('.submenu');
        submenu.classList.toggle('open');
    });
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
function CerrarModal(){
    const modal = document.querySelector("#modal");
    modal.classList.add("hide");
    modal.addEventListener("animationend", function close() {
    modal.classList.remove("hide");
    modal.close();
    modal.removeEventListener("animationend", close);
  });
}
