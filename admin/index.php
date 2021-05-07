     <!--el admin_header.php contenido el archivo conexion.php -->
      <?php require_once("includes/admin_header.php");?>
      <?php require_once("Modelos/Pedidos.php");?>
      <?php require_once("Modelos/Productos.php");?>
      <?php require_once("Modelos/Categorias.php");?>
      <?php require_once("Modelos/Usuarios.php");?>
      <?php require_once("Modelos/Reportes.php");?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

               
                 
                 <?php
                
                      if($_SERVER["REQUEST_URI"]=="/ecommerce/admin/" || $_SERVER["REQUEST_URI"]=="/ecommerce/admin/index.php"){
                          
                          require_once("includes/admin_contenido.php");
                      }
                
                      if(isset($_GET["pedidos"])){
                          
                          require_once("pedidos.php");
                      }
                
                
                      if(isset($_GET["categorias"])){
                          
                          require_once("categorias.php");
                      }
                
                       
                      if(isset($_GET["productos"])){
                          
                          require_once("productos.php");
                      } 
                
                      
                      if(isset($_GET["add_producto"])){
                          
                          require_once("add_producto.php");
                      }
                
                       if(isset($_GET["edit_producto"])){
                          
                          require_once("edit_producto.php");
                      }
                
                
                       
                      if(isset($_GET["usuarios"])){
                          
                          require_once("usuarios.php");
                      } 
                
                      
                      if(isset($_GET["add_usuario"])){
                          
                          require_once("add_usuario.php");
                      }
                
                       if(isset($_GET["edit_usuario"])){
                          
                          require_once("edit_usuario.php");
                      }
                
                       if(isset($_GET["reportes"])){
                          
                          require_once("reportes.php");
                      } 
                
                  ?>

                 
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php require_once("includes/admin_footer.php");?>