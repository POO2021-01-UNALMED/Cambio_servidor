$(function(){
     //Inicializá el tablero
    var ruta = $('#rutaID').text()
    //console.log(ruta)
    reloadApp(ruta)

    //Se crean los documentos
    $('#crearArchivos').submit(e => {
        ruta = $('#rutaID').text()
        e.preventDefault();
        const postData = {
            ruta : $('#ruta').val(),
            name : $('#nombre').val(),
            tipo : $('#tipo').val()
        };
        $.post('crear.php', postData, (response)=>{
            $('#crearArchivos').trigger('reset');
            console.log(response)
            reloadApp(ruta);
            
        })
    })
   
    //Se extrae los documentos
    function reloadApp(ruta){
        $.post('jssondir.php', {ruta}, (response) => {
            if(!response.error){
                let arcDir = JSON.parse(response);
                let template = '';
                console.log(arcDir)
            }
        })
    }

    //Eliminar un documento
    $(document).on('click', '.elem-delete', (e)=>{
        if(confirm('¿Estas seguro que quieres eliminarlo?')){
            let element = $(this)[0].activeElement.parentElement.parentElement;
            const nombre = $(element).attr('nombreID');
            var ruta = $('#rutaID').text();
            let postData ={
                elemento:nombre,
                ruta:ruta
            }
            $.post('eliminar.php', postData,(response)=>{
                if(!response.error){
                    console.log(response)
                }
            })
        }
    })
    
    //Cambio de nombre al elemento, tiene un problema
    $(document).on('click', '.elem-edit', (e)=>{
        let element = $(this)[0].activeElement.parentElement.parentElement;
        const nombre = $(element).attr('nombreID');
        ruta = $('#rutaID').text();
        console.log(ruta,nombre);
        $('#modalEdit').modal('toggle');

        $('#formEditId').submit(e => {
            e.preventDefault();
            const postData = {
                nuevo_nombre : $('#NuevoNombre').val(),
                nombre_viejo : nombre,
                ruta : ruta,
                tipo: 'Cambiar_Nombre'
            };
            $.post('cambiar.php', postData, (response)=>{
                $('#formEditId').trigger('reset');
                console.log(response)
                reloadApp();
            })
        })
        
    })
    
    
})
