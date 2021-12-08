
	<?php
	
		check_user('lista-deseos');
		$id_cliente = $_SESSION['id_cliente'];
	    
		$qcarro = $mysqli->query("SELECT * FROM carro WHERE id_cliente='$id_cliente'");
        
        $query=$mysqli->query("SELECT * FROM anuncios where id in (SELECT id_anuncio FROM carro WHERE id_cliente='$id_cliente')");
       		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
            borrar_carro($id_cliente,$btnBorrar);
		}
		if (mysqli_num_rows($qcarro)==0) {
        		echo '<div class="alert-dismissible"></div>';
				echo '<div class="alert alert-danger alert-dismissible">';
				echo'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
				</a> Lista vacia.';
				echo '</div>';
		}
?>


<form name="input" action="" method="POST" class="form-horizontal" enctype="multipart/form-data" style="padding:2px;background-color: white;">
    <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Provincia</th>
                    <th>Localidad</th>
                    <th>Precio</th>
                    <th>Kilometros</th>
                    <th>Color</th>
                    <th>Particular o Profesional</th>
                    <th>Datos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            	<?php
       	while($r = mysqli_fetch_array($query)){
       		$id_anuncio= $r['id'];
        	
        		
        	$q2 = $mysqli->query("SELECT * FROM anuncios WHERE id='$id_anuncio'");
			
	            while($r1 = mysqli_fetch_array($q2)){
	            	$id_cliente =$r1['id_cliente'];
					$qcliente = $mysqli->query("SELECT * FROM clientes WHERE id=$id_cliente");
					
					while($r2 = mysqli_fetch_array($qcliente)){
	            	?>
	            	 <tr>

                    <td><img class="myImg m-2 " id="'.$r['id_cliente'].'" src="anuncios/<?=$r['imagen']?>"style="width:100%;max-width:450px;height:100%;max-height:300px"></td>
                    <td><?=$r['titulo']?></td>
                    <td><?=$r['descripcion']?></td>
                    <td><?=$r['provincia']?></td>
                    <td><?=$r['localidad']?></td>
                    <td><?=$r['precio']?></td>
                    <td><?=$r['km']?></td>
                    <td><?=$r['color']?></td>
                    <td><?=$r['part_profe']?></td>
                    <td><h6 >Nombre y apellidos: <?=$r2['nombre']?>  <?=$r2['apellidos']?>
                		<h6 >Email: <?=$r2['email']?>
            			<h6 >Teléfono: <?=$r2['telefono']?></td>
                    <td><button class="btn btn-info" type="submit" id="chatear" name="chatear"><a href="muro">Chatear</a> </button>
                    	
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?=str_replace(' ','',$r2['nombre']),$r['id_cliente']?>"><i class="fa fa-times"></i> Eliminar</button>   </td>  
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
                </tr>



				<?php
	    	}
	    }
	}




    ?>  
         </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Provincia</th>
                    <th>Localidad</th>
                    <th>Precio</th>
                    <th>Kilometros</th>
                    <th>Color</th>
                    <th>Particular o Profesional</th>
                    <th>Datos</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </form>



    <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
    	responsive: true,
        language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
        "lengthMenu": [[4, 10,25, 50, -1], [4, 10,25,50, "Todo"]]
    } );
} );

</script>