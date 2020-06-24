<?php
        class Modelo{
            private $Modelo;
            private $db;
            public function __construct(){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "test";  
                $this->Modelo = array();
                $this->db=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            }
        
            public function insertar($nombre, $apellido, $dpi, $telefono){
                $tabla = 'usr'; //Este es el nombre de la tabla
                $consulta="INSERT INTO $tabla (nombre, apellido, dpi, telefono) VALUES (:nombre, :apellido, :dpi, :telefono);";
        
                /////////Hcemos un prepare envez de un insert directo para evitar posibles fallas de seguridad y SQLinjection
                $resultado=$this->db->prepare($consulta);
        
                ///////// Establecemos parametros para evitar que se añadan textos a la consulta sql original
                $resultado->bindParam(':nombre', $nombre);
                $resultado->bindParam(':apellido', $apellido);

                ///////////////////// Encriptacion md5 para datos sensibles
                $resultado->bindParam(':dpi', md5($dpi));
                $resultado->bindParam(':telefono', md5($telefono));
        
                ///////// Ejecutamos
                $resultado->execute(); 
                if ($resultado) { 
                    //////////// Si todo funciono:
                    var_dump(http_response_code(200)); ///Se registro Usuario
                } else {
                    //////////// Si nada funciono:
                    var_dump(http_response_code(512)); ///No se registro Usuario :(
                 }
             }
        
        }
        
////Esta funcion redirecciona si se intenta ingresar al archivo directamente
    header("Location: index.php");
?>