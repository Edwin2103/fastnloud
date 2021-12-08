<?php 
  $id_cliente =  $_SESSION['id_cliente'];
  $id_anuncio = $_GET['id_anuncio'];
  
  
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $imagen=$_FILES["imagen"];
    modificar_anuncio($id_cliente,$imagen,$titulo,$descripcion,$categoria,$precio,$id_anuncio);      
  }

  $q = $mysqli->query("SELECT * FROM anuncios WHERE id_cliente = '$id_cliente' AND id = '$id_anuncio'");
  while($r = mysqli_fetch_array($q)){
 ?> 
 <div class="container"style="padding: 1%;background-color: white;border-radius: 5px"  >
        <div class="form-group">
            <h1 >Todos los datos son obligatorios</h1>
        </div>
    <form  action="" method="post"  enctype="multipart/form-data" style="padding: 1%;background-color: white" >  
        <div class="form-group">
            <input type="text" class="form-control" name="titulo" placeholder="Título del anuncio" value="<?=$r['titulo']?>" />
        </div>
        <div class="form-group">
            <textarea class="form-control" name="descripcion" rows="4" cols="136" ><?=$r['descripcion']?></textarea>
        </div>
        
        <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <input type="text" class="form-control" name="provincia" value ="<?=$r['provincia']?>"  />
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" name="localidad" value ="<?=$r['localidad']?>"  />
                </div>
              </div>
        </div>

        <div class="form-group">

            <select name="categoria" class="form-control" required >
                <option value="">Seleccione una categoria</option>
                <?php
                    $q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");

                    while($r=mysqli_fetch_array($q)){
                        ?>
                            <option value="<?=$r['id']?>"><?=$r['categoria']?></option>
                        <?php
                    }
                ?>
            </select>

        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-6">
                  <?php 
                	if(isset($r['color'])){?>
			    <input type="text" class="form-control" name="precio"  value="<?=$r['precio']?>" placeholder="<?=$r['precio']?>" />
			<?php
			}else{?>
				<input type="text" class="form-control" name="precio" placeholder="Precio"  placeholder="<?=$r['precio']?>" />
			<?php
			}?>
                </div>
                <div class="col-6">
                  <?php 
                	if(isset($r['color'])){?>
			    <input type="text" class="form-control" name="km" value="<?=$r['km']?>" placeholder="<?=$r['km']?>" />
			<?php
			}else{?>
				<input type="text" class="form-control" name="km" placeholder="Kilometros"  placeholder="<?=$r['km']?>" />
			<?php
			}?>
                </div>
        </div>

        <div class="form-group">
              <div class="row">
                <div class="col-6">
                	<?php 
                	if(isset($r['color'])){?>
			    <input type="text" class="form-control" name="color" placeholder="Color" value="<?=$r['color']?>" placeholder="<?=$r['color']?>" />
			<?php
			}else{?>
				<input type="text" class="form-control" name="color" placeholder="Color"  placeholder="<?=$r['color']?>" />
			<?php
			}?>
                  
                </div>
                <div class="col-6">
                  <select name="part_prof" class="form-control" >
                    <option value="" >    Particular y profesional</option>
                    <option value="particular" >    Particular</option>
                    <option value="profesional" >    Profesional</option>
                  </select>
                </div>
              </div>
            </div>

        <label>Imagen del producto</label>

        <div class="form-group">
            <input type="file" class="form-control" id="imagen" name="imagen" multiple title="Imagen del producto" placeholder="Imagen" value="<?=$r['imagen']?>" />
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
                    ¿Desea guardar los datos?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" name="guardar_anuncio"><i class="fa fa-check"></i>Guardar</button>
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
                    <button type="submit" class="btn btn-danger" name="cancelar"><i class="fa fa-times"></i> <a href="mis-anuncios">Salir</a></button>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>

    </form><br>
<?php
  }  
?>
</div>     