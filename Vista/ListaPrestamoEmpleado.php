<div class="ContenedorListar">
    <div class="NombreTabla">
        <h1>Lista Prestamos</h1>
        <img src="assets/Iconos/prestamos2.svg" alt="">
    </div>


    <main class="table">
        <section class="TableBody">
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Herramienta</th>
                    <th>Tipo</th>
                    <th>Fecha Registro</th>
                    <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="ListarPrestamoEmpleado">


 
            
                </tbody>
            </table>
        </section>
    </main>
</div>


<!-- SCRIPTS -->
<script>
    $(document).ready(function() {
        ListarPrestamoEmpleado();
    });
</script>