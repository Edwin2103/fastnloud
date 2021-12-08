<?php

		$id_cliente=$_SESSION['id_cliente'];

	    if(isset($_POST['btnBorrar'])) {

	    	mis_anuncios($id_cliente);
		}
		
		

$id_cliente = clear($_SESSION['id_cliente']);
$q = $mysqli->query("SELECT * FROM anuncios WHERE id_cliente = '$id_cliente' ORDER BY id DESC");
		

    
?>

 
<ul class="nav nav-pills nav-fill"style="background-color: black;">
  <li class="nav-item">
    <a class="nav-link" href="mis-anuncios">Mis anuncios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="mi-cuenta">Mi cuenta</a>
  </li>
</ul>
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
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>

<?php

	while($row = mysqli_fetch_array($q)){
		?>
			<tr>
	      <td><img class="myImg m-2 " id="'.$row['id_cliente'].'" src="anuncios/<?=$row['imagen']?>"style="width:100%;max-width:450px;height:100%;max-height:300px"></td>
	      <td><?=$row['titulo']?></td>
	      <td><?=$row['descripcion']?></td>
	      <td><?=$row['provincia']?></td>
	      <td><?=$row['localidad']?></td>
	      <td><?=$row['precio']?></td>
	      <td><?=$row['km']?></td>
	      <td><?=$row['color']?></td>
	      <td><?=$row['part_profe']?></td>		
				<td><button class="btn btn-primary " type="button" ><i class="fa fa-edit"></i><a href="modificar-anuncio&<?=$row['id']?>">Actualizar</a> </button>    

	        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?=str_replace(' ','',$row['titulo']),$row['id']?>"><i class="fa fa-times"></i> Eliminar</button></td>
					
					<!-- Modal -->
					<div class="modal fade" id="<?=str_replace(' ','',$row['titulo']),$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        ¿Desea eliminar el anuncio?
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
					        <button class="btn btn-danger " type="submit" id="btnBorrar" name="btnBorrar" value="<?=$row['id']?>"><i class="fa fa-times"></i> Eliminar</button>
					      </div>
					    </div>
					  </div>
					</div>

				</td>
		
			</tr>
<?php


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
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>



</form>


<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
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