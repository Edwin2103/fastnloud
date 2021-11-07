<?php 
  		if (isset($agegar_cat)) {
			$nueva_categoria = clear($nueva_categoria);
			

			$q = $mysqli->query("SELECT * FROM categorias WHERE categoria = '$nueva_categoria'");

			if(mysqli_num_rows($q)>0){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> La categoría ya existe.';
				echo '</div>';
				
			}else{
				$mysqli->query("INSERT INTO categorias (categoria) VALUES ('$nueva_categoria')");
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-success alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Categoría: '.$nueva_categoria.' agregada correctamente';
				echo '</div>';
			}

		}
		if(isset($mod_categoria1)) {
			$nuevo_nombre = $_POST['mod_categoria'];
            $mod_nombre = $_POST['mod_categoria1'];
           $q = $mysqli->query("SELECT * FROM categorias WHERE categoria = '$nuevo_nombre'");

			if(mysqli_num_rows($q)>0){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> La categoría ya existe.';
				echo '</div>';
				
			}else{
				$mysqli->query("UPDATE categorias SET categoria='$nuevo_nombre' WHERE categoria='$mod_nombre'");
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-success alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Categoría: '.$mod_nombre.' modificada correctamente';
				echo '</div>';
				}

	    }
		
		if(isset($_POST['btnBorrar'])) {
            $borrar_categoria = $_POST['btnBorrar'];
            $q = $mysqli->query("SELECT * FROM categorias WHERE categoria = '$borrar_categoria'");

          	if(mysqli_num_rows($q)<0){
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> La categoría ya existe.';
				echo '</div>';
				
			}else{
				$mysqli->query("DELETE FROM categorias WHERE categoria = '$borrar_categoria'");
				echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-success alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Categoría: '.$borrar_categoria.' eliminada correctamente';
				echo '</div>';
				
			}
        }



?>




 <form id="mismensajes-form" name="input" action="" method="post" class="form-horizontal" style="padding: 2%">
   <div class="container"style="background-color: white;border-radius: 5px;padding: 2%" id="conta" >
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    	<h4> Categorías ya agregadas</h4>
                    	<table class="table table-striped" width="70">
						<tr>
							<th>Nombre de la categoría</th>
							<th>Acción</th>
						</tr>
							<?php

								$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");

								while($r=mysqli_fetch_array($q)){
								
									?>
									<tr>
										<td><?=$r['categoria']?></td>
										<td><button class="btn btn-info" id="btnMod"  type="button" data-toggle="collapse" data-target="#<?=$r['categoria']?>"
							                    aria-expanded="false" aria-controls="<?=$r['categoria']?>"  ></i> Modificar</button>
										<div class="collapse" id="<?=$r['categoria']?>" style="width:100%" >
					                 	 	<div class="card card-body" style="width: 100%">
					                 	 		<form name="input" action="" method="POST" class="form-horizontal">
					                 	 			
						                  			<div class="form-group">					                  				
														<div class="row">
															<div class="col-6">
																<label class="label-control" for="nombre"> Renombre la categoria</label>
																<input class="form-control" type="text" name="mod_categoria"/>	
																<button class="btn btn-success" type="submit" id="mod_categoria1" name="mod_categoria1" value="<?=$r['categoria']?>"><i class="fa fa-success"></i> Guardar</button>
															</div> 
														</div>
													</div>
												</form>
											</div>
										</div>
										

										<button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?=$r['categoria'],$r['id']?>"><i class="fa fa-success"></i> Eliminar</button>	

						                <div class="modal fade" id="<?=$r['categoria'],$r['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
									        ¿Desea eliminar la categoria?
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									        <button class="btn btn-info" type="submit" id="btnBorrar" name="btnBorrar" value="<?=$r['categoria']?>"> Eliminar</button>
									      </div>
									    </div>
									  </div>
									</div>
									</tr>
									<?php
								}
							?>

					</table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <h4> Nueva categoría:</h4>
                    <input class="form-control" type="text" name="nueva_categoria" placeholder="Introduzca la nueva categoría"/>
                </div>
            </div>
            
            
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar"><i class="fa fa-success"></i> Enviar</button>	

                <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        ¿Desea agregar la categoria?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button class="btn btn-info" name="agegar_cat" type="submit"><i class="fa fa-sign-in"></i> Agregar</button>
			      </div>
			    </div>
			  </div>
			</div>

        </form>
        

    </div>
    <br>
