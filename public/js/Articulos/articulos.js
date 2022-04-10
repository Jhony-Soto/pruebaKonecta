let ARTICULOS;
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
$(document).ready(()=>{
    var tablaArticulos;

    $('.select2').select2({ width: 'resolve' });
    
    getDataCatgoria();

    table_articulos()



    // FUNCION  PARA CARGAR EL SELECT DE CATEGORIAS Y LA DATATABLE DE ARTICULOS Y CATEGORIAS
    function getDataCatgoria(){
        $.ajax({
            method:'POST',
            url:url+'Articulos/getCategorias',
            success:function(res){
                var res=JSON.parse(res);
                cargarSelec_tablaCategoria(res.data);
            }
        });
    }

    function cargarSelec_tablaCategoria(data){
        data.forEach(categoria => {
            $('.categoria').append('<option value='+categoria.id+'>'+categoria.nombre_categoria+'</option>');
        });



    }
    

    // Limpia el form de tipo ingreso
    $('#btnCancelEdit').on('click',function(){
        $('#form_articulos')[0].reset()
        $('#form_articulos input').each(function(){
            $(this).removeClass('is-valid')
            $(this).removeClass('is-invalid')
        })
        $('#btnSaveArticulo').removeClass('d-none').prop('type','submit');
        $('#btnEditArticulo').addClass('d-none').prop('type','button');
        $('#btnCancelEdit').addClass('d-none')
        
    })
    
    // GUARDAR ARTICULO
    $('#form_articulos').on("submit",function(e){
        e.preventDefault();
    
        if($('input[name=nombre_articulo]').val().trim()=='' ){ return $('input[name=nombre_articulo]').addClass('is-invalid')}else{ $('input[name=nombre_articulo]').removeClass('is-invalid')}
        if($('input[name=referencia_articulo]').val().trim()=='' ){ return $('input[name=referencia_articulo]').addClass('is-invalid')}else{$('input[name=referencia_articulo]').removeClass('is-invalid')}
        if($('input[name=precio_articulo]').val().trim()=='' ) {return $('input[name=precio_articulo]').addClass('is-invalid')}else{$('input[name=precio_articulo]').removeClass('is-invalid')}
        if($('input[name=peso_articulo]').val().trim()=='' ){ return $('input[name=peso_articulo]').addClass('is-invalid')}else{$('input[name=peso_articulo]').removeClass('is-invalid')}
        if($('select[name=categoria]').val().trim()=='' ) {return $('input[name=categoria]').addClass('is-invalid')}else{$('input[name=categoria]').removeClass('is-invalid')}
        if($('input[name=stock_articulo]').val().trim()=='' ){ return $('input[name=stock_articulo]').addClass('is-invalid')}else{$('input[name=stock_articulo]').removeClass('is-invalid')}

   
    
        var data=new FormData(document.getElementById('form_articulos'));
        var metodo=($('input[name=id_articulo]').val().trim()=='' ? 'saveArticulo' : 'update')

        sendData(data,'/Articulos/'+metodo).then(response=>{
            $('#btnCancelEdit').click()
            $('#articulos').DataTable().ajax.reload()
        })  
        
    })


    //EDITAR Y GUARDAR UN ARTICULO
    //al hacer click en cambiar imagen hace visible el input file 
    $('#cambiar_img').on('click',(e)=>{
        e.preventDefault();
        $('#imagen_edit').removeClass('d-none');
    })

    //Guardar nueva inforamacion del articulo
    $('#actualizar').on('click',(e)=>{
        e.preventDefault();
        var data=new FormData(document.getElementById('form_edit'));

        $.ajax({
            url:url+'Articulos/update',
            type:'POST',
            data:data,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#modalArticulos').modal('hide');
                $('#mensaje').text('Estamos guardando los datos...');
                $('#myModal').modal('show');
            },
            success:function(res){
                var data=JSON.parse(res);
                setTimeout(()=>{

                    if(data.status==200){
                        $('#myModal').modal('hide');
                        $('#modalArticulos').modal('hide');
                        $("#form_edit")[0].reset();
                        $('#imagen_edit').addClass('d-none');
                        tablaArticulos.ajax.reload();
                        alertify.success(data.message);
                    }else{
                        alertify.error(data.message);
                    }

                },1000)
            }
        });
    })


    //Eliminar articulo
    $('#btn-delete').on('click',()=>{
        $.ajax({
            url:url+'Articulos/delete',
            type:'POST',
            beforeSend:function(){
                $('#deleteArticulo').modal('hide');
                $('#mensaje').text('Estamos Eliminado el registro...');
                $('#myModal').modal('show');
            },
            data:{codigo:$('#cod_delete').val()},
            success:function(res){
                var data=JSON.parse(res);
                setTimeout(()=>{
                    
                    if(data.status==200){
                        $('#myModal').modal('hide');
                        $('#deleteArticulo').modal('hide');
                        tablaArticulos.ajax.reload();
                        alertify.success(data.message);
                    }else{
                        alertify.error(data.message);
                    }
                },1000)
            }
        });
        
    })
 

})

const table_articulos=function(){
    var table = $('#articulos');

    table.DataTable({
        destroy: true,
        responsive: true,
        info: false,
        lengthChange: false,
        ajax: {
            url: url + '/Articulos/getArticulos',
            type: 'POST',
            dataSrc:function(rs){
                ARTICULOS=rs.data
                return rs.data
            },
        },
        language:idioma,
        columns: [ 
            {"data":'nombre_producto'},
            {"data":'referencia'},
            {"data":'precio'}, 
            {"data":'peso'},
            {"data":'categoria'},
            {"data":'stock'},
            {data: null,
                target:-1,
                width: '30px',
                orderable: false,
                className: 'dt-center',
                render: function(data, type, full,row, meta) {
                    var btnsAccion='<div class="d-flex align-items-center">'
                    btnsAccion+=`<a href="javascript:;" class="btn btn-sm btn-secondary" data-accion="editArticulos" data-bind="${full.id}" onclick="accionesArticulos(this)" data-toggle="tooltip" title="Editar">
                                    Editar
                                </a>`
                
                    btnsAccion+=`<a href="javascript:;" class="btn btn-sm btn-danger" data-accion="deletArticulos" data-bind="${full.id}"   onclick="accionesArticulos(this)" data-toggle="tooltip" title="Eliminar">
                                    Eliminar
                                </a>`
                    btnsAccion+='</div>'

                    return btnsAccion
                    
                },
            },
        ],
        
    });
}

const accionesArticulos=(button)=>{
    var id=$(button).data('bind')
    var accion=$(button).data('accion')

    if(accion=='editArticulos'){
        var art=ARTICULOS.find(ele=>ele.id==id)

        $('#form_articulos input[name="id_articulo"]').val(id)
        $('#form_articulos input[name="nombre_articulo"]').val(art.nombre_producto)
        $('#form_articulos input[name="referencia_articulo"]').val(art.referencia)
        $('#form_articulos input[name="precio_articulo"]').val(art.precio)
        $('#form_articulos input[name="peso_articulo"]').val(art.peso)
        $('#form_articulos select[name="categoria"]').val(art.id_categoria).change()
        $('#form_articulos input[name="stock_articulo"]').val(art.stock)

        $('#btnSaveArticulo').addClass('d-none').prop('type','button');
        $('#btnEditArticulo').removeClass('d-none').prop('type','submit');
        $('#btnCancelEdit').removeClass('d-none')
    }


    if(accion=='deletArticulos'){
        var data=new FormData()
        data.append('id_articulo',id)
        sendData(data,'/articulos/delete').then(response=>{
            $('#articulos').DataTable().ajax.reload()
        })
    }
}

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