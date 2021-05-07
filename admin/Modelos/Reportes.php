<?php

  class Reportes extends Conectar{
      
      private $db;
      private $reportes;
     
      
      public function __construct(){
          
          $this->db= Conectar::conexion();
          $this->reportes=array();
          
      }
      
      public function get_reportes(){
          
           $sql="select * from reportes";
          
           $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
                
                echo "<h1 style='color:red'>Falla en la consulta</h1>";
            
            } else {
                
                 while($reg=$resultado->fetch()){
                     
                      $this->reportes[]=$reg;
                 }
                
                 return $this->reportes;
            }
          
      }
      
     
       
       public function eliminar_reporte($id_reporte){
           
             $sql="select * from reportes where id_reporte=?";
           
             $resultado=$this->db->prepare($sql);
           
             $resultado->bindValue(1,$id_reporte);
           
              if(!$resultado->execute()){
                  
                   header("Location:index.php?reportes&m=1"); 
             
              } else{
                  
                    if($resultado->rowCount()>0){
                        
                        $sql="delete from reportes where id_reporte=?";
                        
                        $resultado=$this->db->prepare($sql);
                        
                        $resultado->bindValue(1,$id_reporte);
                        
                          if(!$resultado->execute()){
                             
                                header("Location:index.php?reportes&m=1"); 
                         
                          } else{
                              
                               if($resultado->rowCount()>0){
                                   
                                   /*se elimina el reporte*/
                                   header("Location:index.php?reportes&m=2");  
                               }
                         
                         
                         }
                        
                   
                    } else{
                             
                              /*no existe el id del reporte seleccionado*/
                             header("Location:index.php?reportes&m=3");  
                          }
              }
           
       }
      
        
           public function get_numero_reportes(){

              $sql="select * from reportes"; 

              $resultado=$this->db->prepare($sql);

                if(!$resultado->execute()){

                    echo "<h1 style='color:red'>Falla en la consulta</h1>";

                }else{

                     return $resultado->rowCount();
                }

           }
      
      
  }

?>