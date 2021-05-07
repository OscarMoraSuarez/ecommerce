
 <?php
   
     $categoria = new Categorias();

     $datos= $categoria->get_categorias();

       /*validando la edicion de la categoria*/

       if(isset($_POST["editar_categoria"])){
            
            $categoria->editar_categoria();
       }

      
      /*validando el envio del formulario*/

      if(isset($_POST["submit"])){
          
           $categoria->insertar_categoria();
      }

      /*validando la eliminacion de la categoria*/

      if(isset($_GET["eliminar"])){
          
          $id_categoria=$_GET["eliminar"];
          
          $categoria->eliminar_categoria($id_categoria);
          
      }

 ?>           

<h1 class="page-header">
  Producto Categorias

</h1>

 <?php
    
      if(isset($_GET["m"])){
          
        switch($_GET["m"]){
                
            case "1":
            ?>
             <h1 class="text-danger bg-danger">El campo esta vacio</h1>  
            <?php
            break;
                
             case "2":
            ?>
             <h1 class="text-danger bg-danger">Falla en la consulta</h1>  
            <?php
            break;
                
            case "3":
            ?>
             <h1 class="text-danger bg-danger">Ya existe la categoria</h1>  
            <?php
            break;
                
                
            case "4":
            ?>
             <h1 class="text-success bg-success">Se ha insertado la categoria</h1>  
            <?php
            break;
                
             case "5":
            ?>
             <h1 class="text-danger bg-danger">No se ha insertado la categoria</h1>  
            <?php
            break; 
                
            case "6":
            ?>
             <h1 class="text-danger bg-danger">No existe el id de la categoria</h1>  
            <?php
            break; 
                
            case "7":
            ?>
             <h1 class="text-success bg-success">Se editó la categoria</h1>  
            <?php
            break; 
                
            case "8":
            ?>
             <h1 class="text-danger bg-danger">No se editó la categoria</h1>  
            <?php
            break;
                
            case "9":
            ?>
             <h1 class="text-success bg-success">Se eliminó la categoria</h1>  
            <?php
            break;
                
        }  
                    
      }

    
    ?>

 


<div class="col-md-4">
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Titulo</label>
            <input type="text" name="cat_titulo" class="form-control">
        </div>

        <div class="form-group">
            
            <input type="submit" name="submit" class="btn btn-primary" value="Añadir Categoria">
        </div>      


    </form>
    
     <?php
       
         if(isset($_GET["editar"])){
             
             require_once("edit_categorias.php");  
         }
    
    
      ?>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Titulo</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
            </thead>


    <tbody>
       <?php
           for($i=0;$i<count($datos);$i++){
        ?>
        <tr>
            <td><?php echo $datos[$i]["id_categoria"];?></td>
            <td><?php echo $datos[$i]["cat_titulo"];?></td>
            
            <td><a class="btn btn-primary " href='index.php?categorias&editar=<?php echo $datos[$i]["id_categoria"]?>'><i class="fa fa-pencil"></i>  Editar</a></td>
                 
            <td><a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" class="btn btn-danger" href='index.php?categorias&eliminar=<?php echo $datos[$i]["id_categoria"]?>'><i class="fa fa-trash"></i>  Eliminar</a></td>
                  
        </tr>
        
       <?php
           }
        ?>
    </tbody>

        </table>

</div>



                



