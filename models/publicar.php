<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$id_cliente=$_SESSION['id_cliente'];
	$imagen=$_FILES["imagen"];
	publicar($id_cliente,$titulo,$descripcion,$precio,$imagen,$categoria,$provincia,$localidad,$color,$km,$part_prof);
}

?>

<div class="container" style="background-color:white;color:black">
	<h1>Publica un anuncio</h1><br><br>

	<form method="post" action="" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" class="form-control" name="titulo" placeholder="Título del anuncio" required="true" />
		</div>
		<div class="form-group">
	      <div class="row">
	        <div class="col-6">
	          <input type="text" class="form-control" name="provincia" placeholder="Provincia" required="true" />
	        </div>
	        <div class="col-6">
	          <input type="text" class="form-control" name="localidad" placeholder="Localidad" required="true" />
	        </div>
	      </div>
	    </div>
	    <div class="form-group">
	      <select name="categoria" required class="form-control" required="true">
	        <option value="" >    Seleccione una categoria</option>
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
	  		<textarea class="form-control" name="descripcion" rows="4" cols="136" placeholder="Introduzca la descripcion del anuncio"></textarea>
		</div>


		<div class="form-group">
	      <div class="row">
	        <div class="col-6">
	          <input type="number" class="form-control" name="precio" placeholder="Precio" required="true"/>
	        </div>
	        <div class="col-6">
	          <input type="number" class="form-control" name="km" placeholder="Kilometros" required="true"/>
	        </div>
	    </div>

	    </div>
	    <div class="form-group">
	      <div class="row">
	        <div class="col-6">
	          <input type="text" class="form-control" name="color" placeholder="Color" required="true"/>
	        </div>
	        <div class="col-6">
	          <select name="part_prof" required class="form-control" required="true">
	            <option value="" >    Particular y profesional</option>
	            <option value="particular" >    Particular</option>
	            <option value="profesional" >    Profesional</option>
	          </select>
	        </div>
	      </div>

	    </div>

		<div class="form-group">	
	        <div class="container">
				<div class="row">
	   				<div class="col-md-6">
	              		<div class="form-group files color">
                			<label>Arrastre su imagen </label>
         <input type="file" class="form-control" id="imagen" name="imagen" multiple title="Imagen del anuncio" placeholder="Imagen"/>              </div>
			  		</div>
				</div>
			</div>

		</div>


		<div class="form-group">
			<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Agregar anuncio</button>
		</div>

	</form><br>

	<br>
</div>

<script type="text/javascript">
	$(document).on('change', '.file-input', function() {


var filesCount = $(this)[0].files.length;

var textbox = $(this).prev();

if (filesCount === 1) {
var fileName = $(this).val().split('\\').pop();
textbox.text(fileName);
} else {
textbox.text(filesCount + ' files selected');
}
});
</script>


<style type="text/css">

.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    display: block;
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
}
</style>