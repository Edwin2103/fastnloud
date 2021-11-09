<?php 

	

		 if (isset($_GET['pag'])) {
            $pag = $_GET['pag'];
        } else {
            $pag = 1;
        }

   

        $no_of_records_per_page = 2;
        $offset = ($pag-1) * $no_of_records_per_page;
        $total_pages_sql = "SELECT COUNT(*) FROM anuncios WHERE id_categoria=2";
        $result = $mysqli->query($total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM anuncios WHERE id_categoria=2 LIMIT $offset, $no_of_records_per_page";
        $res_data = $mysqli->query($sql);

        
	
		
 


	if(isset($_POST['insert_carro'])) {

		$id_cliente = $_SESSION['id_cliente'];
		$id_anuncio = $_POST['insert_carro'];

		insertar_carro_log($id_cliente,$id_anuncio);
        
        
		
    }
    if(isset($_POST['no_log'])) {

    	insertar_carro_nolog();
			
    }


?>
<br>
<form name="input" action="" method="POST" class="form-horizontal" enctype="multipart/form-data" style="padding:2px;">



  <div class="row">
  	<?php
        while($anuncio = mysqli_fetch_array($res_data)){
           
            	
 ?>
    <div class="col-sm-6" style="background-color:lavender;"><br>
    	<div class="card" style="padding:20px;">
			<h5 class="card-header"> </h5>
			<div class="card-title-body">
				<h5 class="card-title"><b><?=$anuncio['titulo']?></b></h5>
				<div class="form-group">
					<div class="row">
						<div class="col-6">
							<p class="card-text"> <img class="myImg m-2 " id="'.$anuncio['id_cliente'].'" src="anuncios/<?=$anuncio['imagen']?>"style="width:100%;max-width:450px;height:100%;max-height:300px"></p>
						</div>
						<div class="col-6">
							<p><h6  id="contaanuncios"><?=$anuncio['descripcion']?></h6></p>
							<p><h6 >Precio: <?=$anuncio['precio']?>€</h6></p>
						</div>
					</div>
				</div>
				<?php
				if(!isset($_SESSION['id_cliente'])){
			    ?>
			    	<button class="btn btn-primary" type="submit"onclick="myFunction()" name="no_log">Añadir a la lista de deseos</button>
					

				<?php	
			    }else{
			    ?>	
			    <button type="submit" class="btn btn-primary" id="insert_carro" name="insert_carro" value="<?=$anuncio['id']?>">Añadir a la lista de deseos</button>
			    <?php	
			    }
			    ?>	    
			</div>
		</div><br>
	</div>

<?php 	
			
    	
    }	

?>  
</div>
</form>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="?p=motos&pag=1">Primera</a></li>

        <li class="<?php if($pag <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pag <= 1){ echo '#'; } else { echo "?p=motos&pag=".($pag - 1); } ?>">Anterior</a></li>

        <li class="<?php if($pag >= $total_pages){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pag >= $total_pages){ echo '#'; } else { echo "?p=motos&pag=".($pag + 1); } ?>">Siguiente</a></li>

        <li class="page-item"><a class="page-link" href="?p=motos&pag=<?php echo $total_pages; ?>">Última</a></li>
      </ul>
    </nav>
