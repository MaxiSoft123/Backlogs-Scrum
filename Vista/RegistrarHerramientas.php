<body>
	<link rel="stylesheet" href="assets/css/estilos.css">


	<div class="ContenedorAñadir">

		<div class="NombreTabla">
			<h1>Añadir Herramientas e Insumos</h1>
			<img src="assets/Iconos/herramientas e insumos 2.svg" alt="">
		</div>

		<form class="">
			<img src="iconos/logomaxi.png" alt="">

			<div class="registro">

				<p class="letra">Nombre</p>
				<input name="Nombre" id="Nombre" type="text" placeholder="Ingrese el nombre">
				<br><br>

				<label class="letra" for="">Tipo</label>

				<select onclick="Cambio()" name="Tipo" id="Tipo">
					<option value="Herramienta">Herramienta</option>
					<option value="Insumo">Insumo</option>
				</select>
				<br>
				<br>

				<label class="letra" for="">Categoria</label>
				<select name="Categoria" id="Categoria">
					<option id="Manual" value="Manual">Manual</option>
					<option id="Electrica" value="Electrica">Electrica</option>
					<option id="Mecanica" value="Mecanica">Mecánica</option>
					<option id="Cable" style="display: none;" value="Cable">Cable</option>
					<option id="Router" style="display: none;" value="Router">Router</option>
					<option id="Switch" style="display: none;" value="Switch">Switch</option>
				</select>
				<br>
				<br>
				<label class="letra" for="">Descripcion</label>
				<input name="Descripcion" id="Descripcion" type="text" placeholder="Ingrese la descripción">
				<br>
				<br>
				<label class="letra" for="">Color</label>
				<input name="Color" id="Color" type="text" placeholder="Ingrese el color">
				<br><br>


				<label class="letra" for="">Tipo de Medida</label>
				<br>
				<select disabled name="Medida" id="Medida">
					<option value="M">Metros</option>
					<option value="Cm">Centímetros</option>
					<option value="Km">Kilometros</option>
					<option value="C">Cantidad</option>
				</select>
				<br><br>

				<label class="label_registrar_herramienta" for="">Cantidad</label>
				<input name="Cantidad" id="Cantidad" type="number" placeholder="Ingrese la cantidad">
				<br><br>


				</ul>
				<div class="Boton">
					<button id="registrar" class="BotonVerde" onclick="guardarHerramienta()">Registrar</button>
					<button id="cancelar" class="BotonRojo" onclick="borrado()">Cancelar</button>
				</div>
			</div>
		</form>
	</div>



</body>

</html>