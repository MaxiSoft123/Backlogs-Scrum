<link rel="stylesheet" href="assets/css/estilos.css">
<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Lista de Herramientas e Insumos</h1>
        <img src="assets/Iconos/herramientas e insumos 2.svg" alt="">
    </div>
    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                        <th class="">ID</th>
                        <th class="">Nombre</th>
                        <th class="">Tipo</th>
                        <th class="">categoria</th>
                        <th class="">Color</th>
                        <th class="">Descripción</th>
                        <th class="">Medida</th>
                        <th class="">Cantidad</th>
                        <th class="">Fecha</th>
                        <th class="">Operaciones</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </section>
    </main>
    <dialog id="modal">
        <macaco class="modal-body">
            ...
        </macaco>
        <div class="Boton">
            <button class="BotonVerde" onclick="cerrarModal(); ModificarHerramientas()">Guardar</button>
            <button class="BotonRojo" onclick="cerrarModal()">Cancelar</button>
        </div>

    </dialog>

    </body>

    </html>

    <script>
        $(document).ready(function() {
            ListarHerramienta();
        });
    </script>
</div>