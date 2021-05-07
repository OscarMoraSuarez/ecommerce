<?php

  class Usuarios extends Conectar{
      
      private $db;
      private $usuarios;
      private $usuario_por_id;
      
      public function __construct(){
          
          $this->db= Conectar::conexion();
          $this->usuarios=array();
          $this->usuario_por_id=array();
      }
      
      public function get_usuarios(){
          
           $sql="select * from usuarios";
          
           $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
                
                echo "<h1 style='color:red'>Falla en la consulta</h1>";
            
            } else {
                
                 while($reg=$resultado->fetch()){
                     
                      $this->usuarios[]=$reg;
                 }
                
                 return $this->usuarios;
            }
          
      }
      
      /*insertar usuario*/
        public function insertar_usuario(){
            
            /*declaramos las variables que se envian del formulario*/
            
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $usuario=$_POST["usuario"];
            $correo=$_POST["correo"];
            $password=$_POST["password"];
           
          
           /*validamos que los campos no esten vacios*/
             if(empty($nombre) or empty($apellido) or empty($usuario) or empty($correo) or empty($password)){
                 
                 header("Location:index.php?add_usuario&m=1");
                 exit();
             }
           
           /*el formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número, por ejemplo en este proyecto lo tengo $Qw/*12345678$ no importa el orden lo importante es que se cumple el formato*/
                 
                 /*si no se cumpla esta expresion regular con un formato del password de que al menos tenga una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres*/
                 else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $_POST["password"])) {

                     header("Location:index.php?add_usuario&m=2");

            }

             else {
              
              /*entonces si los campos no estan vacios y si se cumple el formato del password entonces validamos si existe el correo en la base de datos*/
           
           /*validamos que el usuario y correo no existan en la base de datos*/
           
           $query="select * from usuarios where usuario=? or correo=?";
           
           $result= $this->db->prepare($query);
           
           $result->bindValue(1,$usuario);
           $result->bindValue(2,$correo);
           
              if(!$result->execute()){
                 
                   header("Location:index.php?add_usuario&m=3");
              }else {
                  
                  /*existe el usuario y/o correo en la bd*/
                  if($result->rowCount()>0){
                      
                      while($reg=$result->fetch()){
                          
                          $usuario_bd=$reg["usuario"];
                          $correo_bd=$reg["correo"];
                      }
                      
                       if($usuario_bd == $_POST["usuario"]){
                          
                            /*existe el usuario en la bd*/
                            header("Location:index.php?add_usuario&m=4");
                       
                       } elseif($correo_bd == $_POST["correo"]){
                           
                           /*existe el correo en la bd*/
                           header("Location:index.php?add_usuario&m=5"); 
                       }
                     
                    
                   /*entonces si no existe el usuario y correo en la bd insertamos el nuevo registro de usuario*/   
                  } else {
                      
                      /*inserta el registro*/
                     
                      /*encriptamos el password*/
                      
                      $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);


                       $sql="insert into usuarios values(null,?,?,?,?,?,'0')";

                       $resultado= $this->db->prepare($sql);

                       $resultado->bindValue(1,$_POST["nombre"]);
                       $resultado->bindValue(2,$_POST["apellido"]);
                       $resultado->bindValue(3,$_POST["usuario"]);
                       $resultado->bindValue(4,$_POST["correo"]);
                       $resultado->bindValue(5,$pass_encriptado);
                       
                      
                         if(!$resultado->execute()){

                             header("Location:index.php?add_usuario&m=3");

                         }else {

                              /*insertamos el registro*/
                              if($resultado->rowCount()>0){
                                   
                                  /*se insertó el registro*/
                                   header("Location:index.php?add_usuario&m=6");   

                              }else{
                                  
                                 /*no se insertó el registro*/
                                 header("Location:index.php?add_usuario&m=7");  
                              }
                         } 

               }
          }
                 
         }/*cierre del else de la condicional de si los campos no estan vacios y si se cumple el formato del password*/
           
    }//cierre de la function
      
      
        /*mostrar el registro de la categoria*/
      
        public function get_usuario_por_id($id_usuario){
          
            $sql="select * from usuarios where id_usuario=?";
            
            $resultado=$this->db->prepare($sql);
            
            $resultado->bindValue(1,$id_usuario);
            
              if(!$resultado->execute()){
                 
                  header("Location:index.php?usuarios&m=1");
            
              }else{
                  
                  /*existe la categoria en la bd*/
                  if($resultado->rowCount()>0){
                      
                      while($reg=$resultado->fetch()){
                          
                            $this->usuario_por_id[]=$reg;
                      }
                      
                      return $this->usuario_por_id;
                 
                  }else{
                     /*no existe el id del usuario*/ 
                     header("Location:index.php?usuarios&m=2"); 
                  }
              }
            
        }
      
         /*editar usuario*/
      
       public function editar_usuario(){
           
            /*declaramos las variables que envio el usuario*/
           
             $id_usuario=$_GET["id_usuario"];
             $nombre=$_POST["nombre"];
             $apellido=$_POST["apellido"];
             $usuario=$_POST["usuario"];
             $correo=$_POST["correo"];
             $password=$_POST["password"];
           
            if(empty($nombre) or empty($apellido)){
                
                header("Location:index.php?edit_usuario&id_usuario=$id_usuario&m=1");
                exit();
                
            }else{
                
                /*validando si existe el id del usuario en la base de datos*/
                
                $sql="select * from usuarios where id_usuario=?";
                
                $resultado=$this->db->prepare($sql);
                
                $resultado->bindValue(1,$id_usuario);
                
                 if(!$resultado->execute()){
                     
                     header("Location:index.php?edit_usuario&id_usuario=$id_usuario&m=2"); 
                 
                 } else {
                      
                      /*existe el id del usuario*/
                      if($resultado->rowCount()>0){
                           
                          /*se edita el usuario*/
                          
                          $sql="update usuarios set 
                          
                            nombre=?,
                            apellido=?
                            where 
                            id_usuario=?
                          
                          ";
                          
                          $resultado=$this->db->prepare($sql);
                          $resultado->bindValue(1,$nombre);
                          $resultado->bindValue(2,$apellido);
                          $resultado->bindValue(3,$id_usuario);
                          
                           if(!$resultado->execute()){
                               
                               header("Location:index.php?edit_usuario&id_usuario=$id_usuario&m=2"); 
                           
                           } else{
                               
                               /*se editó el registro*/
                               if($resultado->rowCount()>0){
                                 
                                   header("Location:index.php?edit_usuario&id_usuario=$id_usuario&m=3");  
                              
                               }else{
                                   
                                   /*no se editó el registro*/
                                   header("Location:index.php?edit_usuario&id_usuario=$id_usuario&m=4"); 
                               }
                           }
                     
                      } else{
                          
                          header("Location:index.php?usuarios&m=2");
                      }
                 }
            }
       }
      
      
       
       public function eliminar_usuario($id_usuario){
           
             $sql="select * from usuarios where id_usuario=?";
           
             $resultado=$this->db->prepare($sql);
           
             $resultado->bindValue(1,$id_usuario);
           
              if(!$resultado->execute()){
                  
                   header("Location:index.php?usuarios&m=1"); 
             
              } else{
                  
                    if($resultado->rowCount()>0){
                        
                        $sql="delete from usuarios where id_usuario=?";
                        
                        $resultado=$this->db->prepare($sql);
                        
                        $resultado->bindValue(1,$id_usuario);
                        
                          if(!$resultado->execute()){
                              
                              header("Location:index.php?usuarios&m=1"); 
                         
                          } else{
                              
                               if($resultado->rowCount()>0){
                                   
                                   /*se se ha eliminado el usuario*/
                                   header("Location:index.php?usuarios&m=3");  
                              
                               } else{
                                   
                                    /*no se se ha eliminado el usuario*/
                                   header("Location:index.php?usuarios&m=4"); 
                               }
                         
                         
                         }
                        
                   
                    } else{
                             
                              /*no existe el id del usuario seleccionado*/
                            
                                   header("Location:index.php?usuarios&m=5");   
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
      
      
        /*login*/
      
        public function login($correo,$password){
            
           $correo= htmlentities(addslashes($_POST["correo"]));
           $password= htmlentities(addslashes($_POST["password"]));
           
             /*validamos si los campos estan vacios*/
           
             if(empty($correo) and empty($password)){
               
                 echo "<h1 class='text-center text-danger bg-danger'>Los campos estan vacios</h1>";
                 
             } 
            
            /*el formato del password al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número, por ejemplo en este proyecto lo tengo Qw/*12345678 no importa el orden lo importante es que se cumple el formato*/
                 
                 /*si no se cumpla esta expresion regular con un formato del password de que al menos tenga una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres*/
                 else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)) {

                     echo "<h2 class='text-center text-danger bg-danger'>El password no existe en la base de datos</h2>";

            }
            
            else {
                 
                  /*validamos si el correo existe en la bd*/
                 
    
                  $sql="select * from usuarios where correo=?";
                   
                  $resultado= $this->db->prepare($sql);
                  $resultado->bindValue(1,$correo);
                 
                    if(!$resultado->execute()){
                       
                        echo "<h1 class='text-center text-danger bg-danger'>Falla en la consulta</h1>";
                   
                    } else {
                        
                        /*validamos si existe el correo en la bd*/
                        
                        if($resultado->rowCount()>0){
                          
                            while($reg=$resultado->fetch()){
                                
                                $id_usuario=$reg["id_usuario"];
                                $usuario_bd=$reg["usuario"];
                                $password_bd=$reg["password"];
                                $nombre_bd=$reg["nombre"];
                                $correo_bd=$reg["correo"];
                            }
                       
                            /*validando si el password de la bd es igual al que ingresa el usuario*/
                             
                           
                             if(password_verify($password,$password_bd)){
                                 
                                 $_SESSION["id_usuario"]=$id_usuario;
                                 $_SESSION["usuario"]=$usuario_bd;
                                 $_SESSION["nombre"]=$nombre_bd;
                                 $_SESSION["correo"]=$correo_bd;
                                 
                                 header("Location:admin/index.php");
                            
                             }else{
                                 
                                 /*si no coinciden los password entonces lo redirecciona a login.php*/
                                 header("Location:login.php");
                             }
                        
                        
                        } else {
                            
                             /*no existe el correo en la bd*/
                             
                              echo "<h1 class='text-center text-danger bg-danger'>No existe el correo en la bd</h1>";
                        }//validando si existe el correo en la bd
                        
                        
                   
                    }//validacion si hay una falla en la consulta
            
             
             }//validacion si los campos estan vacios
             
        }
      
         
         public function get_numero_usuarios(){

              $sql="select * from usuarios"; 

              $resultado=$this->db->prepare($sql);

                if(!$resultado->execute()){

                    echo "<h1 style='color:red'>Falla en la consulta</h1>";

                }else{

                     return $resultado->rowCount();
                }

           }
      
       /*validamos si existe un correo en la tabla usuarios de la bd para resetear el password*/
         public function get_correo_en_bd($correo,$token){
          
           
           $sql="select * from usuarios where correo=?";
          
           $resultado=$this->db->prepare($sql);
          
           $resultado->bindValue(1,$correo);
          
             if(!$resultado->execute()){
                 
                 echo "<h2 class='text-center' style='color:red'>Fallo en la consulta</h2>";
                 
             }else{
                  /*existe el correo*/
                  if($resultado->rowCount()>0){
                      
                      
                          /*editamos el token*/
                          $sql="update usuarios set 

                             token=?
                             where
                             correo=?

                           ";

                           $resultado=$this->db->prepare($sql);

                           $resultado->bindValue(1,$token);
                           $resultado->bindValue(2,$correo);

                             if(!$resultado->execute()){

                                  echo "<h2 class='text-center' style='color:red'>Fallo en la consulta</h2>";
                                  
                            
                             } else {
                                 
                                  /*COMENZAR - enviamos el correo*/
                                  /*IMPORTANTE: CUANDO VAYAS A SUBIR EL PROYECTO AL HOSTING PONER EL NOMBRE DEL DOMINIO DEL HOSTING EN EL href del ancla href='http://tudominio.com/ que se encuentra en $cuerpo*/

                                    $to         = $correo;
                                    $asunto   = "Proyecto ECOMMERCE, resetear password";
                                    $cuerpo       = "
                                    
                                        <html> 
                                        <head> 
                                        <title></title> 
                                        </head> 
                                        <body> 
                                        
                                        <h1 style='color:black'>PROYECTO ECOMMERCE</h1>
                                    
                                        <p>Por favor dar click en el link para resetear el password
                                    
                                         <a href='http://webytools.co/resetear.php?correo=".$correo."&token=".$token."'> 
                                         http://webytools.co/resetear.php?correo=".$correo."&token=".$token."</a>
                                    
                                    
                                         </p>
                                    
                                        </body> 
                                        </html> 
                                   
                                   ";
                                   
                                       //para el envío en formato HTML 
                                       $cabeceras = "MIME-Version: 1.0\r\n";
                                       /* $cabeceras .= 'From: Your name <moraoscar124@gmail.com>' . "\r\n"; */
                                       $cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

                                        /*validando el envio del correo*/
                                         if(mail($to,$asunto,$cuerpo,$cabeceras)){
                                             
                                            $correo_enviado = true;

                                            echo "<h2 class='text-center' style='color:green'>Se ha enviado un correo, por favor dar click en el link para resetear el password</h2>"; 
                                             
                                            exit();
                                 
                                         }else {

                                            echo "<h2 class='text-center' style='color:red'>No se envió el correo</h2>";  
                                         }  
  
                                     /*FIN - enviamos el correo*/
                                 
                             }
                      
                  
                  }else{
                     /*no existe el correo en la bd*/
                      echo "<h2 class='text-center' style='color:red'>El correo ingresado no existe en la base de datos</h2>";
                  }
             }
          
        }
          
      
      
  }

?>