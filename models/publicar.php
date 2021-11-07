<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$id_cliente=$_SESSION['id_cliente'];
	$imagen=$_FILES["imagen"];
	publicar($id_cliente,$titulo,$descripcion,$precio,$imagen,$categoria);
}

?>
<div class="container" style="background-color:white;color:black">
	<h1>Publica un anuncio</h1><br><br>

	<form method="post" action="" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" class="form-control" name="titulo" placeholder="Título del anuncio" required="true" />
		</div>

		<div class="form-group">
	  		<textarea class="form-control" name="descripcion" rows="4" cols="136" placeholder="Introduzca la descripcion del anuncio"></textarea>
		</div>

		<div class="form-group">
			<input type="number" class="form-control" name="precio" placeholder="Precio" required="true"/>
		</div>


		<label>Imagen del producto</label>

		<div class="form-group">
			<input type="file" class="form-control" id="imagen" name="imagen" multiple title="Imagen del anuncio" placeholder="Imagen"/>
		</div>

		<div class="form-group">

			<select name="categoria" required class="form-control" required="true">
				<option value="">Seleccione una categoria</option>
				<?php
					$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");

					while($r=mysqli_fetch_array($q)){
						?>
							<option value="<?=$r['id']?>"><?=$r['categoria']?></option>
						<?php
					}
				?>
			</select>

		</div>


		<div class="form-group">
			<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Agregar anuncio</button>
		</div>

	</form><br>

	<br>
</div>

