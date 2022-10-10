$(document).ready(function(){

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change",function(){
    	var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
              	alert("No selecciono foto");
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
    	$('#foto').val('');
    	$(".delPhoto").addClass('notBlock');
    	$("#img").remove();

        if($("#foto_actual") && $("#foto_remove")){
            $("#foto_remove").val('img_producto.png');
        }

    })

    $('#search_categoria').change(function(e){
        e.preventDefault();

        var sistema = getUrl();
        location.href = sistema + 'buscar_productos.php?categoria='+$(this).val();       
    });

    //Activa campos para registrar clientes
    $('.btn_new_cliente').click(function(e){
        e.preventDefault();
        $('#tipo_documento').removeAttr('disabled');
        $('#nom_cliente').removeAttr('disabled');
        $('#correo_cliente').removeAttr('disabled');
        $('#tel_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');

        $('#div_registro_cliente').slideDown();
    });

    //Buscar cliente
    $('#numero_cliente').keyup(function(e){
        e.preventDefault();

        var cl = $(this).val();
        var action = 'searchCliente';

        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data:{action:action,cliente:cl},

            success: function(response)
            {
                if(response == 0){
                    $('#idcliente').val('');
                    $('#tipo_documento').val('');
                    $('#nom_cliente').val('');
                    $('#correo_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    //Mostrar boton agregar
                    $('.btn_new_cliente').slideDown();
                }else{
                    var data = $.parseJSON(response);
                    $('#idcliente').val(data.id_cliente);
                    $('#tipo_documento').val(data.cedula);
                    $('#nom_cliente').val(data.nombre);
                    $('#correo_cliente').val(data.correo);
                    $('#tel_cliente').val(data.telefono);
                    $('#dir_cliente').val(data.direccion);
                    //Ocultar boton agregar
                    $('.btn_new_cliente').slideUp();

                    //Bloque campos
                    $('#tipo_documento').attr('disabled','disabled');
                    $('#nom_cliente').attr('disabled','disabled');
                    $('#correo_cliente').attr('disabled','disabled');
                    $('#tel_cliente').attr('disabled','disabled');
                    $('#dir_cliente').attr('disabled','disabled');

                    //Ocultar boton guardar
                    $('#div_registro_cliente').slideUp();
                }
            },
            error: function(error){
            }
        });
    });

    //Crear cliente - Ventas
    $('#form_new_cliente_venta').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data:$('#form_new_cliente_venta').serialize(),

            success: function(response)
            {
                if(response != 'error'){
                    //Agregar id a input hidden
                    $('#idcliente').val(response);
                    //Bloque campos
                    $('#tipo_documento').attr('disabled','disabled');
                    $('#nom_cliente').attr('disabled','disabled');
                    $('#correo_cliente').attr('disabled','disabled');
                    $('#tel_cliente').attr('disabled','disabled');
                    $('#dir_cliente').attr('disabled','disabled');

                    //Oculat boton agregar
                    $('.btn_new_cliente').slideUp();
                    //Oculta boton guardar
                    $('#div_registro_cliente').slideUp();
                }
            },
            error: function(error){
            }
        });
    });

    //Activa campos para registrar producto
    $('.btn_new_producto').click(function(e){
        e.preventDefault();
        $('#categoria').removeAttr('disabled');
        $('#nombre').removeAttr('disabled');
        $('#nom_producto').removeAttr('disabled');
        $('#desc_producto').removeAttr('disabled');
        $('#precio_producto').removeAttr('disabled');
        $('#cant_producto').removeAttr('disabled');

        $('#div_registro_producto').slideDown();
    });

    //Buscar producto
    $('#nom_producto').keyup(function(e){
        e.preventDefault();

        var p = $(this).val();
        var action = 'searchProducto';

        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data:{action:action,producto:p},

            success: function(response)
            {
                if(response == 0){
                    $('#idproducto').val('');
                    $('#categoria').val('');
                    $('#nombre').val('');
                    $('#desc_producto').val('');
                    $('#precio_producto').val('');
                    $('#cant_producto').val('');

                    //Bloquear cantidad
                    $('#cant_producto').attr('disabled','disabled');

                    //Mostrar boton agregar
                    $('.btn_new_producto').slideDown();
                    $('#btn_agregar').slideUp();
                }else{
                    var data = $.parseJSON(response);
                    $('#idproducto').val(data.id_prod);
                    $('#categoria').val(data.id_categoria);
                    $('#nombre').val(data.id_proveedor);
                    $('#desc_producto').val(data.desc_prod);
                    $('#precio_producto').val(data.precio);
                    $('#cant_producto').val(data.cantidad);
                    //Ocultar boton agregar
                    $('.btn_new_producto').slideUp();
                    $('#btn_agregar').slideDown();

                    //Bloque campos
                    $('#categoria').attr('disabled','disabled');
                    $('#nombre').attr('disabled','disabled');
                    $('#desc_producto').attr('disabled','disabled');
                    $('#precio_producto').attr('disabled','disabled');
                    $('#cant_producto').attr('disabled','disabled');

                    //Activar cantidad
                    $('#cant_producto').removeAttr('disabled');

                    //Ocultar boton guardar
                    $('#div_registro_producto').slideUp();
                }
            },
            error: function(error){
            }
        });
    });

    //Crear producto - Ventas
    $('#form_new_producto_venta').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data:$('#form_new_producto_venta').serialize(),

            success: function(response)
            {
                if(response != 'error'){
                    //Agregar id a input hidden
                    $('#idproducto').val(response);
                    //Bloque campos
                    $('#categoria').attr('disabled','disabled');
                    $('#nombre').attr('disabled','disabled');
                    $('#desc_producto').attr('disabled','disabled');
                    $('#precio_producto').attr('disabled','disabled');
                    $('#cant_producto').attr('disabled','disabled');

                    //Oculta boton agregar
                    $('.btn_new_producto').slideUp();
                    //Oculta boton guardar y agregar
                    $('#div_registro_cliente').slideUp();
                    $('#btn_agregar').slideUp();
                }
            },
            error: function(error){
            }
        });
    });

    //Crear producto - Ventas
    $('#form_new_producto_venta').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data:$('#form_new_producto_venta').serialize(),

            success: function(response)
            {
                if(response != 'error'){
                    //Agregar id a input hidden
                    $('#idproducto').val(response);
                    //Bloque campos
                    $('#categoria').attr('disabled','disabled');
                    $('#nombre').attr('disabled','disabled');
                    $('#desc_producto').attr('disabled','disabled');
                    $('#precio_producto').attr('disabled','disabled');
                    $('#cant_producto').attr('disabled','disabled');

                    //Oculta boton agregar
                    $('.btn_new_producto').slideUp();
                    //Oculta boton guardar y agregar
                    $('#div_registro_cliente').slideUp();
                }
            },
            error: function(error){
            }
        });
    });

});//End Ready

function getUrl(){
    var loc = window.location;
    var pathName = loc.pathname.substring(0,loc.pathname.lastIndexOf('/') +1);
    return loc.href.substring(0,loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}
