<?php

		$id_cliente=$_SESSION['id_cliente'];

	    if(isset($_POST['btnBorrar'])) {

	    	mis_anuncios($id_cliente);
		}
		
		

$id_cliente = clear($_SESSION['id_cliente']);
$q = $mysqli->query("SELECT * FROM anuncios WHERE id_cliente = '$id_cliente' ORDER BY id DESC");
		

    
?>

 
<ul class="nav nav-pills nav-fill"style="background-color: black;">
  <li class="nav-item">
    <a class="nav-link" href="?p=mis-anuncios">Mis anuncios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="?p=mi-cuenta">Mi cuenta</a>
  </li>
</ul>
<form  action="" method="post"  enctype="multipart/form-data" style="padding: 1%;background-color: white" >  	

<table class="table table-striped" width="70" style="background-color: white;border-radius: 10px">
	<tr>
		<th><i class="fa fa-image"></i></th>
		<th>Nombre del producto</th>
		<th>Descripción</th>
		<th>Precio</th>
		<th>Action</th>
	</tr>

<?php
/*if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM anuncios WHERE nombre = '$eliminar'");
	redir("mis-anuncios");
}*/



while($r = mysqli_fetch_array($q)){
	?>
		<tr>
			<td><img src="anuncios/<?=$r['imagen']?>" class="imagen_carro"/></td>
			<td><?=$r['titulo']?></td>
			<td id="contaanuncios"><?=$r['descripcion']?></td>
			<td><?=$r['precio']?></td>
			<td>		
				<button class="btn btn-primary " type="button" ><i class="fa fa-edit"></i><a href="?p=modificar-anuncio&<?=$r['id']?>">Actualizar</a> </button>
                </button>
                
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?=str_replace(' ','',$r['titulo']),$r['id']?>"><i class="fa fa-times"></i> Eliminar</button>
				
				<!-- Modal -->
				<div class="modal fade" id="<?=str_replace(' ','',$r['titulo']),$r['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ¿Desea eliminar el anuncio?
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
				        <button class="btn btn-danger " type="submit" id="btnBorrar" name="btnBorrar" value="<?=$r['id']?>"><i class="fa fa-times"></i> Eliminar</button>
				      </div>
				    </div>
				  </div>
				</div>
			</td>
		</tr>
	<?php


}


   
?>
</table>
</form>

</div>
</div>
</div>
</div>

<style type="text/css">
#contaanuncios {
	height: 50px;
	width: 50%;
	border: 1px solid #ddd;
	overflow-y: scroll;
}
</style>
