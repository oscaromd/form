<?php
require_once('vista.html'); // Cargamos la vista HTML

$dpi = preg_replace('/\D/', '', '222222222222222222aaa');
        $telefono = preg_replace('/\D/', '', 'aaaaaaaaa00002');
        echo md5($dpi);
        echo md5($telefono);

        
?>