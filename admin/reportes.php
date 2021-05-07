<?php

   $reporte= new Reportes();

   $datos= $reporte->get_reportes();

      /*validando la eliminacion de los reportes*/

      if(isset($_GET["eliminar"])){
          
          $id_reporte= $_GET["eliminar"];
          
          $reporte->eliminar_reporte($id_reporte);
      }

?>

<div class="row">

<h1 class="page-header">
   Reportes

</h1>

<?php
    
      if(isset($_GET["m"])){
          
        switch($_GET["m"]){
                
            case "1":
            ?>
             <h1 class="text-danger bg-danger">Fallo en la consulta</h1>  
            <?php
            break;
                
             case "2":
            ?>
             <h1 class="text-success bg-success">Se eliminó el reporte</h1>  
            <?php
            break;
                
            case "3":
            ?>
             <h1 class="text-danger bg-danger">No existe el id del reporte seleccionado</h1>  
            <?php
            break;
                
                
                
        }  
                    
      }

    
    ?>




<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Id Producto</th>
           <th>Id Pedido</th>
           <th>Producto Precio</th>
           <th>Producto Titulo</th>
           <th>Producto Cantidad</th>
           <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
      
      <?php
            
           for($i=0;$i<count($datos);$i++){
       ?>

      <tr>
            <td><?php echo $datos[$i]["id_reporte"]?></td>
            <td><?php echo $datos[$i]["id_producto"]?></td>
            <td><?php echo $datos[$i]["id_pedido"]?></td>
            <td>&#36;<?php echo $datos[$i]["producto_precio"]?></td>
            <td><?php echo $datos[$i]["producto_titulo"]?></td>
            <td><?php echo $datos[$i]["producto_cantidad"]?></td>
            
         
            <td><a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" class="btn btn-danger" href="index.php?reportes&eliminar=<?php echo $datos[$i]["id_reporte"]?>"><i class="fa fa-trash"></i> Eliminar</a></td>
            
        </tr>
      
      <?php
        
           }
      ?>

  </tbody>
</table>


 </div>

           