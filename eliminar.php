<?php  
    function eliminarArchivo($archivo,$ruta){
        shell_exec("rm $ruta/$archivo");
        echo 'Archivo eliminado';
    }
    $elemento = $_POST['elemento'];
    $ruta = $_POST['ruta'];
    eliminarArchivo($elemento, $ruta);
?>