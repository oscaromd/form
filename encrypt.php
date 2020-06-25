<?php
function Encriptar($strxd){  /// Encripta datos con la clave establecida abajo.
    $ciphering = "AES-128-CTR"; 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    $encryption_iv = '0111110000111111'; 
    $encryption_key = "00111111x01011111x00111111"; 
      
    $encryption = openssl_encrypt($strxd, $ciphering, 
                $encryption_key, $options, $encryption_iv); 
    
    return $encryption;          
      }      

header("Location: index.php");
?>