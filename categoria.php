<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
   

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <!--<header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>-->

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Ultimos Productos</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

           <?php
            
               $conectar=Conectar::conexion();
            
               $id_categoria= $_GET["id_categoria"];
            
               $sql="select * from productos where producto_id_categoria=?";
            
               $resultado=$conectar->prepare($sql);
            
               $resultado->bindValue(1,$id_categoria);
            
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
                            <a href="carro.php?agregar=<?php echo $id_producto;?>" class="btn btn-primary">Agregar al Carro</a> 
                            <!--<a href="#" class="btn btn-default">More Info</a>-->
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