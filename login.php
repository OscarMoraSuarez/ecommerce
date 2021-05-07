<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
<?php require_once("admin/Modelos/Usuarios.php");?>
  
  <?php

       $usuarios= new Usuarios();

       if(isset($_POST["login"])){
           
            $correo=$_POST["correo"];
            $password=$_POST["password"];
           
            $usuarios->login($correo,$password);
       }


   ?>
   
   <?php
 
   if(isset($_GET["m"])){

       switch($_GET["m"]){
               
           case "1":
               
               ?>
                 <h2 class='text-center' style='color:green'>Se ha reseteado el password satisfactoriamente, ahora puede loguearse con el nuevo password</h2>
               <?php
               
           break;
       }
       
   }

?>
   
    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
        <div class="col-sm-4 col-sm-offset-5">  
                  
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">
                    Correo<input type="text" name="correo" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="login" class="btn btn-primary" >
                </div>
                
                <div class="form-group">

                  <a href="recuperar_password.php">¿Olvidó su Password ?</a>

                </div>
                
            </form>
            
        </div>  


    </header>


        </div>

    <?php require_once("includes/footer.php");?>