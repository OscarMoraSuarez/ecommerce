   <?php require_once("includes/conexion.php");?>
    <?php require_once("includes/header.php");?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!--categorias-->
           <?php require_once("includes/side_nav.php");?>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                         
                         <?php require_once("includes/slider.php");?>
                    </div>

                </div>

                <div class="row">
                   
                 
                    
                    <?php
                    
                       $conectar= Conectar::conexion();
                    
                       $sql="select * from productos";
                    
                       $resultado= $conectar->prepare($sql);
                    
                         if(!$resultado->execute()){
                             
                             echo "<h1 style='color:red'>Fallo en la consulta</h1>";
                        
                         } else {
                             
                             while($reg=$resultado->fetch()){
                                 
                             $id_producto=$reg["id_producto"];
                             $producto_titulo=$reg["producto_titulo"];
                             $producto_precio=$reg["producto_precio"];
                             $producto_imagen=$reg["producto_imagen"];
                             $descripcion_corta=$reg["descripcion_corta"];
                    
                    ?>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                           
                           <a href="item.php?id_producto=<?php echo $id_producto?>">
                            <img src="uploads/<?php echo $producto_imagen;?>" alt="">
                            </a>
                            
                            <div class="caption">
                                <h4 class="pull-right">&#36;<?php echo $producto_precio;?></h4>
                                <h4><a href="item.php?id_producto=<?php echo $id_producto;?>"><?php echo $producto_titulo;?></a>
                                </h4>
                                <p><?php echo substr($descripcion_corta,0,50);?></p>
                                
                                 <a class="btn btn-primary" target="_blank" href="carro.php?agregar=<?php echo $id_producto;?>">Agregar al Carro</a>
                            </div>
                            
                        </div>
                    </div>

                    <?php
                                 
                             }
                    
                         }
                    
                    ?>
    

                </div><!--row termina aqui-->

            </div>

        </div>

    </div>
    <!-- /.container -->

   <?php require_once("includes/footer.php");?>