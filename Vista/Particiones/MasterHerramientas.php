<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Lista de Herramientas e Insumos</h1>
        <img src="assets/Iconos/herramientas e insumos 2.svg" alt="">
    </div>
<br>

<p aling="left">
    <button aling="left" id="registrar" class="BotonVerde" onclick='Metodo("Particiones/RegistrarHerramientas.php")'>Registrar</button>
</p>
    <div>
    <br>
		<label class="letra" for="">Realizar Busqueda</label>
        <br>
		<input name="Busqueda" id="Nombre" type="text" placeholder="Buscador por nombre">
<br><br>        <center>
        <button class="BotonVerde" onclick="Busqueda()">Buscar</button>
</center>
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
                        <th class="">Estado</th>
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
            <button class="BotonVerde" onclick="CerrarModal(); CasoModal()">Aceptar</button>
            <button class="BotonRojo" onclick="CerrarModal()">Cancelar</button>
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