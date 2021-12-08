
<?php



	if($_SERVER['REQUEST_METHOD'] === 'POST'){
			mi_cuenta($nombre,$apellidos,$email,$password,$telefono);	
	}


$id_cliente = $_SESSION['id_cliente'];
$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
while($r = mysqli_fetch_array($q)){
	?>
<ul class="nav nav-pills nav-fill"style="background-color: black;">
  <li class="nav-item">
    <a class="nav-link" href="mis-anuncios">Mis anuncios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="mi-cuenta">Mi cuenta</a>
  </li>
</ul>
 	<div class="container"style="padding: 1%;background-color: white;border-radius: 5px"  >
        <div class="form-group">
			<h1 >Datos de mi cuenta</h1>
        </div>
	<form  action="" method="post"  enctype="multipart/form-data" style="padding: 1%;background-color: white" >  
						
				<div class="form-group">
					<div class="row">
						<div class="col-6">
							<label class="label-control" for="nombre"> Nombre:</label>
							<input class="form-control" type="text" name="nombre" value="<?=$r['nombre']?>"/>
						</div> 
						<div class="col-6">
							<label class="label-control" for="apellidos"> Apellidos:</label>
							<input class="form-control" type="text" name="apellidos" value="<?=$r['apellidos']?>"/>
							
						</div>   
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<label class="label-control" for="email"> Email:</label>
								<input class="form-control" type="email"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="ejemplo@ejemplo.com" name="email" value="<?=$r['email']?>"/>
								
							</div>
						</div>    
			
						<div class="row">
							<div class="col">
								<label class="label-control" for="tele"> Teléfono:</label>
								<input class="form-control" type="tel" name="telefono" placeholder="999-999-999" value="<?=$r['telefono']?>" pattern="[0-9]{9}"/>					
							</div>
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
			        Para continuar debe confirmar su contraseña: 
			        <div class="row">
							<div class="col">
							    <input  class="form-control" type="password" name="password" id="password">
							</div>
						</div>
						<a href="envio_email&<?=$r['email']?>">¿Ha olvidado la contraseña?</a>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			        <button type="submit" class="btn btn-success" name="guardar_cuenta"><i class="fa fa-check"></i>Guardar</button>
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
			        Los datos no guardados se eliminarán
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