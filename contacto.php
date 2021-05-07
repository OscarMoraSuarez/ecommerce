<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
        
        <?php

           
if(isset($_POST["submit"])) {
   
    
    if(empty($_POST["nombre"]) and empty($_POST["titulo"]) and empty($_POST["email"]) and empty($_POST["mensaje"])){
        
        echo "<h2 class='text-center' style='color:red'>Los campos estan vacios</h2>";  
   
    } else if(empty($_POST["nombre"]) or empty($_POST["titulo"]) or empty($_POST["email"]) or empty($_POST["mensaje"])){
        
       echo "<h2 class='text-center' style='color:red'>Los campos estan vacios</h2>";  
    }
    
    else {

        $to         = "tucorreo@gmail.com";
        $asunto    = wordwrap($_POST['titulo'],70);
        $cuerpo       = $_POST['mensaje'];
        //para el envío en formato HTML 
        $cabecera = "MIME-Version: 1.0\r\n"; 
        $cabecera .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $cabecera     .= " From: ".$_POST["email"];

        // send email

            /*validando el envio del correo*/
             if(mail($to,$asunto,$cuerpo,$cabecera)){
                 
                  echo "<h2 class='text-center' style='color:green'>Se ha enviado el comentario satisfactoriamente</h2>"; 
               
                
             }else {

                  echo "<h2 class='text-center' style='color:red'>No se envió el correo</h2>";  
             }  


       }
    
  }


       ?>
         <!-- Contact Section -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contacto</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" name="sentMessage" id="contactForm" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre *" id="nombre" required data-validation-required-message="Escriba su nombre.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email *" id="email" required data-validation-required-message="Escriba su correo.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="titulo" class="form-control" placeholder="Titulo *" id="titulo" required data-validation-required-message="Escriba su titulo.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="mensaje" class="form-control" placeholder="Mensaje *" id="mensaje" required data-validation-required-message="Escriba su mensaje."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" name="submit" class="btn btn-primary btn-xl">Enviar mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
<?php require_once("includes/footer.php");?>