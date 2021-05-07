<?php

  class Categorias extends Conectar{
      
      private $db;
      private $categorias;
      
      public function __construct(){
          
          $this->db= Conectar::conexion();
          $this->categorias=array();
          
      }
      
      public function get_categorias(){
          
           $sql="select * from categorias";
          
           $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
                
                echo "<h1 style='color:red'>Falla en la consulta</h1>";
            
            } else {
                
                 while($reg=$resultado->fetch()){
                     
                      $this->categorias[]=$reg;
                 }
                
                 return $this->categorias;
            }
          
      }
      
       /*insertar categoria*/
      
       public function insertar_categoria(){
           
             $cat_titulo=$_POST["cat_titulo"];
           
            if(empty($_POST["cat_titulo"])){
                
                header("Location:index.php?categorias&m=1");
                
            }else{
                
                /*validando si existe la categoria en la base de datos*/
                
                $sql="select * from categorias where cat_titulo=?";
                
                $resultado=$this->db->prepare($sql);
                
                $resultado->bindValue(1,$cat_titulo);
                
                 if(!$resultado->execute()){
                     
                     header("Location:index.php?categorias&m=2"); 
                 
                 } else {
                      
                      /*existe la categoria*/
                      if($resultado->rowCount()>0){
                         
                         header("Location:index.php?categorias&m=3");
                     
                      } else{
                          
                          /*se inserta la categoria*/
                          
                          $sql="insert into categorias values(null,?)";
                          
                          $resultado=$this->db->prepare($sql);
                          $resultado->bindValue(1,$cat_titulo);
                          
                           if(!$resultado->execute()){
                               
                                header("Location:index.php?categorias&m=2");
                           
                           } else{
                               
                               /*se insertó el registro*/
                               if($resultado->rowCount()>0){
                                 
                                   header("Location:index.php?categorias&m=4"); 
                              
                               }else{
                                   
                                   /*no se insertó el registro*/
                                   header("Location:index.php?categorias&m=5"); 
                               }
                           }
                      }
                 }
            }
       }
      
        /*mostrar el registro de la categoria*/
      
        public function get_categoria_por_id($id_categoria){
          
            $sql="select * from categorias where id_categoria=?";
            
            $resultado=$this->db->prepare($sql);
            
            $resultado->bindValue(1,$id_categoria);
            
              if(!$resultado->execute()){
                 
                  header("Location:index.php?categorias&m=2");
            
              }else{
                  
                  /*existe la categoria en la bd*/
                  if($resultado->rowCount()>0){
                      
                      while($reg=$resultado->fetch()){
                          
                          $cat_titulo=$reg["cat_titulo"];
                        
                          echo "<input name='cat_titulo' value='$cat_titulo' type='text' class='form-control'>";
                      }
                 
                  }else{
                     /*no existe el id de la categoria*/ 
                     header("Location:index.php?categorias&m=6"); 
                  }
              }
            
        }
      
         /*editar categoria*/
      
       public function editar_categoria(){
           
             $cat_titulo=$_POST["cat_titulo"];
             $id_categoria=$_GET["editar"];
           
            if(empty($_POST["cat_titulo"])){
                
                header("Location:index.php?categorias&editar=$id_categoria&m=1");
                exit();
                
            }else{
                
                /*validando si existe la categoria en la base de datos*/
                
                $sql="select * from categorias where cat_titulo=?";
                
                $resultado=$this->db->prepare($sql);
                
                $resultado->bindValue(1,$cat_titulo);
                
                 if(!$resultado->execute()){
                     
                     header("Location:index.php?categorias&m=2"); 
                 
                 } else {
                      
                      /*existe la categoria*/
                      if($resultado->rowCount()>0){
                         
                         header("Location:index.php?categorias&editar=$id_categoria&m=3");
                     
                      } else{
                          
                          /*se inserta la categoria*/
                          
                          $sql="update categorias set 
                          
                            cat_titulo=?
                            where 
                            id_categoria=?
                          
                          ";
                          
                          $resultado=$this->db->prepare($sql);
                          $resultado->bindValue(1,$cat_titulo);
                          $resultado->bindValue(2,$id_categoria);
                          
                           if(!$resultado->execute()){
                               
                                header("Location:index.php?categorias&m=2");
                           
                           } else{
                               
                               /*se editó el registro*/
                               if($resultado->rowCount()>0){
                                 
                                   header("Location:index.php?categorias&editar=$id_categoria&m=7"); 
                              
                               }else{
                                   
                                   /*no se editó el registro*/
                                   header("Location:index.php?categorias&editar=$id_categoria&m=8"); 
                               }
                           }
                      }
                 }
            }
       }
      
      
       
       public function eliminar_categoria($id_categoria){
           
             $sql="select * from categorias where id_categoria=?";
           
             $resultado=$this->db->prepare($sql);
           
             $resultado->bindValue(1,$id_categoria);
           
              if(!$resultado->execute()){
                  
                   header("Location:index.php?categorias&m=2"); 
             
              } else{
                  
                    if($resultado->rowCount()>0){
                        
                        $sql="delete from categorias where id_categoria=?";
                        
                        $resultado=$this->db->prepare($sql);
                        
                        $resultado->bindValue(1,$id_categoria);
                        
                          if(!$resultado->execute()){
                             
                                header("Location:index.php?categorias&m=2"); 
                         
                          } else{
                              
                               if($resultado->rowCount()>0){
                                   
                                   /*se elimina la categoria*/
                                   header("Location:index.php?categorias&m=9");  
                               }
                         
                         
                         }
                        
                   
                    } else{
                             
                              /*no existe el id de la categoria seleccionado*/
                             header("Location:index.php?categorias&m=6");  
                          }
              }
           
       }
      
      
       /*mostrar el titulo de la categoria en la tabla productos de admin*/
      
       public function mostrar_categoria_titulo($producto_id_categoria){
             
             /*validando si existe el id_categoria*/
           
            $sql="select * from categorias where id_categoria=?";
           
            $resultado=$this->db->prepare($sql);
           
            $resultado->bindValue(1,$producto_id_categoria);
           
             if(!$resultado->execute()){
                 
                 echo "<h1 style='color:red'>Falla en la consulta</h1>";
            
             } else {
                 
                  /*existe el id de la categoria*/
                  if($resultado->rowCount()>0){
                      
                      while($reg=$resultado->fetch()){
                          
                          echo $reg["cat_titulo"];
                      }
                  }
             }
           
       }
      
         
          public function get_numero_categorias(){

              $sql="select * from categorias"; 

              $resultado=$this->db->prepare($sql);

                if(!$resultado->execute()){

                    echo "<h1 style='color:red'>Falla en la consulta</h1>";

                }else{

                     return $resultado->rowCount();
                }

           }
      
      
  }

?>