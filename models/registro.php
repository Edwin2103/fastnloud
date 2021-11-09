
<?php

	if(isset($_SESSION['id_cliente'])){
		redir("./");
	}
		
	 if($_SERVER['REQUEST_METHOD'] === 'POST'){

		registro($nombre,$apellidos,$email,$password,$cpassword,$telefono);

	}
?>


 	<div class="container"style="padding: 1%;background-color: white;border-radius: 5px"  >
        <div class="form-group">
			<h1 >Registrate</h1>
        </div>
	<form  action="" method="post"  style="padding: 1%;background-color: white" >  		
				<div class="form-group">
					<div class="row">
						<div class="col-6">
							<label class="label-control" for="nombre"> Nombre:</label>
							<input class="form-control" type="text" name="nombre" placeholder="Introduzca su nombre"/>
						</div> 
						<div class="col-6">
							<label class="label-control" for="apellidos"> Apellidos:</label>
							<input class="form-control" type="text" name="apellidos" placeholder="Introduzca sus apellidos"/>
							
						</div>   
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<label class="label-control" for="email"> Email:</label>
								<input class="form-control" type="email"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="ejemplo@ejemplo.com" name="email" placeholder="Introduzca su email"/>
								
							</div>
						</div>    
						<div class="row">
							<div class="col">
								<label class="label-control" for="password"> Contraseña:</label>
								<input class="form-control" type="password" name="password" placeholder="Introduzca su contraseña"/>					
								
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label class="label-control" for="cpassword"> Repita la contraseña:</label>
								<input class="form-control" type="password" name="cpassword" placeholder="Introduzca de nuevo la contraseña"/>
							
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label class="label-control" for="password"> Teléfono:</label>
								<input class="form-control" type="tel" name="telefono"  placeholder="999-999-999" pattern="[0-9]{9}" />					
							</div>
						</div>
					</div>
				</div>
            		<button class="btn btn-success" type="submit" value="registrarme" name="registrarme">Registrarme</button>
            		<button class="btn btn-lg sr-button mt-1" value="login" name="login" ><a href="?p=login">¿Ya tiene una cuenta? Inicia sesión.</a></button>
			</form>
		</div>
