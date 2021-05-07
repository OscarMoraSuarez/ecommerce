<?php
   
      $usuarios = new Usuarios();
    
       /*validamos si se envia el formulario para insertar el nuevo usuario*/
       if(isset($_POST["crear_usuario"])){
           
           $usuarios->insertar_usuario();             
           
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
                <h2 class="text-danger bg-danger">El formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres y maximo 15 caracteres </h2>
               <?php
               break;
                   
                case "3":
               ?>
                <h2 class="text-danger bg-danger">Fallo en la consulta</h2>
               <?php
               break;
                   
               case "4":
               ?>
                <h2 class="text-danger bg-danger">El usuario ya existe en la base de datos </h2>
               <?php
               break;
                   
               case "5":
               ?>
                <h2 class="text-danger bg-danger">El correo ya existe en la base de datos</h2>
               <?php
               break;
                   
               case "6":
               ?>
                <h2 class="text-success bg-success">Se insertó el registro</h2>
               <?php
               break;
                   
               case "7":
               ?>
                <h2 class="text-danger bg-danger">No se insertó el registro</h2>
               <?php
               break;
                   
           }   
       }

   ?>
   
   
    
    <h1 class="text-primary">Agregar usuario</h1>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="title">Nombre</label>
          <input type="text" class="form-control" name="nombre">
      </div>
      
      
      

       <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text" class="form-control" name="apellido">
      </div>
     
     
      
<!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="post_tags">Usuario</label>
          <input type="text" class="form-control" name="usuario">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" class="form-control" name="correo">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" class="form-control" name="password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="crear_usuario" value="Añadir usuario">
      </div>


</form>
    