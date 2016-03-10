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

function Agregar(id_producto) {

    $id_producto = id_producto;
    $base = $("#base").val();
    $cantidad = $("#cantidad").val();


    $.ajax({
        dataType: "json",
        data: {
            "id_producto": $id_producto,
            "cantidad": $cantidad
        },
        url: "" + $base + "index.php/Trx_pro/trx_carro_agr",
        type: 'post',
        beforeSend: function () {
            //Lo que se haceestan  antes de enviar el formulario
            //$("#razon_social").html("Cargando...");
        },
        success: function (respuesta) {
            //lo que se si el destino devuelve algo
            if (!respuesta.resp) {
                bootbox.alert(respuesta.mensaje);
            } else {

                bootbox.alert(respuesta.mensaje, function () {

                    $('#total_item').html(respuesta.total_item);

                    bootbox.hideAll();
                    //window.location.reload(true);
                });
            }
            //window.location.reload(true);
        },
        error: function (xhr, err) {
            bootbox.alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
        }

    });


}


function aumentar() { //aumentar cantidad

    $('#cantidad').val(parseInt($('#cantidad').val()) + 1);
}

function disminuir() { //disminuye cantidad

    if (parseInt($('#cantidad').val()) > 1) {
        $('#cantidad').val(parseInt($('#cantidad').val()) - 1);
    }
}


function eliminar(id, cantidad) {
    bootbox.confirm("¿Desea eliminar del carrito?", function (result) {
        if (result) {
            actualizar_carro(id, cantidad);
            true;
        }
    });
}

function calculo(id) {

    str = '#cant' + id;
    original = '#original' + id;
    consulta = true;

    if ($(str).val() == '') {
        consulta = false;
    } else if ($(str).val() < 0) {
        consulta = false;
    } else if ($(str).val() == 0) {
        consulta = false;
    } else if ($(original).val() == $(str).val()) {
        consulta = false;
    }
    if (consulta == true) {
        actualizar_carro(id, $(str).val());
    }
    return consulta;
}


function actualizar_carro(id, cantidad) {
    $base = $("#base").val();
    $id = id;
    $cantidad = cantidad;
    $.ajax({
        dataType: "json",
        data: {
            "id": $id,
            "cantidad": $cantidad
        },
        url: "" + $base + "index.php/Trx_pro/actualizar_carro",
        type: 'post',
        beforeSend: function () {
            //Lo que se haceestan  antes de enviar el formulario
            //$("#razon_social").html("Cargando...");
        },
        success: function (respuesta) {
            //lo que se si el destino devuelve algo
            if (!respuesta.resp) {
                bootbox.alert(respuesta.mensaje);
            } else {

                bootbox.alert(respuesta.mensaje, function () {
                    window.location.reload(true);
                });
            }
            //window.location.reload(true);
        },
        error: function (xhr, err) {
            bootbox.alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
        }
    });

}

function inicio_sesion() {
    
    $base = $('#base').val();
    // var tmpDate = new Date();
    // var numero_cotizacion = tmpDate.getTime();
    var box = bootbox.dialog({
        title: "Elige una opcion",
        message:"<div class='container'>"+
                "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<button type='button' onclick='mostrar_login()' class='btn btn-primary'>INICIAR SESION</button>"+
                "</div>"+
                "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 col-xs-offset-6 col-sm-offset-4 col-md-offset-3 col-lg-offset-2'>"+
                "<a href='"+$base+"/index.php/login'  class='btn btn-primary'>REGISTRATE</a>"+
                "</div>"+
                "<div id='login' style='display: none;margin-top:100px;'>"+
                "<div class='col-lg-4 col-md-5 col-sm-5 col-xs-6 col-xs-offset-3 col-sm-offset-2 col-lg-offset-1 col-md-offset-1'>"+
                "<div class='login-form'>"+
                "<form>"+
                "<input type='text' class='form-control' name='email' placeholder='Email' />"+
                "<input type='password' name='password' placeholder='Contraseña' />"+
                "<button type='submit' class='btn btn-primary'>Inicio sesion</button>"+
                "</form>"+
                "</div>"+ //login-form
                "</div>"+//col-lg-1
                "</div>"+//login
                "</div>"//container
    });
    box.modal('show');
}