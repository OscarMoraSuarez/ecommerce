<?php require_once("includes/conexion.php");?>
<?php require_once("includes/header.php");?>

<?php

      if(isset($_GET["agregar"])){
          
            $conectar=Conectar::conexion();
          
            $id_producto=$_GET["agregar"];
          
            $sql="select * from productos where id_producto=?";
          
            $resultado=$conectar->prepare($sql);
          
            $resultado->bindValue(1,$id_producto);
          
              if(!$resultado->execute()){
                  
                  echo "<h1 style='color:red'>Falla en la consulta</h1>";
             
              } else {
                  
                   if($resultado->rowCount()>0){
                       
                       while($reg=$resultado->fetch()){
                            
                           if($reg["producto_cantidad"]!=$_SESSION["producto_".$_GET["agregar"]]){
                               
                              $_SESSION["producto_".$_GET["agregar"]] +=1;
          
                               header("Location:checkout.php"); 
                               
                           }else {
                              
                               header("Location:checkout.php?cantidad=".$reg['producto_cantidad']."&producto_titulo=".$reg['producto_titulo']."");
                           }
                       }
                       
                   } else {
                       
                        echo "<h1 style='color:red'>No existen registros asociados</h1>";
                   }
              }
          
           
      }

      /*remover registro en checkout.php*/

       if(isset($_GET["remover"])){
          
            $_SESSION["producto_".$_GET["remover"]]--;
           
            if($_SESSION["producto_".$_GET["remover"]] <1){
                
               /*el unset es para que ponga en 0 en el orden total y en la cantidad de items total si se eliminan todos los productos a comprar en checkout.php*/ 
                unset($_SESSION["item_total"]);
                unset($_SESSION["item_cantidad"]);
                header("Location:checkout.php");
           
            }else {
                
                header("Location:checkout.php");
            }
             
       }

       /*eliminar registro en checkout.php*/

       if(isset($_GET["eliminar"])){
           /*el unset es para que ponga en 0 en el orden total y en la cantidad de items total si se eliminan todos los productos a comprar en checkout.php*/
            unset($_SESSION["item_total"]);
            unset($_SESSION["item_cantidad"]);
           $_SESSION["producto_".$_GET["eliminar"]]="0";
           
           header("Location:checkout.php");
             
       }

?>

