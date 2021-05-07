
  <?php

      $usuarios= new Usuarios();

        /*validamos para traer la informacion del registro*/

         if(isset($_GET["id_usuario"])){
             
              $id_usuario=$_GET["id_usuario"];
             
              $datos=$usuarios->get_usuario_por_id($id_usuario);
         }

         /*validando el envio del formulario*/

         if(isset($_POST["editar_usuario"])){
           
              $usuarios->editar_usuario();
         }

   ?>
   
   <?php
        
       if(isset($_GET["m"])){
           
           switch($_GET["m"]){
                   
               case "1":
               ?>
                <h2 class="text-danger bg-danger">El campo está vacío</h2>
               <?php
               break;
                   
                case "2":
               ?>
                <h2 class="text-danger bg-danger">Fallo en la consulta</h2>
               <?php
               break;
                   
               case "3":
               ?>
                <h2 class="text-success bg-success">Se editó el registro</h2>
               <?php
               break;
                   
                   
               case "4":
               ?>
                <h2 class="text-danger bg-danger">No se editó el registro</h2>
               <?php
               break;
                   
                
           }   
       }

   ?>

  
   <h1 class="text-primary">Editar usuario</h1>
   
   
    <form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="title">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="<?php echo $datos[0]["nombre"];?>">
      </div>
      
      
      

       <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text"  class="form-control" name="apellido" value="<?php echo $datos[0]["apellido"];?>">
      </div>
     
     
        
<!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="post_tags">Usuario</label>
          <input type="text"  class="form-control" name="usuario" value="<?php echo $datos[0]["usuario"];?>" disabled>
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" class="form-control" name="correo" value="<?php echo $datos[0]["correo"];?>" disabled>
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password"  class="form-control" name="password" value="<?php echo $datos[0]["password"];?>" disabled>
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="editar_usuario" value="Editar Usuario">
      </div>


</form>
    