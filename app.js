$(function(){
     //Inicializá el tablero
    var ruta = $('#rutaID').text()
    $('#ruta').attr('value',ruta)
    console.log(ruta)
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
    function reloadApp(ruta='raiz'){
        $.post('jsondir.php', {ruta}, (response) => {
            if(!response.error){
                let arcDir = JSON.parse(response);
                console.log('Extración de archivos fue un éxito');
                let template = ''
                arcDir.forEach(elem =>{
                    template += ` <tr nombreID="${elem.name+"/"+elem.tipo}"> 
                                        <td>${elem.name}</td>
                                        <td>${elem.propietario}</td>
                                        <td>${elem.permiso}</td>
                                        <td>${elem.tipo}</td>
                                        <td>
                                            <button class="elem-delete btn btn-danger" title="eliminar"><i class="fas fa-trash-alt"></i></button>
                                            <button class="elem-edit btn btn-success" title="editar" type="submit"><i class="far fa-edit"></i></button>
                                            <button class="elem-perm btn btn-info" title="permisos" type="submit"><i class="far fa-user"></i></button>
                                            <button class="elem-info btn btn-warning" title="informacion" type="submit"><i class="fas fa-question-circle"></i></button>
                                            <input class="seleccionar ml-4" type="checkbox" name="checkbox" id="checkbox"/>
                                        </td>          
                                    </tr>`
                });
                $('#idRenderElem').html(template)
            }
        })
    }

    //Eliminar un documento
    $(document).on('click', '.elem-delete', (e)=>{
        if(confirm('¿Estas seguro que quieres eliminarlo?')){
            let element = $(this)[0].activeElement.parentElement.parentElement;
            const value = $(element).attr('nombreID').split('/');
            const nombre = value[0]
            const tipo = value[1]

            console.log(nombre, tipo);
            var ruta = $('#rutaID').text();
             let postData ={
                elemento:nombre,
                ruta:ruta,
                tipo: tipo,
            }
            $.post('eliminar.php', postData,(response)=>{
                if(!response.error){
                    console.log(response)
                    location.reload()
                }
            })
            
        }
    })
    
    //Cambio de nombre al elemento, tiene un problema
    $(document).on('click', '.elem-edit', (e)=>{
        let element = $(this)[0].activeElement.parentElement.parentElement;
        const nombre = $(element).attr('nombreID').slipt('/')[0];
        ruta = $('#rutaID').text();

        $('#modalEdit').modal('toggle');

        $('#formEditId').submit(e => {
            e.preventDefault();
            let nuevo_nombre = $('#NuevoNombre').val();
            if(nuevo_nombre=!null){
                const postData = {
                    nuevo_nombre : nuevo_nombre,
                    nombre_viejo : nombre,
                    ruta : ruta,
                    tipo: 'Cambiar_Nombre'
                };

                console.log(ruta,nombre, $('#NuevoNombre').val())
                $('#formEditId').trigger('reset');
                $.post('cambiar.php', postData, (response)=>{
                    $('#formEditId').trigger('reset');
                    console.log('response')
                    location.reload();
                })
            }
            
        })
        
    })
    
    
})
