	<style type="text/css">
		.bd-navbar {
		    min-height: 4rem;
		    background-color: #6351ce;
		    color: black;
		}
	</style>

		<nav class="navbar navbar-expand-lg navbar-dark  flex-md-row bd-navbar">
		  <a class="navbar-brand" href="?p=home">FAST'N LOUD</a>	  
		  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="true" aria-controls="navbarToggleExternalContent" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div id="navbarToggleExternalContent" class="navbar-collapse collapse hide">
		  	<?php
				if(!isset($_SESSION['id_cliente'])){
			?>
			<ul class="navbar-nav">
		      <li class="nav-item active">
		        <a class="nav-link" href="?p=home"></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?p=home">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?p=vehiculos">Coches</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?p=motos">Motos</a>
		      </li>
		     </ul>
		  	<ul class="nav navbar-nav ml-auto">
				  <li class="nav-item">
			        <a class="nav-link" href="?p=login"><span class="fas fa-user"></span> Login</a>
			      </li>

			      <li class="nav-item">
			        <a class="nav-link" href="?p=registro"><span class="fas fa-user"></span> Registrate</a>
			      </li>
			    </ul>
		  	<?php
		  	}
				if(isset($_SESSION['id_cliente'])){
			?>
		    <ul class="navbar-nav">
		      <li class="nav-item active">
		        <a class="nav-link" href="?p=home"></a>
		      </li>
		      <li class="nav-item ">
		        <a class="nav-link" href="?p=home">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?p=vehiculos">Coches</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?p=motos">Motos</a>
		      </li>





				</ul>

				<ul class="nav navbar-nav ml-auto">
				  <li class="nav-item">
		            <a class="nav-link" href="?p=lista-deseos">Lista deseos</a>
		          </li>
				  <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			         <?=nombre_cliente($_SESSION['id_cliente'])?>
			        </a>
			        </button>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="?p=gestionar"><span class="fa fa-briefcase" aria-hidden="true">    </span>  Gestionar</a>
			          <a class="dropdown-item" href="?p=publicar"><span class="fa fa-upload" aria-hidden="true">   </span>  Publicar</a>
			          <a class="dropdown-item" href="?p=lista-deseos"><span class="fa fa-shopping-cart" aria-hidden="true">   </span>  Lista deseos</a>
			          <a class="dropdown-item" href="?p=foro"><span class="fa fa-envelope" aria-hidden="true">  </span>  Foro</a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="?p=calendario"><span class="fa fa-calendar" aria-hidden="true">   </span>  Calendario</a>	          
			        </div>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="?p=salir"><span class="fas fa-sign-in-alt"></span> Salir</a>
			      </li>
			    </ul>

			<?php
				}
			?>
		  </div>
		</nav>

		<div>
			<?php
			if(!isset($p)){
				$p = "home";
			}else{
				$p = $p;
			}

				if(!isset($_SESSION['id_cliente'])){
					if(file_exists("models/".$p.".php")){
						if ($p!="publicar" && $p!="gestionar" && $p!="carro" && $p!="foro" && $p!="calendario"&& $p!="lista-deseos") {
							include "models/".$p.".php";
						}else{
							echo '<div class="alert-dismissible"></div>';
							echo '<div class="alert alert-success alert-dismissible">';
							echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
							</a> Debe iniciar sesión o registrarse para ver <b>"'.$p.'"</b> <a href="./">Regresar</a>';
							echo '</div>';
						}
					}
				}else{
					if(file_exists("models/".$p.".php")){
						include "models/".$p.".php";
					}else{
						echo '<div class="alert-dismissible"></div>';
						echo '<div class="alert alert-success alert-dismissible">';
						echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
						</a> Debe iniciar sesión o registrarse para ver <b>"'.$p.'"</b> <a href="./">Regresar</a>';
						echo '</div>';
					}
				}
			?>
		</div>

