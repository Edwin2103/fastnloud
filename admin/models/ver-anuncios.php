<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require '../vendor/autoload.php';

  

	    if(isset($_POST['btnBorrar'])) {
	    	
            $borrar_anuncio = $_POST['btnBorrar'];
            $q = $mysqli->query("SELECT * FROM anuncios");

            $q2 = $mysqli->query("SELECT * FROM clientes");

      

          	if(mysqli_num_rows($q)<0){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> La categoría ya existe.';
				echo '</div>';
				
			}else{
				$mysqli->query("DELETE FROM anuncios WHERE  id = '$borrar_anuncio'");
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-success alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Anuncio eliminado.';
				echo '</div>';
				
			}
		}
		
		


$q = $mysqli->query("SELECT * FROM anuncios ORDER BY id DESC");
$q2 = $mysqli->query("SELECT count(*) as total FROM anuncios");
		
$data=mysqli_fetch_assoc($q2);	

    
?>

<form  action="" method="post"  enctype="multipart/form-data" style="padding: 1%;background-color: white" >  	
<table class="table table-striped" width="70" style="background-color: white;border-radius: 10px">
	<tr>
		<th><i class="fa fa-image"></i></th>
		<th>Total anuncios</th>
		<th>Diciembre</th>
		<th>Enero</th>
		<th>Febrero</th>
		<th>Marzo</th>
	</tr>

	<tr>
		<td></td>
			<td><?php echo $data['total'];?></td>
			<td><?php echo $data['total'];?></td>
			<td></td>
		</tr>
</table>

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
			<td><img src="../anuncios/<?=$r['imagen']?>" class="imagen_carro" style="width:100px;height:100px"/></td>
			<td><?=$r['titulo']?></td>
			<td id="contaanuncios"><?=$r['descripcion']?></td>
			<td><?=$r['precio']?></td>
			<td>	
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?=str_replace(' ','',$r['titulo']),$r['precio']?>"><i class="fa fa-times"></i> Eliminar</button>	

                <div class="modal fade" id="<?=str_replace(' ','',$r['titulo']),$r['precio']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        ¿Desea eliminar el anuncio: <?php echo $r['id']?> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-success" name="btnBorrar" value="<?=$r['id']?>" ><i class="fa fa-times"></i> Eliminar</a></button>
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
