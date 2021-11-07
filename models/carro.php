
	<?php
		check_user('lista-deseos');
		$id_cliente = $_SESSION['id_cliente'];
	    if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }
        $no_of_records_per_page = 2;
        $offset = ($pag-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM carro WHERE id_cliente='$id_cliente'";
        $result = $mysqli->query($total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

		$qcarro = $mysqli->query("SELECT * FROM carro WHERE id_cliente='$id_cliente'");
        
        $query=$mysqli->query("SELECT * FROM anuncios where id in (SELECT id_anuncio FROM carro WHERE id_cliente='$id_cliente') LIMIT $offset, $no_of_records_per_page");
       		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
            borrar_carro($id_cliente,$borrar_anuncio);
		}

       	while($r = mysqli_fetch_array($query)){
       		$id_anuncio= $r['id'];
        	
        		
        	$q2 = $mysqli->query("SELECT * FROM anuncios WHERE id='$id_anuncio'");

            while($r1 = mysqli_fetch_array($q2)){
            	$id_cliente =$r1['id_cliente'];
				$qcliente = $mysqli->query("SELECT * FROM clientes WHERE id=$id_cliente");
				
				while($r2 = mysqli_fetch_array($qcliente)){
            	?>
            	<hr>
            	<div class="container">
            	<form name="input" action="" method="POST" class="form-horizontal" enctype="">
					<div class="card" style="padding:20px;">
							  <h5 class="card-header"> </h5>
							  <div class="card-title-body">
							    <h5 class="card-title"><b><?=$r['titulo']?></b></h5>
								<div class="form-group">
									<div class="row">
										<div class="col-6">
											<p class="card-text"> <img class="myImg m-2 " id="'.$r['id_cliente'].'" src="anuncios/<?=$r['imagen']?>"style="width:100%;max-width:450px;height:100%;max-height:300px"></p>
										</div>
										<div class="col-6">
											<p><h6  id="contaanuncios"><?=$r['descripcion']?></h6></p>
											<p><h6 >Precio: <?=$r['precio']?></h6></p>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<h5 class="card-title"><b>Datos</b></h5>
											<p><h6 >Nombre y apellidos: <?=$r2['nombre']?>  <?=$r2['apellidos']?></h6></p>
											<p><h6 >Email: <?=$r2['email']?></h6></p>
											<p><h6 >Teléfono: <?=$r2['telefono']?></h6></p>
										</div>
									</div>
								</div>
									<button class="btn btn-info" type="submit" id="chatear" name="chatear"><a href="foro">Chatear</a> </button>

									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?=str_replace(' ','',$r2['nombre']),$r['id_cliente']?>"><i class="fa fa-times"></i> Eliminar</button>	

						                <div class="modal fade" id="<?=str_replace(' ','',$r2['nombre']),$r['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
								          ¿Desea quitar el anuncio de su lista de deseos ?
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
									        <button type="submit" class="btn btn-success" name="btnBorrar" value="<?=$r['id']?>" ><i class="fa fa-times"></i> Eliminar</a></button>
									      </div>
									    </div>
									  </div>
									</div>
						
								</div>
								</div>
							  </div>
							</form>
							</div>
							<br>



			<?php
    	}
    }}


    ?>  
<nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="lista-deseos&pag=1">Primera</a></li>

        <li class="<?php if($pag <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pag <= 1){ echo '#'; } else { echo "lista-deseos&pag=".($pag - 1); } ?>">Anterior</a></li>

        <li class="<?php if($pag >= $total_pages){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pag >= $total_pages){ echo '#'; } else { echo "lista-deseos&pag=".($pag + 1); } ?>">Siguiente</a></li>

        <li class="page-item"><a class="page-link" href="lista-deseos&pag=<?php echo $total_pages; ?>">Última</a></li>
      </ul>
    </nav>
    	<style type="text/css">
#contaanuncios {
	height: 200px;
	width: 100%;
	border: 1px solid #ddd;
	overflow-y: scroll;
}
</style>