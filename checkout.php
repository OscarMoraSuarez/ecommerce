<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
  
  <?php 

     /*if(isset($_SESSION["producto_1"])){
         
         echo $_SESSION["item_total"];
     }*/

?>
  
    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
      
      <?php
    
         if(isset($_GET["cantidad"]) and isset($_GET["producto_titulo"])){
             
             $cantidad=$_GET["cantidad"];
             $producto_titulo=$_GET["producto_titulo"];
             
             echo "<h1 class='text-center text-danger bg-danger'>Tenemos  ".$cantidad." productos disponibles del (".$producto_titulo.")</h1>";  
         }
    
    
      ?>

      <h1>Checkout</h1>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="superandola456@gmail.com">
  <input type="hidden" name="currency_code" value="USD">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Producto</th>
           <th>Precio</th>
           <th>Cantidad</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
           
           <?php
                
                $conectar=Conectar::conexion();
            
                $total=0;
                $item_cantidad=0;
                $item_name=1;
                $item_number=1;
                $amount=1;
                $quantity=1;
            
                foreach($_SESSION as $name=>$valor){
                    
                   if($valor >0){
                    
                   if(substr($name,0,9)=="producto_"){
                       
                    $length=strlen($name)-9;
                       
                    $id_producto=substr($name,9,$length);
            
                $sql="select * from productos where id_producto=?";
            
                $resultado=$conectar->prepare($sql);
            
                $resultado->bindValue(1,$id_producto);
            
                 if($resultado->execute()){
                     
                     while($reg=$resultado->fetch()){
                         
                        $id_producto=$reg["id_producto"];
                        $producto_titulo=$reg["producto_titulo"];
                        $producto_precio=$reg["producto_precio"];
                        $producto_cantidad=$reg["producto_cantidad"];
                        $producto_imagen=$reg["producto_imagen"];
                         
                         /*calculo del subtotal*/
                         
                         $sub_total= $producto_precio*$valor;
                         
                         /*cantidad items*/
                         
                         $item_cantidad+=$valor;
            ?>
            
            <tr>
                <td><?php echo $producto_titulo;?><br/>
                  <img width="100" src="uploads/<?php echo $producto_imagen;?>" alt="">
                </td>
                <td>&#36;<?php echo $producto_precio;?></td>
                <td><?php echo $valor?></td>
                <td><?php echo $sub_total;?></td>
                <td>
                    
                <a class="btn btn-warning" href="carro.php?remover=<?php echo $id_producto;?>"><span class="glyphicon glyphicon-minus"></span></a>
                
                <a class="btn btn-success" href="carro.php?agregar=<?php echo $id_producto;?>">
                <span class="glyphicon glyphicon-plus"></span></a>
                
                <a class="btn btn-danger" href="carro.php?eliminar=<?php echo $id_producto;?>">
                <span class="glyphicon glyphicon-remove"></span></a>
                
                </td>
                
            </tr>
            
               <input type="hidden" name="item_name_<?php echo $item_name?>" value="<?php echo $producto_titulo;?>">
              <input type="hidden" name="item_number_<?php echo $item_number?>" value="<?php echo $id_producto;?>">
              <input type="hidden" name="amount_<?php echo $amount?>" value="<?php echo $producto_precio;?>">
              <input type="hidden" name="quantity_<?php echo $quantity?>" value="<?php echo $valor;?>">
            
            <?php
                         
                    /*se incrementa*/
                         
                    $item_name++;
                    $item_number++;
                    $amount++;
                    $quantity++;
                  
                  }//cierre del ciclo while
                     
                     /*calculo del total*/
                     
                     $_SESSION["item_total"]= $total+=$sub_total;
                     
                     /*calculo el numero de items*/
                     
                     $_SESSION["item_cantidad"]=$item_cantidad;
                  
                  //cierre del if de la validacion de la consulta
                 } else {
                    
                     echo "<h1 style='color:red'>Falla en la consulta</h1>";
                  }
                       
                   }//cierre del if del substr
                       
                 }//cierre del if del $valor >0
                    
              }//cierre del foreach
            ?>
            
        </tbody>
    </table>
    
    <?php  
          
         if(isset($_SESSION["item_cantidad"]) && $_SESSION["item_cantidad"] >=1){
             
             echo "<input type='image' name='upload'
    src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif'
    alt='PayPal - The safer, easier way to pay online'>";
       
         }
    
    ?>
    
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo isset($_SESSION["item_cantidad"])? $_SESSION["item_cantidad"]:$_SESSION["item_cantidad"]="0";?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">&#36;<?php echo isset($_SESSION["item_total"])? $_SESSION["item_total"]:$_SESSION["item_total"]="0";?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


    </div>
    <!-- /.container -->

 <?php require_once("includes/footer.php");?>