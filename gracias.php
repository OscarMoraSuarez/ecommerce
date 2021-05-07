<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
  
     <?php

         if(isset($_GET["tx"])){
             
             $amount=$_GET["amt"];
             $currency=$_GET["cc"];
             $transaction=$_GET["tx"];
             $status=$_GET["st"];
             
              /*insertar el registro de pedido*/
             
              /*$conectar=Conectar::conexion();
             
              $sql="insert into pedidos values(null,?,?,?,?);";
             
              $resultado=$conectar->prepare($sql);
             
              $resultado->bindValue(1,$amount);
              $resultado->bindValue(2,$transaction);
              $resultado->bindValue(3,$status);
              $resultado->bindValue(4,$currency);
             
                if($resultado->execute()){
                    
                    echo "<h1 style='color:green'>Se hizo el registro del pedido</h1>";
                
                } else{
                    
                     echo "<h1 style='color:red'>Falla en la consulta</h1>";
                }*/
        
         } else{
             
             header("Location:index.php");
         }
   
         //session_destroy();

     ?>
     
     <?php

          foreach($_SESSION as $name=>$valor){
                    
                   if($valor >0){
                    
                   if(substr($name,0,9)=="producto_"){
                       
                    $length=strlen($name)-9;
                       
                    $id_producto=substr($name,9,$length);
                       
                /*INSERTAR PEDIDO INICIO*/
                   $conectar=Conectar::conexion();

                  $sql="insert into pedidos values(null,?,?,?,?);";

                  $resultado=$conectar->prepare($sql);

                  $resultado->bindValue(1,$amount);
                  $resultado->bindValue(2,$transaction);
                  $resultado->bindValue(3,$status);
                  $resultado->bindValue(4,$currency);

                    if($resultado->execute()){
                        
                        $ultimo_id_pedido=$conectar->lastInsertId();

                        /*echo "<h1 style='color:green'>Se hizo el registro del pedido</h1>";*/

                    } else{

                         echo "<h1 style='color:red'>Falla en la consulta</h1>";
                    }      

                /*INSERTAR PEDIDO FIN*/
                       
                /*selecciona los productos en el checkout.php*/
            
                $sql="select * from productos where id_producto=?";
            
                $resultado=$conectar->prepare($sql);
            
                $resultado->bindValue(1,$id_producto);
            
                 if($resultado->execute()){
                     
                     while($reg=$resultado->fetch()){
                         
                        $producto_titulo=$reg["producto_titulo"];
                        $producto_precio=$reg["producto_precio"];
                        $producto_cantidad=$reg["producto_cantidad"];
                         
                        /*INSERTAR REPORTE INICIO*/
                          
                          $insertar_reporte="insert into reportes values(null,?,?,?,?,?)";
                         
                          $resultado=$conectar->prepare($insertar_reporte);
                         
                          $resultado->bindValue(1,$id_producto);
                          $resultado->bindValue(2,$ultimo_id_pedido);
                          $resultado->bindValue(3,$producto_precio);
                          $resultado->bindValue(4,$producto_titulo);
                          $resultado->bindValue(5,$valor);
                         
                           if(!$resultado->execute()){
                               
                               echo "<h1 style='color:red'>Falla en la consulta</h1>";
                           }
                         
                        /*INSERTAR REPORTE FIN*/
                         
                         /*Actualizamos la cantidad de productos en la tabla productos una vez se haga la venta*/
                         
                         /*INICIO Actualizar cantidad en PRODUCTOS*/
                         
                         /*obtenemos el valor actual del producto_cantidad del id_producto seleccionado de la tabla productos y se lo restamos al producto_cantidad que se ha vendido que es el $valor*/
                         
                         /*Ahora se resta la cantidad actual menos la cantidad vendida*/
                         
                         $cantidad_actual= $producto_cantidad - $valor;
                         
                         /*Actualiza el campo producto_cantidad en la tabla productos*/
                         $update_cantidad="update productos set
                         
                          producto_cantidad=?
                          where 
                          id_producto=?
                         
                         ";
                         
                          $resultado=$conectar->prepare($update_cantidad);
                         
                          $resultado->bindValue(1,$cantidad_actual);
                          $resultado->bindValue(2,$id_producto);
                         
                            if(!$resultado->execute()){
                               
                               echo "<h1 style='color:red'>Falla en la consulta de editar el campo producto_cantidad</h1>";
                            }
                                                  
                         /*FIN Actualizar cantidad en PRODUCTOS*/
                         
                    }//cierre del ciclo while
                     
                    
                  //cierre del if de la validacion de la consulta
                 } else {
                    
                     echo "<h1 style='color:red'>Falla en la consulta</h1>";
                  }
                       
             }//cierre del if del substr
                       
         }//cierre del if del $valor >0
                    
      }//cierre del foreach

       /*una vez se inserte los pedidos y reportes se destruye la session para evitar que se hagan nuevos registros al refrescar la pagina gracias.php con los parametros*/
       session_destroy();
                
     ?>
  
  
    <!-- Page Content -->
    <div class="container">
    
      <h1 class="text-center">GRACIAS</h1>

    </div>
    <!-- /.container -->

 <?php require_once("includes/footer.php");?>