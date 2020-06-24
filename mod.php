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

    public function insertar($nombre, $apellido, $dpi){
        $tabla = 'usr'; //Este es el nombre de la tabla
        $consulta="INSERT INTO $tabla (nombre, apellido, dpi) VALUES (:nombre, :apellido, :dpi);";

        /////////Hcemos un prepare envez de un insert directo para evitar posibles fallas de seguridad y SQLinjection
        $resultado=$this->db->prepare($consulta);

        ///////// Establecemos parametros para evitar que se añadan textos a la consulta sql original
        $resultado->bindParam(':nombre', $nombre);
        $resultado->bindParam(':apellido', $apellido);
        $resultado->bindParam(':dpi', $dpi);

        ///////// Ejecutamos
        $resultado->execute(); 
        if ($resultado) { 
            //////////// Si todo funciono:
            echo "Se registro el usuario satisfactorio"; //Mensaje test, se registro
        } else {
            //////////// Si nada funciono:
            echo "No se registro el usuario"; //Mensaje test, no se registro
         }
     }

}

function InsertData($nombre, $apellido, $dpi){  /// Ejecutamos Conexion y query del Insert
    $mod=new Modelo();
    $mod->insertar($nombre, $apellido, $dpi);
}

function VerificarDatos($nombre, $apellido, $dpi){
    if (isset($nombre) && isset($apellido) && isset($dpi) && strlen($dpi) == 13 ){ 
        // Todos los DPI tienen 13 Caracteres sin espacios

        /////////////Removemos numeros y caracteres que pueden ocasionar una SQLInjection
        $nombre = preg_replace('/[^\p{L}\s]/u', '', $nombre); 
        $apellido = preg_replace('/[^\p{L}\s]/u', '', $apellido);

        //////////////////////////// Removemos Cualquier cosa que no sea un numero, el DPI solo tiene numeros
        $dpi = preg_replace('/\D/', '', $dpi);

        ////////////////////////////// Ejecutamos la funcion SQL para insertar datos
        InsertData($nombre, $apellido, $dpi);
        

    }else{
       echo "No se registro el usuario"; //Mensaje test, no se registro
    }

    } 


////Esta funcion redirecciona si se intenta ingresar al archivo directamente
function Redi(){
    header("Location: index.php");
}

/////////// Verificaicones de inicio
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['dpi'])  ){
    VerificarDatos($_POST['nombre'],$_POST['apellido'], $_POST['dpi']);  //Hacemos las verificaciones
}else{
    Redi();
}


