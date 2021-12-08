<?php 
	$id_cliente = $_SESSION['id_cliente'];
	$query = $mysqli->query("SELECT * FROM mensajes ");

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
	 	foro($id_cliente,$mensaje);
	}
?>



   <div class="container"style="background-color: white;border-radius: 5px" id="conta" >
        <div class="form-group" style="padding: 1%">
            <h2>Bienvenid@ <span style="color:#6351ce;"><?=nombre_cliente($_SESSION['id_cliente'])?> !</span></h2>
        </div>
        <hr>
   <div class="display-chat" id = "display-chat">
   	<meta http-equiv="refresh" content="20">
<?php
	if(mysqli_num_rows($query)>0)
	{
		while($row= mysqli_fetch_assoc($query))	
		{
			$cliente = $row['id_cliente'];
			$query1 = $mysqli->query("SELECT * FROM clientes WHERE id=$cliente");
			while($row1= mysqli_fetch_assoc($query1))	
			{
?>			
		<div class="label-control">
			<p>
				<b><?php echo $row1['nombre']; ?> :</b>
				<?php echo $row['mensaje']; ?>
			</p>
		</div>
<?php
			}
		}
	}
	else
	{
?>
<div class="label-control" id="global">
			<p>
				No hay ninguna conversación previa.
			</p>
</div>
<?php
	} 
?>

  </div>
<hr>
  <form id="mismensajes-form" name="input" action="" method="post" class="form-horizontal" style="padding: 1%">
    <div class="form-group">
      <div class="row">        
        <textarea name="mensaje" class="form-control" placeholder="Ingresa tu mensaje aqui..."></textarea>
      </div>
    </div>
    <div class="form-group">
	  <div class="row">
		<div class="col">
			<button class="btn btn-success" type="submit" value="enviar" name="enviar" http-equiv="refresh"  onclick="location.reload()">Enviar</button>				
		</div>
		</div>			
    </div>
  </form>
</div>

<style type="text/css">
#conta {
	height: 500px;
	width: 80%;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
</style>
<script>

      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('.container .display-chat '),
            container = $('#content');
        
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.data('target');       
          
          // Load target page into container
          container.load(target + '.php');
          
          // Stop normal link behavior
          return false;
        });
      });
    </script>