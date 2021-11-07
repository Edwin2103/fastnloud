<?php
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;


$host_mysql = "qafl089.tabwebs.com";
$db_mysql = "qafl089";
$user_mysql = 'qafl089';
$pass_mysql = 'Fast2021';
$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);
	
if (mysqli_connect_errno()) {
    exit('Fallo Conexion: '. mysqli_connect_error());
}

function clear($var){
	htmlspecialchars($var);

	return $var;
}

function check_admin(){
	if(!isset($_SESSION['id'])){
		redir("./");
	}
}

function redir($var){
	?>
	<script>
		window.location="<?=$var?>";
	</script>
	<?php
	die();
}


function check_user($url){

	if(!isset($_SESSION['id_cliente'])){
		redir("?p=login&return=$url");
	}else{

	}

}

function nombre_cliente($id_cliente){
	$mysqli = connect();

	$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
	$r = mysqli_fetch_array($q);
	return $r['nombre'];
}

function connect(){
	$host_mysql = "qafl089.tabwebs.com";
	$db_mysql = "qafl089";
	$user_mysql = 'qafl089';
	$pass_mysql = 'Fast2021';
	$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

	return $mysqli;
}


function login($email,$password){
require_once('classes/Exception.class.php');
		$mysqli = connect();
		$email = $email;
    	$password = sha1($password);

    	$q = $mysqli->query("SELECT * FROM clientes WHERE email = '$email' AND password = '$password'");
        $admin = $mysqli->query("SELECT * FROM admins WHERE email = '$email' AND password = '$password'");
        $errores = [];
        
        try {
           if (empty($email)) {
                $errores[]= "El email no puede estar vacio";
                
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $errores[]= "Email no válido";
            }
            if (empty($password)) {
                $errores[]= "La contraseña no puede estar vacia";
            }
            if (!empty($errores)) {
                throw new ValidationException("Se han producido errores"); 
                
            }else{
            	if(mysqli_num_rows($admin)>0){
		        
		            if(isset($return)){
		                    redir("?p=".$return);
		            }else{
		                    $r = mysqli_fetch_array($admin);
		                    $_SESSION['id'] = $r['id'];
		                    redir("admin/");     
		                }
		        }else{
		           if(mysqli_num_rows($q)>0){
		                $r = mysqli_fetch_array($q);
		                $_SESSION['id_cliente'] = $r['id'];

		                if(isset($return)){
		                    redir("?p=".$return);
		                }else{
		                    redir("./");
		                }
		            }else{
		                echo '<div class="alert-dismissible"></div>';
		                echo '<div class="alert alert-danger alert-dismissible">';
		                echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		                </a> Los datos no son validos';
		                echo '</div>';
		            }
           		}
           	}
		}catch (ValidationException $e) {
            //echo $e->getMessage()."<br>";
	        foreach($errores as $error){
					echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-danger alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a>'. $error;
					echo '</div>';
				}   
	    }

        
    
}


function registro($nombre,$apellidos,$email,$password,$cpassword,$telefono){
	require_once('classes/Exception.class.php');
		$mysqli = connect();
		$nombre = $nombre;
		$apellidos = $apellidos;
		$email = $email;
		$password = sha1($password);
		$cpassword = sha1($cpassword);
		$telefono = $telefono;
		

		$q = $mysqli->query("SELECT * FROM clientes WHERE email = '$email'");

		$errores = [];
        
        try {
            if (empty($nombre)) {
                $errores[]= "El nombre no puede estar vacio";
                
            }
            if (empty($apellidos)) {
                $errores[] = "Los apellidos no puede estar vacio";
                
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $errores[]= "El email no es correcto";
            }
            if (empty($email)) {
                $errores[]= "El email no puede estar vacio";
            }
            if (empty($password)) {
                $errores[] = "La contraseña no puede estar vacia";
                
            }
            if (empty($cpassword)) {
                $errores[] = "La contraseña no puede estar vacia";
                
            }
            if(sha1($password)!=sha1($cpassword)){
            	$errores[] = "Las contraseñas no coinciden";
            }
            if (!is_numeric($telefono)) {
                $errores[] = "El número de teléfono debe de ser números";
               
            }
            if (strlen($telefono) != 9) {
                $errores[] = "El número de teléfono debe tener 9 números";
                
            }
            if (!empty($errores)) {
                throw new ValidationException("Se han producido errores"); 
                
            }
            else{
				if(mysqli_num_rows($q)>0){
					echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-danger alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a> El usuario ya existe.';
					echo '</div>';
					
				}else{
					$mysqli->query("INSERT INTO clientes (nombre,apellidos,email,password,telefono) VALUES ('$nombre','$apellidos','$email','$password','$telefono')");


					$q2 = $mysqli->query("SELECT * FROM clientes WHERE email = '$email'");

					$r = mysqli_fetch_array($q2);

					$_SESSION['id_cliente'] = $r['id'];

					echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-success alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a> Registrado exitósamente';
					echo '</div>';
					redir('home');
				}
			}
		} catch (ValidationException $e) {
            //echo $e->getMessage()."<br>";
            foreach($errores as $error){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a>'. $error;
				echo '</div>';
			}
        }
}


function agregar_lista_deseos($id_cliente){
	$mysqli = connect();	
	$q = $mysqli->query("SELECT * FROM carro WHERE id_cliente='$id_cliente'");
	if(isset($_POST['btnBorrar'])) {
            $borrar_anuncio = $_POST['btnBorrar'];
            $q = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_anuncio = '$borrar_anuncio'");

          	if(mysqli_num_rows($q)<0){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Se ha producido un error.';
				echo '</div>';
				
			}else{
				$mysqli->query("DELETE FROM carro WHERE id_cliente = '$id_cliente' AND id_anuncio = '$borrar_anuncio'");
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-success alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Anuncio eliminado.';
				echo '</div>';
				redir('lista-deseos');
				
			}
		}
}

function foro($id_cliente,$mensaje){
	$mysqli = connect();	
	$mysqli->query("INSERT INTO mensajes (id_cliente,mensaje) VALUES ('$id_cliente','$mensaje')");
	echo '<div class="alert-dismissible"></div>';
	echo '<div class="alert alert-success alert-dismissible">';
	echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
	</a> Mensaje enviado';
	echo '</div>';

	 
}




//GESTION

function mi_cuenta($nombre,$apellidos,$email,$password,$telefono){
	require_once('classes/Exception.class.php');
	$mysqli = connect();

	$id_cliente=$_SESSION['id_cliente'];
	$nombre = $nombre;
	$apellidos = $apellidos;
	$email = $email;
	$password = sha1($password);
	
	//$cpassword = sha1($cpassword);
	$telefono = $telefono;
	

	$q = $mysqli->query("SELECT * FROM clientes WHERE email = '$email'");
	$confirma = $mysqli->query("SELECT * FROM clientes WHERE password = '$password'");
	$pasClie = $mysqli->query("SELECT password FROM clientes WHERE email = '$email'");
	$errores = [];
        
    try {
        if (empty($nombre)) {
            $errores[]= "El nombre no puede estar vacio";
            
        }
        if (empty($apellidos)) {
            $errores[] = "Los apellidos no puede estar vacio";
            
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $errores[]= "El email no es correcto";
        }
        if (empty($email)) {
            $errores[]= "El email no puede estar vacio";
        }
        if (empty($password)) {
            $errores[] = "La contraseña no puede estar vacia";
        }
        if (!is_numeric($telefono)) {
            $errores[] = "El número de teléfono debe de ser números";
           
        }
        if (strlen($telefono) != 9) {
            $errores[] = "El número de teléfono debe tener 9 números";
            
        }
        if (!empty($errores)) {
            throw new ValidationException("Se han producido errores"); 
            
        }
        else{

        	while($r = mysqli_fetch_array($pasClie)){
        		if ($r['password']==$password) {
            		if (mysqli_num_rows($confirma)>0){
			        	if(mysqli_num_rows($q)>0){
							$mysqli->query("UPDATE clientes SET nombre='$nombre',apellidos='$apellidos',email='$email',telefono='$telefono' WHERE id='$id_cliente'");
							echo '<div class="alert-dismissible"></div>';
							echo '<div class="alert alert-success alert-dismissible">';
							echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
							</a> Datos actualizados. Quiere volver a su <a href="gestionar">área</a>';
							echo '</div>';
						}else{
							echo '<div class="alert-dismissible"></div>';
							echo '<div class="alert alert-danger alert-dismissible">';
							echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
							</a> Se ha producido un error.';
							echo '</div>';
						
						}
		        	}else{
		        		echo '<div class="alert-dismissible"></div>';
						echo '<div class="alert alert-danger alert-dismissible">';
						echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
						</a> No hay.';
						echo '</div>';
		        	}
        		}else{
        			echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-danger alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a> La contraseñas no coincide.';
					echo '</div>';
    			}
        	}
	        //if (sha1($password)== $pasClie) {
	            
				
	        /*}else{
	        	echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Las contraseñas no coinciden.';
				echo '</div>';
	        }*/
        	
	        
		}
	} catch (ValidationException $e) {
            //echo $e->getMessage()."<br>";
            foreach($errores as $error){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a>'. $error;
				echo '</div>';
			}
		}
	
}
			

function cambiar_pass($id_cliente,$nueva_password,$cpassword,$email){
	require_once('classes/Exception.class.php');
	$mysqli = connect();

	$id_cliente=$_SESSION['id_cliente'];
	$nueva_password = sha1($nueva_password);
	$cpassword = sha1($cpassword);
	
	

	$q = $mysqli->query("SELECT * FROM clientes WHERE email = '$email'");
	
	
	$errores = [];
        
    try {


        if (empty($nueva_password)) {
            $errores[] = "La contraseña no puede estar vacia";
        }
        if (empty($cpassword)) {
            $errores[] = "Debe volver a escribir la contraseña";
        }
        if ($nueva_password!=$cpassword) {
            $errores[] = "Las contraseñas no coinciden";
            
        }
        if (!empty($errores)) {
            throw new ValidationException("Se han producido errores"); 
            
        }
        else{
        	$mysqli->query("UPDATE clientes SET password='$nueva_password' WHERE id='$id_cliente'");
			echo '<div class="alert-dismissible"></div>';
			echo '<div class="alert alert-success alert-dismissible">';
			echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
			</a> Contraseña actualizada. Inicie sesion <a href="login">Login</a>';
			echo '</div>';
			@session_destroy();
			
	        
		}
	} catch (ValidationException $e) {
            //echo $e->getMessage()."<br>";
            foreach($errores as $error){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a>'. $error;
				echo '</div>';
			}
		}
	
}





function mis_anuncios($id_cliente){
	$mysqli = connect();
	
    $borrar_anuncio = $_POST['btnBorrar'];
    $q = $mysqli->query("SELECT * FROM anuncios WHERE id_cliente = '$id_cliente'");

  	if(mysqli_num_rows($q)<0){
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-danger alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> La categoría ya existe.';
		echo '</div>';
		
	}else{
		$mysqli->query("DELETE FROM anuncios WHERE id_cliente = '$id_cliente' AND id = '$borrar_anuncio'");
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-success alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> Anuncio eliminado.';
		echo '</div>';
		
	}
}


function modificar_anuncio($id_cliente,$imagen,$titulo,$descripcion,$categoria,$precio,$id_anuncio){
	$mysqli = connect();
	$titulo = clear($titulo);
	$descripcion = clear($descripcion);
	$precio = clear($precio);
	$r['id']=$categoria;
	$imagen=$_FILES["imagen"];
	

  	if(is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
  	  	$archivotitulo = $_FILES["imagen"]["name"]; 
		$archivotituloimg = $titulo.rand(0,1000).".png";
		$fuente = $_FILES["imagen"]["tmp_name"];
		$carpeta = 'anuncios/'; //Declaramos el titulo de la carpeta que guardara los archivos
				
		$dir=opendir($carpeta);
		$target_path = $carpeta.'/'.$archivotituloimg; //indicamos la ruta de destino de los archivos

  	  	if(move_uploaded_file($fuente, $target_path)) {	
  	  		
  	  		$mysqli->query("UPDATE anuncios SET titulo='$titulo',imagen='$archivotituloimg',id_categoria='$categoria',descripcion='$descripcion',precio='$precio' WHERE id_cliente = '$id_cliente' AND id = '$id_anuncio'");
			echo '<div class="alert-dismissible"></div>';
			echo '<div class="alert alert-success alert-dismissible">';
			echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
			</a> Anuncio actualizado';
			echo '</div>';
  	  	}else {	
			echo '<div class="alert-dismissible"></div>';
			echo '<div class="alert alert-danger alert-dismissible">';
			echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
			</a> Se a producido un error, intentelo más tarde.';
			echo '</div>';
		}
		closedir($dir); //Cerramos la conexion con la carpeta destino
		redir('mis-anuncios');
  	}else{
	
		$mysqli->query("UPDATE anuncios SET titulo='$titulo',id_categoria='$categoria',descripcion='$descripcion',precio='$precio' WHERE id_cliente = '$id_cliente' AND id='$id_anuncio'");
		
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-success alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> Anuncio actualizado.';
		echo '</div>';
		redir('mis-anuncios');

	}
		
}



//PUBLICAR ANUNCIO

function publicar($id_cliente,$titulo,$descripcion,$precio,$imagen,$categoria){
	$mysqli = connect();	
	$titulo = clear($titulo);
	$descripcion = clear($descripcion);
	$precio = clear($precio);
	$r['id']=$categoria;
	$imagen=$_FILES["imagen"];
	

		
			//condicional si el fichero existe
			if(is_uploaded_file($_FILES["imagen"]["tmp_name"])) {

				// titulos de archivos de temporales
				$archivotitulo = $_FILES["imagen"]["name"]; 
				$archivotituloimg = $titulo.rand(0,1000).".png";
				$fuente = $_FILES["imagen"]["tmp_name"]; 
				
				$carpeta = 'anuncios/'; //Declaramos el titulo de la carpeta que guardara los archivos
				
				$dir=opendir($carpeta);
				$target_path = $carpeta.'/'.$archivotituloimg; //indicamos la ruta de destino de los archivos
				
		
				if(move_uploaded_file($fuente, $target_path)) {	
					$mysqli-> query("INSERT INTO anuncios (id_cliente,titulo,imagen,id_categoria,descripcion,precio) VALUES ('$id_cliente','$titulo','$archivotituloimg','$categoria','$descripcion','$precio')");
					echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-success alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a> Anuncio publicado correctamente.';
					echo '</div>';
				} else {	
					echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-danger alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a> Se a producido un error, intentelo más tarde.';
					echo '</div>';
				}
				closedir($dir); //Cerramos la conexion con la carpeta destino
			}else{
				
					$archivotituloimg = "no_img.PNG";
					
					$mysqli-> query("INSERT INTO anuncios (id_cliente,titulo,imagen,id_categoria,descripcion,precio) VALUES ('$id_cliente','$titulo','$archivotituloimg','$categoria','$descripcion','$precio')");
					echo '<div class="alert-dismissible"></div>';
					echo '<div class="alert alert-success alert-dismissible">';
					echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
					</a> Anuncio publicado correctamente.';
					echo '</div>';
				

			}

		
}

//ENVIAR INCIDENCIA

function enviar_incidencia($nombre,$incidencia,$email,$descripcion,$telefono){

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
	$acep = 'Mensaje enviado';
    $erroremail = 'Mensaje no enviado';
    $nombre = $_POST["nombre"]; 
    $incidencia = $_POST["incidencia"]; 
    $email = $_POST["email"]; 
    $descripcion = $_POST["descripcion"]; 
    $telefono = $_POST["telefono"];

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();// Set mailer to use SMTP
        $mail->CharSet = "utf-8";// set charset to utf8
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

        $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
        $mail->Port = 587;// TCP port to connect to
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isHTML(true);// Set email format to HTML

        $mail->Username = 'edwindaw1dam@gmail.com';// SMTP username
        $mail->Password = 'password';// SMTP password                           // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('edwindaw1dam@gmail.com', $nombre);
        $mail->addAddress('edwinorlando21@gmail.com');     // Add a recipient
                                  // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->AddAttachment($_FILES['datos']['tmp_name'],
                             $_FILES['datos']['name']);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $incidencia;
        $mail->Body    = '<b>Nombre:</b> '.$nombre.'<br> <b>Email:</b> '.$email.'<br> <b>Teléfono:</b> '.$telefono.'<br> <b>Descripcion de la incidencia:</b> '.$descripcion;
        $mail->send();
        echo '<div class="alert-dismissible"></div>';
        echo '<div class="alert alert-success alert-dismissible">';
        echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
        </a>'. $acep;
        echo '</div>';
    } catch (Exception $e) {
        echo '<div class="alert-dismissible"></div>';
        echo '<div class="alert alert-danger alert-dismissible">';
        echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
        </a>'. $erroremail;
        echo '</div>';
    }
}


//Añadir al carro

function insertar_carro_log($id_cliente,$id_anuncio){
	$mysqli = connect();
	$q = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_anuncio = '$id_anuncio'");

  	if(mysqli_num_rows($q)>0){
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-danger alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> Ya tiene el anuncio en la lista de deseo.';
		echo '</div>';
		
	}else{
		$mysqli->query("INSERT INTO carro (id_cliente,id_anuncio) VALUES ($id_cliente,$id_anuncio)");
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-success alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> Lista de deseo actualizada';
		echo '</div>';
	}
}

function borrar_carro($id_cliente,$borrar_anuncio){
	$mysqli = connect();
	$borrar_anuncio = $_POST['btnBorrar'];

    $q = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_anuncio = '$borrar_anuncio'");

  	if(mysqli_num_rows($q)<0){
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-danger alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> Se ha producido un error.';
		echo '</div>';
		
	}else{
		$mysqli->query("DELETE FROM carro WHERE id_cliente = '$id_cliente' AND id_anuncio = '$borrar_anuncio'");
		echo $borrar_anuncio;
		echo '<div class="alert-dismissible"></div>';
		echo '<div class="alert alert-success alert-dismissible">';
		echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
		</a> Anuncio eliminado.';
		echo '</div>';
		redir('lista-deseos');
		
	}
}

function insertar_carro_nolog(){
	$mysqli = connect();
	echo '<div class="alert-dismissible"></div>';
	echo '<div class="alert alert-danger alert-dismissible">';
	echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
	</a> Debe iniciar sesión o registrarse para guardar el anuncio.';
	echo '</div>';
			
}


?>