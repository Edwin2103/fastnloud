<?php

    if(isset($_SESSION['id_cliente'])){
    	redir("./");
    }
    	
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        login($email,$password);
    
    }
    
?>

   <div class="container"style="background-color: white;border-radius: 5px"  >
        <div class="form-group" style="padding: 1%">
            <h1 style="margin-top: 20px">Formulario</h1>
        </div>
        <hr>
        <form id="login-form" name="input" action="" method="post" class="form-horizontal" style="padding: 1%">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="label-control" for="email"> Email:</label>
                        <input class="form-control" type="text" name="email" placeholder="Introduzca su email"/>
                        <?php 
							if (isset($_POST['login']) && empty($_POST['email'])) 
								echo "<span style='color:red'>¡Debe introducir el email!</span>" 
						?>
                    </div>   
                </div>     
                <div class="row">
                    <div class="col">
                        <label class="label-control" for="password"> Contraseña:</label>
                        <input class="form-control" type="password" name="password" placeholder="Introduzca su contraseña" />
                        <?php 
							if (isset($_POST['login']) && empty($_POST['password'])) 
								echo "<span style='color:red'>¡Debe introducir la contraseña!</span>" 
						?>
                    </div>    
                </div>
            </div>
            
            <button class="btn btn-success" value="login" name="login">Login</button>
            <button class="btn btn-lg sr-button mt-1" value="registrarme"><a href="registro">Registrate</a></button>           
        </form>
    </div>