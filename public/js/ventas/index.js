var ARTICULOSDB;
var arrayArticulos=[];

$(document).ready(()=>{
    $('.selectProducto').select2();

    getArticulos()
    

    $('.selectProducto').on('change',function(){
        var res=ARTICULOSDB.find(art=>art.id==$(this).val())  
        $('input[name=stock]').val(res.stock)
    })

    //SUBMIT DEL FORMUALIO COMPRA
    $('#compra').on('submit',(e)=>{
        e.preventDefault();

        var pro=ARTICULOSDB.find(ele=>ele.id==$('select[name=producto]').val())

        if(parseInt(pro.stock)<parseInt($('input[name=cantidad]').val()) ){
            alertify.error('La cantidad excede la existencia en stock')
            return
        }

    
        var object={
                        id:$('.selectProducto').val(),
                        nombre:$('.selectProducto[name="producto"] option:selected').text(),
                        cantidad:$('#cantidad').val(),
                        precio:pro.precio,
                        existencia:pro.stock
                    }

        var res=ARTICULOSDB.find(art=>art.id==pro.id)   
        res.stock-=object.cantidad
        arrayArticulos.push(object);
                    console.log(arrayArticulos);
                    
        $('#tabla_compra tbody tr').remove();
        var fila='';
        arrayArticulos.forEach(item=>{
            fila='';
            fila+='<tr>';
            fila+=`<td id="numero"><input type="text" name="cod_producto[]"class="form-control" value="${item.nombre}"></td>`;
            fila+=`<td id="numero"><input type="number" name="cod_producto[]"class="form-control" value="${item.cantidad}"></td>`;
            fila+=`<td id="numero"><input type="number" name="cod_producto[]"class="form-control" value="${item.precio}"></td>`;
            fila+=`<td class="text-success">${item.cantidad * item.precio}</td>`;
            fila+=`</tr>`
            $('#tbody').append(fila);
        })

        var total=0
        arrayArticulos.forEach(item=>{
            total+=(item.cantidad*item.precio)
        })

        var fila='<tr>';
        fila+=`<td colspan="3">TOTAL A PAGAR</td>`;
        fila+=`<td>${total}</td>`;
        fila+=`</tr>`

        $('#tbody').append(fila);    
        $('.selectProducto').change()     
    })


    //borra fila de la tabla
    $('.limpiarTabla').on('click',(e)=>{
        e.preventDefault();
        $('#tabla_compra tbody tr').remove();

        arrayArticulos.forEach(item=>{
            var res=ARTICULOSDB.find(art=>art.id==item.id)  
            res.stock=parseInt(res.stock)+parseInt(item.cantidad) 
        })
        arrayArticulos=[]
        $('.selectProducto').change()    
    })

    //GENERAR COMPRA
    $('#comprar').on('click',()=>{

        var data=new FormData()
        data.append('compra',JSON.stringify(arrayArticulos))
        sendData(data,'/ventas/generate_venta').then(res=>{
            getArticulos()
            $('.limpiarTabla').click()
        })
        
    });
})

//Obtenenos los articulos 
const getArticulos=function(){
    $.ajax({
        type:"POST",
        url:url+"Articulos/getArticulos",
        cache:false,
        success:function(r){
            var datos=JSON.parse(r);
            ARTICULOSDB=datos.data
            $('.selectProducto').empty();
            ARTICULOSDB.forEach(art => {
                $('.selectProducto').append('<option value='+art.id+'>'+art.nombre_producto+'</option>');
            });
            getTops()
        }   
    });

}

const getTops=function(){
    $.ajax({
        type:"POST",
        url:url+"ventas/getTops",
        cache:false,
        success:function(r){
            var data=JSON.parse(r)
            $('#topVenta,topStock').empty()

            // top venta
            var pro=ARTICULOSDB.find(ele=>ele.id==data.top_venta[0].id_producto)
            $('#topVenta').html(`<h5 class="card-title">${pro.nombre_producto} </h5> <p class="card-text">El producto mas vendido, ${data.top_venta[0].ventas} ventas en total</p>`)

            $('#topStock').html(`<h5 class="card-title">${data.topStock[0].nombre_producto}</h5><p class="card-text">Producto con mas STOCK , ${data.topStock[0].stock} en total</p>`)
        }   
    });

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