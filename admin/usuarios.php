<?php

    $usuarios = new Usuarios();

    $datos = $usuarios->get_usuarios();

     /*validando la eliminacion del registro de usuario*/

     if(isset($_GET["eliminar"])){
         
          $id_usuario=$_GET["eliminar"];
         
          $usuarios->eliminar_usuario($id_usuario);
     }

?>


                    <div class="col-lg-12">
                      

                        <h1 class="page-header">
                            Usuarios
                         
                        </h1>
                         
                                                         
<?php
            
     if(isset($_GET["m"])){
         
         switch($_GET["m"]){
             

             case "1":
             ?>
               <h2 class="text-danger bg-danger">Fallo en la consulta</h2>
             <?php
             break;
                 
             case "2":
             ?>
               <h2 class="text-danger bg-danger">No existe el id y/o el usuario que quiere editar</h2>
             <?php
             break;
                 
                 
             case "3":
             ?>
               <h2 class="text-success bg-success">Se ha eliminado el registro del usuario</h2>
             <?php
             break;
                 
                 
            case "4":
             ?>
               <h2 class="text-danger bg-danger">No se ha eliminado el registro del usuario</h2>
             <?php
             break;
                 
                 
            case "5":
             ?>
               <h2 class="text-danger bg-danger">No existe el id y/o usuario en la base de datos</h2>
             <?php
             break; 
                 
         }
     }            
?>           
       
                                                  

                        <a href="index.php?add_usuario" class="btn btn-primary">Añadir usuario</a>

                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Usuario </th>
                                        <th>Correo</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php
                                       
                                       for($i=0;$i<count($datos);$i++){
                                   ?>
                              
                                    <tr>

                                        <td><?php echo $datos[$i]["id_usuario"]?></td>
                                        <td><?php echo $datos[$i]["nombre"]?></td>
                                       <td><?php echo $datos[$i]["apellido"]?></td>
                                       <td><?php echo $datos[$i]["usuario"]?></td>
                                       <td><?php echo $datos[$i]["correo"]?></td>
                                       
                                       <td> <a class='btn btn-success' href='index.php?edit_usuario&id_usuario=<?php echo $datos[$i]["id_usuario"];?>'><i class="fa fa-pencil"></i>  Editar</a>  </td>
                      
                      
                                         <td> <a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" class='btn btn-danger' href='index.php?usuarios&eliminar=<?php echo $datos[$i]["id_usuario"];?>'><i class="fa fa-trash"></i>  Eliminar</a>  </td>

                                    </tr>

                                    <?php
                                       
                                       }
                                    ?>
                                    
                                </tbody>
                            </table> <!--End of Table-->
                        

                        </div>










                        
                    </div>
    











