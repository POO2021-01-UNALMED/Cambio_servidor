<?php

#ejecuta el comando ls de linux y lo convierte en lista
function listar($ruta){
    $listaLinux = shell_exec("ls ".$ruta);
    echo $listaLinux;
    $lista=preg_split('/[\r\n]+/',$listaLinux);
    unset($lista[count($lista)-1]);

    
    $listaConTipo=array();

    #Se distingue si es u archivo o directorio para posteriormente almacenarlo en el
    #arreglo
    foreach($lista as $elemento){
        if(is_file("$ruta/$elemento")){
            $listaConTipo[$elemento]='archivo';
        }
        elseif(is_dir("$ruta/$elemento")){
            $listaConTipo[$elemento]='carpeta';
        }
        $propietario = shell_exec("stat -c %U controladores/$ruta/$elemento");
        $permisos = shell_exec("stat -c %a controladores/$ruta/$elemento");
        
        $listaConTipo[] = array(
            'propietario' => $propietario,
            'permisos'  => $permisos,
        );
        

    }

    $jsonstring = json_encode($listaConTipo);
    echo $jsonstring;
    #if(is_file("$ruta/$lista[0]")){
    #    return $lista;
    #}
    
}
$ruta = $_POST['ruta'];
listar($ruta)
?>