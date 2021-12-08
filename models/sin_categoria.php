<?php

 

        $sql = "SELECT * FROM anuncios ORDER BY id DESC";// LIMIT $offset, $no_of_records_per_page";
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
        while($row = mysqli_fetch_array($res_data)){  
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
                                        <?php
                    if(!isset($_SESSION['id_cliente'])){
                    ?>
                    
                     <td><button class="btn btn-primary btn-sm" type="submit"onclick="myFunction()" name="no_log">Lista de deseos</button></td>
                        

                    <?php   
                    }else{
                    ?>  
                    
                    <td><button type="submit" class="btn btn-primary btn-sm" id="insert_carro" name="insert_carro" value="<?=$row['id']?>">Añadir a la lista de deseos</button></td>
                    <?php   
                    }
                    ?> 
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