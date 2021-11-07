
<?php



	if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$id_cliente=$_SESSION['id_cliente'];
			$email = $_GET['email'];
		cambiar_pass($id_cliente,$nueva_password,$cpassword,$email);			
		
	}

$id_cliente = $_SESSION['id_cliente'];
$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
while($r = mysqli_fetch_array($q)){
	?>
 	<div class="container"style="padding: 1%;background-color: white;border-radius: 5px"  >
        <div class="form-group">
			<h1 >Restablecer contraseña</h1>
        </div>
	<form  action="" method="post"  enctype="multipart/form-data" style="padding: 1%;background-color: white" >  
						
				<div class="form-group">
					<div class="row">
						
							<label class="label-control" for="nueva_password"> Nueva contraseña:</label>
							<input  class="form-control" type="password" name="nueva_password" id="nueva_password">
											   
					</div>
					<div class="form-group">
						<div class="row">
							
							<label class="label-control" for="cpassword"> Repita la contraseña:</label>
							<input  class="form-control" type="password" name="cpassword" id="cpassword">
							
							
						</div>    
					</div>
				</div>
			<div class="form-group">
			

			<div class="form-group">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fa fa-check"></i> Guardar</button>				
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        ¿Desea guardar su nueva contraseña? 
			       </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			        <button type="submit" class="btn btn-success" name="cambiar_pass"><i class="fa fa-check"></i>Guardar</button>
			      </div>
			    </div>
			  </div>
			</div>


			
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-times"></i> Cancelar</button>
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        ¿Los datos no guardados se eliminarán?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			        <button type="submit" class="btn btn-danger" name="cancelar"><i class="fa fa-times"></i> <a href="gestionar">Salir</a></button>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		</div>
	</form>
     
<?php
}
?>