let idioma={
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
}

let CATEGORIAS;

$(document).ready(function(){
    $('#form_save_categoria').on('submit',function(e){
        e.preventDefault()

        if($('#form_save_categoria input[name=name_categoria]').val().trim()=='') return $('#form_save_categoria input[name=name_categoria]').addClass('is-invalid')
            
        var data=new FormData(document.getElementById('form_save_categoria'))
        var metodo= ($('#form_save_categoria input[name=id_categoria]').val().trim()=='' ? 'saveCategoria' :'editCategoria')

        sendData(data,'/categoria/'+metodo).then(response=>{
            $('#btnCancelEdit').click()
            $('#table_categoria').DataTable().ajax.reload()
        })
    

    })


    // Limpia el form de tipo ingreso
    $('#btnCancelEdit').on('click',function(){
        $('#form_save_categoria')[0].reset()
        $('#form_save_categoria input').each(function(){
            $(this).removeClass('is-valid')
            $(this).removeClass('is-invalid')
        })
        $('#btnSaveCategoria').removeClass('d-none').prop('type','submit');
        $('#btnEditCategoria').addClass('d-none').prop('type','button');
        $('#btnCancelEdit').addClass('d-none')
        
    })

    table_categorias()
})


    // [data] formData a enviar
    // [ur] direccion a donde hacer la peticion
    const sendData=(data,urlController)=>{
        return new Promise((resolve,reject)=>{
            $.ajax({
                type: "POST",
                url:url+urlController,
                data: data,
                contentType: false,
                processData: false,
                success: function (res) {
                    resolve(res)
                },
                error: function(errorThrown) { 
                    alert("Error: " + errorThrown); 
                }
            });
            
        })
    }


const table_categorias=function(){
    var table = $('#table_categoria');

    table.DataTable({
        destroy: true,
        responsive: true,
        info: false,
        lengthChange: false,
        ajax: {
            url: url + '/categoria/getCategorias',
            type: 'POST',
            data: {
                tabla:'tipo_ingreso_GH',
            },
            dataSrc:function(rs){
                CATEGORIAS=rs.data
                return rs.data
            },
        },
        language:idioma,
        columns: [ 
            {data: 'id'},
            {data: 'nombre_categoria'},
            {data: null,
                target:-1,
                width: '30px',
                orderable: false,
                className: 'dt-center',
                render: function(data, type, full,row, meta) {
                    var btnsAccion='<div class="d-flex align-items-center">'
                    btnsAccion+=`<a href="javascript:;" class="btn btn-sm btn-secondary" data-accion="editCategoria" data-bind="${full.id}" onclick="accionesCategoria(this)" data-toggle="tooltip" title="Editar">
                                    Editar
                                </a>`
                
                    btnsAccion+=`<a href="javascript:;" class="btn btn-sm btn-danger" data-accion="deletCategoria" data-bind="${full.id}"   onclick="accionesCategoria(this)" data-toggle="tooltip" title="Eliminar">
                                    Eliminar
                                </a>`
                    btnsAccion+='</div>'

                    return btnsAccion
                    
                },
            },
        ],
    });
}

const accionesCategoria=(button)=>{
    var id=$(button).data('bind')
    var accion=$(button).data('accion')

    if(accion=='editCategoria'){
        var cate=CATEGORIAS.find(ele=>ele.id==id)

        $('#form_save_categoria input[name="id_categoria"]').val(id)
        $('#form_save_categoria input[name="name_categoria"]').val(cate.nombre_categoria)

        $('#btnSaveCategoria').addClass('d-none').prop('type','button');
        $('#btnEditCategoria').removeClass('d-none').prop('type','submit');
        $('#btnCancelEdit').removeClass('d-none')
    }


    if(accion=='deletCategoria'){
        var data=new FormData()
        data.append('id_categoria',id)
        sendData(data,'/categoria/delete_categoria').then(response=>{
            $('#table_categoria').DataTable().ajax.reload()
        })
    }
}