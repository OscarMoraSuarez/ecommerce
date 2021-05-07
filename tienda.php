<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
   

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header>
            <h1>Tienda</h1>
          
        </header>

        <hr>

        <!-- Page Features -->
        <div class="row text-center">

           <?php
            
               $conectar=Conectar::conexion();
            
               $sql="select * from productos";
            
               $resultado=$conectar->prepare($sql);
            
                 if(!$resultado->execute()){
                     
                    echo "<h1 style='color:red'>Falla en la consulta</h1>";
                     
                 } else {
                     
                     if($resultado->rowCount()>0){
                         
                     while($reg=$resultado->fetch()){
                         
                      $id_producto=$reg["id_producto"];
                      $producto_titulo=$reg["producto_titulo"];
                      $producto_imagen=$reg["producto_imagen"];
                      $descripcion_corta=$reg["descripcion_corta"];
            
            ?>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="uploads/<?php echo $producto_imagen?>" alt="">
                    <div class="caption">
                        <h3><?php echo $producto_titulo;?></h3>
                        <p><?php echo substr($descripcion_corta,0,50);?></p>
                        <p>
                            <a href="carro.php?agregar=<?php echo $id_producto;?>" class="btn btn-primary">Agregar al Carro</a> <!--<a href="#" class="btn btn-default">More Info</a>-->
                        </p>
                    </div>
                </div>
            </div>
            
         <?php
            
              }//cirre del ciclo while
                         
            }else {
                   
                   echo "<h1 style='color:red'>No existen registros asociados</h1>";
                }
                     
           }//cierre de la validacion de la consulta
         ?>

        </div>
        <!-- /.row -->

        <hr>


    </div>
    <!-- /.container -->

    <?php require_once("includes/footer.php");?>