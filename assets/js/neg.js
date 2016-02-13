function sub(idcat, idsub) {
//    $('div#resultado').remove();
    $categoria = idcat;
    $sub = idsub;
    $base = $('#base').val();

    $.ajax({
        dataType: "json",
        data: {
            "cat": $categoria,
            "sub": $sub
        },
        url: "" + $base + "index.php/Busqueda/carga_productos",
        type: 'post',
        beforeSend: function () {
            //Lo que se haceestan  antes de enviar el formulario
            //$("#razon_social").html("Cargando...");
        },
        success: function (respuesta) {
            //lo que se si el destino devuelve algo
            $('#recomendado').html(respuesta.categoria);
            $("#resultado").html(respuesta.productos);
            //window.location.reload(true);
        },
        error: function (xhr, err) {
            bootbox.alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
        }

    });
}


function DetalleProducto(id_producto) {
    $base = $("#base").val();
    $id_producto = id_producto;
    $(document).ready(function () {
        $.ajax({
            dataType: "json",
            data: {"id_producto": $id_producto},
            url: "" + $base + "index.php/Busqueda/detalle_producto",
            type: 'post',
            beforeSend: function () {
                //Lo que se haceestan  antes de enviar el formulario
                //$("#razon_social").html("Cargando...");
            },
            success: function (respuesta) {
                //lo que se si el destino devuelve algo
                var box = bootbox.dialog({
                    title: 'Detalle producto',
                    message: respuesta.detalle,
                    buttons: {
                        cancel: {
                            label: 'Cerrar',
                            className: 'btn-primary'
                        }
                    }
                });
                box.modal('show');

            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
            }
        });
    });

}

//function DetalleProducto(){
//    
//    
//    
//    bootbox.dialog({
//        title: "HOLA",
//        message:'<div class="container">' +
//                '<div class="product-details">' +
//                '<div class="col-lg-4 col-sm-4">' +
//                '<div class="view-product">' +
//                '<img src="<?php echo base_url() ?>assets/images/product-details/1.jpg" alt="" />' +
//                '</div>' +
//                '</div>' +
//                '<div class="col-lg-8 col-sm-8">' +
//                '<h2>Anne Klein Sleeveless Colorblock Scuba</h2>' +
//                '<p>Web ID: 1089772</p>' +
//                '<img src="<?php echo base_url() ?>assets/images/product-details/rating.png" alt="" />' +
//                '<span>' +
//                '<span>US $59</span>' +
//                '<label>Quantity:</label>' +
//                '<input type="text" size="4" class="">' +
//                '<button type="button" class="btn btn-success">' +
//                '<i class="fa fa-shopping-cart"></i>' +
//                'Agregar a carrito' +
//                '</button>' +
//                '</span>' +
//                '<p><b>Availability:</b> In Stock</p>' +
//                '<p><b>Condition:</b> New</p>' +
//                '<p><b>Brand:</b> E-SHOPPER</p>' +
//                '<a href=""><img src="<?php echo base_url() ?>assets/images/product-details/share.png" class="share img-responsive"  alt="" /></a>' +
//                '</div>' +
//                '</div>' +
//                '</div>' +
//                ''
//    });
//    
//}