<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="home">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="categoria">Agregar categoria</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="ver-clientes">Ver Clientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="ver-anuncios">Ver Anuncios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="foro">Foro</a>
  </li>
   <li class="nav-item">
    <a class="nav-link " href="calendario">Calendario</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="../">Salir</a>
  </li>
</ul>
  	

<div>
	<?php
	if(!isset($a)){
		$a = "home";
	}else{
		$a = $a;
	}

	if(file_exists("models/".$a.".php")){
		include "models/".$a.".php";
	}else{
		echo "<i>No se ha encontrado el modulo <b>".$a."</b> <a href='./'>Regresar</a></i>";
	}

	?>
</div>