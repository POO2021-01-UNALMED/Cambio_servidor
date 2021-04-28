<?php  
    function eliminarArchivo($archivo,$ruta){
        shell_exec("rm $ruta/$archivo");
        echo 'Archivo eliminado';
    }

    function eliminarDirectorio($directorio,$ruta){
        shell_exec("rm -R $ruta/$directorio");
        echo 'Directorio eliminado';
    }


    $elemento = $_POST['elemento'];
    $tipo = $_POST['tipo'];
    $ruta = $_POST['ruta'];
    if($tipo=='carpeta'){
        eliminarDirectorio($elemento,$ruta);
    }elseif($tipo=='archivo'){
        eliminarArchivo($elemento, $ruta);
    }
    
?>