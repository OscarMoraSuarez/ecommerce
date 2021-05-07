<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>
   
   
    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->

           <?php require_once("includes/side_nav.php");?>
           
<?php
   
      $conectar= Conectar::conexion();
    
      $id_producto=$_GET["id_producto"];
     
      $sql="select * from productos where id_producto=?";
    
      $resultado=$conectar->prepare($sql);
       
      $resultado->bindValue(1,$id_producto);
    
       if(!$resultado->execute()){
           
           echo "<h1 style='color:red'>Falla en la consulta</h1>";
     
       } else {
           
            if($resultado->rowCount()>0){
                
              while($reg=$resultado->fetch()){
                  
                $producto_titulo=$reg["producto_titulo"];
                $producto_precio=$reg["producto_precio"];
                $producto_descripcion=$reg["producto_descripcion"];
                $descripcion_corta=$reg["descripcion_corta"];
                $producto_imagen=$reg["producto_imagen"];

?>

<div class="col-md-9">

<!--Row For Image and Short Description-->

<div class="row">

    <div class="col-md-7">
       <img class="img-responsive" src="uploads/<?php echo $producto_imagen;?>" alt="">

    </div>

    <div class="col-md-5">

        <div class="thumbnail">
         

    <div class="caption-full">
        <h4><a href="#"><?php echo $producto_titulo;?></a> </h4>
        <hr>
        <h4 class="">&#36;<?php echo $producto_precio;?></h4>

    <div class="ratings">
     
        <p>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star-empty"></span>
            4.0 stars
        </p>
    </div>
          
        <p><?php echo $descripcion_corta;?></p>

   
    <form action="">
        <div class="form-group">
            <a href="carro.php?agregar=<?php echo $id_producto;?>" class="btn btn-primary">Agregar al Carro</a>
        </div>
    </form>

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


        <hr>


<!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">

<p></p>
           
    <p><?php echo $producto_descripcion;?></p>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">

  <div class="col-md-6">

       <h3>2 Reviews From </h3>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">10 days ago</span>
                <p>This product was great in terms of quality. I would definitely buy another!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">12 days ago</span>
                <p>I've alredy ordered another one!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Anonymous
                <span class="pull-right">15 days ago</span>
                <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
            </div>
        </div>

    </div>


    <div class="col-md-6">
        <h3>Add A review</h3>

     <form action="" class="form-inline">
        <div class="form-group">
            <label for="">Name</label>
                <input type="text" class="form-control" >
            </div>
             <div class="form-group">
            <label for="">Email</label>
                <input type="test" class="form-control">
            </div>

        <div>
            <h3>Your Rating</h3>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
        </div>

            <br>
            
             <div class="form-group">
             <textarea name="" id="" cols="60" rows="10" class="form-control"></textarea>
            </div>

             <br>
              <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="SUBMIT">
            </div>
        </form>

    </div>

 </div>

 </div>

</div>


</div><!--Row for Tab Panel-->

</div><!--col md 9 termina aqui-->

<?php  
                  
         }//cierre del ciclo while
    
     }//cierre de la validacion
        else{
            
            echo "<h1 style='color:red'>NO existen registros asociados</h1>";
        }
           
    }//cierre de la validacion si se ejecuta la consulta
?>

</div>
    <!-- /.container -->

   <?php require_once("includes/footer.php");?>