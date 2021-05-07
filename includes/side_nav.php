<div class="col-md-3">
                <p class="lead">Categorias</p>
                 
                <div class="list-group">
                   
                   <?php
                        
                       $conectar=Conectar::conexion();
                    
                       $sql="select * from categorias";
                    
                       $resultado=$conectar->prepare($sql);
                    
                         if(!$resultado->execute()){
                             
                             echo "<h1 style='color:red'>Falla en la consulta</h1>";
                        
                         } else {
                             
                              while($reg=$resultado->fetch()){
                                   
                                   $id_categoria=$reg["id_categoria"];
                                   $cat_titulo=$reg["cat_titulo"];
                                  
                                   echo "<a href='categoria.php?id_categoria=$id_categoria' class='list-group-item'>$cat_titulo</a>";
                              }
                         }
                    
                    
                    ?>
                   
                    
                </div>
</div>