<?php
function cambiarNombre($viejo,$nuevo,$ruta){
    shell_exec("mv $ruta/$viejo $ruta/$nuevo");
    echo 'el nombre fue cambiado de $ruta/$viejo a ';
}

#Funcion para cambiar los propietarios
function cambiarPropietario($ruta,$nombreDocumento,$nuevoPropietario){
    shell_exec("sudo chown $nuevoPropietario $ruta/$nombreDocumento");
}

#Función para cambiar los permisos
function cambiarPermisos($ruta,$nombreDocumento,$nuevosPermisos){
    shell_exec("sudo chmod $nuevosPermisos $ruta/$nombreDocumento");
}

$nuevo = $_POST['nuevo_nombre'];
$viejo = $_POST['nombre_viejo'];
$ruta = $_POST['ruta'];
$tipo = $_POST['tipo'];

if($tipo == 'Cambiar_Nombre'){
    cambiarNombre($viejo,$nuevo, $ruta);
}
?>