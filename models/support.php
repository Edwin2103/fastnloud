<?php
   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
       enviar_incidencia($nombre,$incidencia,$email,$descripcion,$telefono);


    }
?>

    <div class="container"style="padding: 1%;background-color: white;border-radius: 5px"  >
        <div class="form-group">
           <h1 >POR FAVOR, CUÉNTANOS TU INCIDENCIA.</h1>
            <h6>SE REQUIEREN TODOS LOS CAMPOS</h6>
        </div>
        <form  action="" method="post" enctype="multipart/form-data" style="padding: 1%;background-color: white" >   
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="label-control" for="apellidos"> Tipo de incidencia:</label>
                        <select id="incidencia" name="incidencia"  class="form-control" required="true">
                            <option value="">Seleccione una incidencia</option>
                            <option value="error-registro">Error al registrarme</option>
                            <option value="error-inicio">Error al iniciar sesión</option>
                            <option value="error-password">No puedo cambiar la contraseña</option>
                            <option value="error-anuncio">No puedo publicar mi anuncio</option>
                            <option value="error">Otro tipo de error</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="nombre" class="col-2"> Nombre y apellidos:</label>
                    <input class="form-control" id="textNombre" type="text" name="nombre" placeholder="Introduzca el nombre y los apellidos" required="true"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="email" class="col-2"> Introduzca su email:</label>
                    <input class="form-control" id="textEmail" type="email" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="ejemplo@ejemplo.com" required="true"/>
                </div>
            </div>

            <div class="form-group">
                <label class="label-control" for="descripcion" class="col-2"> Describa el tipo de incidencia:</label>
                <textarea class="form-control" id="textDescr" name="descripcion" rows="4" cols="136" placeholder="Introduzca la de la incidencia" required="true"></textarea>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <label class="label-control" for="telefono" class="col-2"> Teléfono:</label>
                    <input class="form-control" id="textTelefono" type="tel" name="telefono" placeholder="999-999-999" pattern="[0-9]{9}" required="true" />
                </div>
            </div>
            <div class="form-group">
                <label class="label-control" for="datos" class="col-2"> Captura o fichero de error:</label>
                <input type="file" class="form-control" name="datos" title="Adjunte una captura o fichero de error" required="true" />
            </div>
            
            <button class="btn btn-info" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Enviar</button>
            <button class="btn btn-info" id="desInc" ><i class="fa fa-sign-in"></i> Descargar incidencia</button>
        </form>
        

    </div>