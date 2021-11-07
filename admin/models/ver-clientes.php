<?php

require 'conf.php';
		
		
$q = $mysqli->query("SELECT * FROM clientes ORDER BY id DESC");
$q2 = $mysqli->query("SELECT count(*) as total FROM clientes");
		
$data=mysqli_fetch_assoc($q2);

    

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $borrar_cliente = $_POST['btnBorrar'];
            $q = $mysqli->query("SELECT * FROM clientes WHERE email = '$borrar_cliente'");

          	if(mysqli_num_rows($q)<0){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> El cliente no existe.';
				echo '</div>';
				
			}else{
				$mysqli->query("DELETE FROM clientes WHERE email = '$borrar_cliente'");
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-success alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Cliente: '.$borrar_cliente.' eliminado correctamente';
				echo '</div>';				
			}
        }
?>


<form  action="" method="post"  enctype="multipart/form-data" style="padding: 1%;background-color: white" >  	
<table class="table table-striped" width="70" style="background-color: white;border-radius: 10px">
	<tr>
		<th><i class="fa fa-image"></i></th>
		<th>Total usuarios</th>
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
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>Email</th>
		<th>Teléfono</th>
		<th>Action</th>
	</tr>

<?php



while($r = mysqli_fetch_array($q)){

	?>
		<tr>
			<td></td>
			<td><?=$r['nombre']?></td>
			<td><?=$r['apellidos']?></td>
			<td><?=$r['email']?></td>
			<td><?=$r['telefono']?></td>
			<td>		
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?=str_replace(' ','',$r['nombre']),$r['id']?>"><i class="fa fa-times"></i> Eliminar</button>	

                <div class="modal fade" id="<?=str_replace(' ','',$r['nombre']),$r['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        ¿Desea eliminar el usuario: <?php echo $r['email']?> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-success"  name="btnBorrar" value="<?=$r['email']?>"><i class="fa fa-times"></i> Eliminar</a></button>
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




