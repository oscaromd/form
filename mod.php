<?php
require_once('db.php'); 

function InsertData($nombre, $apellido, $dpi, $telefono){  /// Ejecutamos Conexion y query del Insert
    $mod=new Modelo();
    $mod->insertar($nombre, $apellido, $dpi, $telefono);
}

function VerificarDatos($nombre, $apellido, $dpi, $telefono){
    if (isset($nombre) && isset($apellido) && isset($dpi) && isset($telefono) ){ 

        /////////////Removemos numeros y caracteres que pueden ocasionar una SQLInjection
        $nombre = preg_replace('/[^\p{L}\s]/u', '', $nombre); 
        $apellido = preg_replace('/[^\p{L}\s]/u', '', $apellido);

        //////////////////////////// Removemos Cualquier cosa que no sea un numero, el DPI solo tiene numeros
        $dpi = preg_replace('/\D/', '', $dpi);
        $telefono = preg_replace('/\D/', '', $telefono);


        ////////////////////////////// Ejecutamos la funcion SQL para insertar datos
        InsertData($nombre, $apellido, $dpi, $telefono);
        

    }else{
        var_dump(http_response_code(404)); ///Ocurrio un error en el ingreso de datos
    }

    } 


////Esta funcion redirecciona si se intenta ingresar al archivo directamente
function Redi(){
    header("Location: index.php");
}

/////////// Verificaicones de inicio
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['dpi'])  && isset($_POST['telefono'])  ){
    VerificarDatos($_POST['nombre'],$_POST['apellido'], $_POST['dpi'], $_POST['telefono']);  //Hacemos las verificaciones
}else{
    Redi();
}

?>
