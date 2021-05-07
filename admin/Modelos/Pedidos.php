<?php

  class Pedidos extends Conectar{
      
      private $db;
      private $pedidos;
      
      public function __construct(){
          
          $this->db= Conectar::conexion();
          $this->pedidos=array();
          
      }
      
      public function get_pedidos(){
          
           $sql="select * from pedidos";
          
           $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
                
                echo "<h1 style='color:red'>Falla en la consulta</h1>";
            
            } else {
                
                 while($reg=$resultado->fetch()){
                     
                      $this->pedidos[]=$reg;
                 }
                
                 return $this->pedidos;
            }
          
      }
      
       
       public function eliminar_pedido($id_pedido){
           
             $sql="select * from pedidos where id_pedido=?";
           
             $resultado=$this->db->prepare($sql);
           
             $resultado->bindValue(1,$id_pedido);
           
              if(!$resultado->execute()){
                  
                   header("Location:index.php?pedidos&m=1"); 
             
              } else{
                  
                    if($resultado->rowCount()>0){
                        
                        $sql="delete from pedidos where id_pedido=?";
                        
                        $resultado=$this->db->prepare($sql);
                        
                        $resultado->bindValue(1,$id_pedido);
                        
                          if(!$resultado->execute()){
                             
                                header("Location:index.php?pedidos&m=1"); 
                         
                          } else{
                              
                               if($resultado->rowCount()>0){
                                   
                                   /*se elimina el pedido*/
                                   header("Location:index.php?pedidos&m=2");  
                               }
                         
                         
                         }
                        
                   
                    } else{
                             
                              /*no existe el id del pedido seleccionado*/
                             header("Location:index.php?pedidos&m=3");  
                          }
              }
           
       }
      
         public function get_numero_pedidos(){

              $sql="select * from pedidos"; 

              $resultado=$this->db->prepare($sql);

                if(!$resultado->execute()){

                    echo "<h1 style='color:red'>Falla en la consulta</h1>";

                }else{

                     return $resultado->rowCount();
                }

           }
        
      
      
  }

?>