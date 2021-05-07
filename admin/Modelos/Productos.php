<?php

  class Productos extends Conectar{
      
      private $db;
      private $productos;
      private $producto_por_id;
      
      public function __construct(){
          
          $this->db= Conectar::conexion();
          $this->productos=array();
          $this->producto_por_id=array(); 
      }
      
      public function get_productos(){
          
           $sql="select * from productos";
          
           $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
                
                echo "<h1 style='color:red'>Falla en la consulta</h1>";
            
            } else {
                
                 while($reg=$resultado->fetch()){
                     
                      $this->productos[]=$reg;
                 }
                
                 return $this->productos;
            }
          
      }
      
      /*insertar producto*/
      public function insertar_producto(){
          
           //print_r($_POST); exit();
       
           /*validamos que los campos no esten vacios*/
          
           if(empty($_POST["producto_titulo"]) or empty($_POST["producto_id_categoria"]) or empty($_POST["producto_precio"]) or empty($_POST["producto_cantidad"]) or empty($_POST["producto_descripcion"]) or empty($_POST["descripcion_corta"]) or empty($_FILES["file"])){
              
               header("Location:index.php?add_producto&m=1"); exit();
           }
          
           /*se declaran las variables que se envian del formulario*/
          
           $producto_titulo=$_POST["producto_titulo"];
           $producto_id_categoria=$_POST["producto_id_categoria"];
           $producto_precio=$_POST["producto_precio"];
           $producto_cantidad=$_POST["producto_cantidad"];
           $producto_descripcion=$_POST["producto_descripcion"];
           $descripcion_corta=$_POST["descripcion_corta"];
           $producto_imagen=$_FILES["file"]["name"];
           $producto_imagen_temp=$_FILES["file"]["tmp_name"];
          
           move_uploaded_file($producto_imagen_temp,"../uploads/$producto_imagen");
          
           $sql="insert into productos values(null,?,?,?,?,?,?,?);";
          
           //echo $sql; exit();
          
           $resultado=$this->db->prepare($sql);
          
              $resultado->bindValue(1,$producto_titulo);
              $resultado->bindValue(2,$producto_id_categoria);
              $resultado->bindValue(3,$producto_precio);
              $resultado->bindValue(4,$producto_cantidad);
              $resultado->bindValue(5,$producto_descripcion);
              $resultado->bindValue(6,$descripcion_corta);
              $resultado->bindValue(7,$producto_imagen);
                                    
              if(!$resultado->execute()){
                 
                  header("Location:index.php?add_producto&m=2");
             
              }else {
                   
                    /*se inserta el registro*/
                    if($resultado->rowCount()>0){
                        
                       header("Location:index.php?add_producto&m=3");
                   
                    }else {
                        
                        /*no se inserta el registro*/
                         header("Location:index.php?add_producto&m=4");
                    }
              }
         
      }
      
      /*Mostrar la informacion del registro del producto*/
      
       public function get_producto_por_id($id_producto){
         
             
            $sql="select * from productos where id_producto=?";
           
            $resultado=$this->db->prepare($sql);
            $resultado->bindValue(1,$id_producto);
           
             if(!$resultado->execute()){
                 
                 echo "<h1 style='color:red'>Falla en la consulta</h1>";
             
             } else {
                 
                  if($resultado->rowCount()>0){
                       
                      while($reg=$resultado->fetch()){
                          
                          $this->producto_por_id[]=$reg;
                      }
                      
                      return $this->producto_por_id;
                  }
             }
       }
      
        /*editar producto*/
      public function editar_producto(){
          
           //print_r($_POST); exit();
       
           /*validamos que los campos no esten vacios*/
          
           if(empty($_POST["producto_titulo"]) or empty($_POST["producto_id_categoria"]) or empty($_POST["producto_precio"]) or empty($_POST["producto_cantidad"]) or empty($_POST["producto_descripcion"]) or empty($_POST["descripcion_corta"])){
              
               header("Location:index.php?edit_producto&editar=".$_GET["editar"]."&m=1"); exit();
           }
          
           /*se declaran las variables que se envian del formulario*/
           $id_producto=$_GET["editar"];
           $producto_titulo=$_POST["producto_titulo"];
           $producto_id_categoria=$_POST["producto_id_categoria"];
           $producto_precio=$_POST["producto_precio"];
           $producto_cantidad=$_POST["producto_cantidad"];
           $producto_descripcion=$_POST["producto_descripcion"];
           $descripcion_corta=$_POST["descripcion_corta"];
           $producto_imagen=$_FILES["file"]["name"];
           $producto_imagen_temp=$_FILES["file"]["tmp_name"];
          
           move_uploaded_file($producto_imagen_temp,"../uploads/$producto_imagen");
           
           /*editar el producto*/
           $sql="update productos set
           
            producto_titulo=?,
            producto_id_categoria=?,
            producto_precio=?,
            producto_cantidad=?,
            producto_descripcion=?,
            descripcion_corta=?,
            producto_imagen=?
            where 
            id_producto=?
           
           ";
          
           //echo $sql; exit();
           
           /*validando si el campo de la imagen es vacio*/
           if(empty($producto_imagen)){
               
               $producto_imagen=$_POST["archivo"];
           }
          
           $resultado=$this->db->prepare($sql);
          
              $resultado->bindValue(1,$producto_titulo);
              $resultado->bindValue(2,$producto_id_categoria);
              $resultado->bindValue(3,$producto_precio);
              $resultado->bindValue(4,$producto_cantidad);
              $resultado->bindValue(5,$producto_descripcion);
              $resultado->bindValue(6,$descripcion_corta);
              $resultado->bindValue(7,$producto_imagen);
              $resultado->bindValue(8,$id_producto);
                                    
              if(!$resultado->execute()){
                 
                  header("Location:index.php?edit_producto&editar=$id_producto&m=2");
             
              }else {
                   
                    /*se editó el registro*/
                    if($resultado->rowCount()>0){
                        
                       header("Location:index.php?edit_producto&editar=$id_producto&m=3");
                   
                    }else {
                        
                        /*no se editó el registro*/
                         header("Location:index.php?edit_producto&editar=$id_producto&m=4");
                    }
              }
         
      }
      
       
       public function eliminar_producto($id_producto){
           
             $sql="select * from productos where id_producto=?";
           
             $resultado=$this->db->prepare($sql);
           
             $resultado->bindValue(1,$id_producto);
           
              if(!$resultado->execute()){
                  
                   header("Location:index.php?productos&m=1"); 
             
              } else{
                  
                    if($resultado->rowCount()>0){
                        
                        $sql="delete from productos where id_producto=?";
                        
                        $resultado=$this->db->prepare($sql);
                        
                        $resultado->bindValue(1,$id_producto);
                        
                          if(!$resultado->execute()){
                             
                                header("Location:index.php?productos&m=1"); 
                         
                          } else{
                              
                               if($resultado->rowCount()>0){
                                   
                                   /*se elimina el producto*/
                                   header("Location:index.php?productos&m=2");  
                               }
                         
                         
                         }
                        
                   
                    } else{
                             
                              /*no existe el id del producto seleccionado*/
                             header("Location:index.php?productos&m=3");  
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
      
        
          public function get_numero_productos(){

              $sql="select * from productos"; 

              $resultado=$this->db->prepare($sql);

                if(!$resultado->execute()){

                    echo "<h1 style='color:red'>Falla en la consulta</h1>";

                }else{

                     return $resultado->rowCount();
                }

           }
      
      
  }

?>