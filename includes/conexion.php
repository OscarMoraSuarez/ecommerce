<?php


class Conectar {
    
    /*conexión a la base de datos*/
    public static function conexion(){


		 		try {

		 			$conectar = new PDO("mysql:local=localhost;dbname=tienda","root","");
				    
                     $conectar->query("SET NAMES 'utf8'");
                    
				     return $conectar;
		 			
		 		} catch (Exception $e) {

		 			print "¡Error!: " . $e->getMessage() . "<br/>";
		            die();  
		 			
		 		}
		 

		 } //cierre de llave de la function conexion()

    
}
    
    


      /*if(Conectar::conexion()){
          
          echo "conectado";
          
      } else{
          
          echo "error en la conexion";
      }*/

?>