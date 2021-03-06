
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
        message: "<div class='container'>" +
                "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>" +
                "<button type='button' onclick='mostrar_login()' class='btn btn-primary'>INICIAR SESION</button>" +
                "</div>" + //col-lg-2
                "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 col-xs-offset-6 col-sm-offset-4 col-md-offset-3 col-lg-offset-2'>" +
                "<a href='" + $base + "index.php/login'  class='btn btn-primary'>REGISTRATE</a>" +
                "</div>" + //col-lg-2
                "<div id='login' style='display: none;margin-top:100px;'>" +
                "<div class='col-lg-4 col-md-5 col-sm-5 col-xs-6 col-xs-offset-3 col-sm-offset-2 col-lg-offset-1 col-md-offset-1'>" +
                "<div class='login-form'>" +
                "<form>" +
                "<input type='text' class='form-control' id='email' name='email' placeholder='Email' />" +
                "<input type='password' required name='password' id='password' placeholder='Contraseña' />" +
                "<button type='button' onclick='inicio_sesion_carrito()' class='btn btn-primary'>Inicio sesion</button>" +
                "</form>" +
                "</div>" + //login-form
                "</div>" + //col-lg-1
                "</div>" + //id=login
                "</div>" + //container
                "<div class='container'>" +
                "<div class='row' id='mensajes'>" +
                "</div>" +
                "</div>"
    });
    box.modal('show');
}


function inicio_sesion_carrito() {
    $email = $("#email").val();
    $pass = $("#password").val();
    $base = $("#base").val();


    $.ajax({
        dataType: "json",
        data: {
            "email": $email,
            "password": $pass
        },
        url: "" + $base + "index.php/Login/inicio_sesion_carrito",
        type: 'post',
        beforeSend: function () {
            //Lo que se haceestan  antes de enviar el formulario
            //$("#razon_social").html("Cargando...");
        },
        success: function (respuesta) {
            //lo que se si el destino devuelve algo
            if (!respuesta.resp) {
                $('#mensajes').html(respuesta.mensajes);
            } else {
                window.location.assign($base + 'index.php/Trx_compras');
            }
            //window.location.reload(true);
        },
        error: function (xhr, err) {
            bootbox.alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
        }

    });

}

function ver_detalle() {

    $base = $('#base').val();

    $.ajax({
        dataType: "json",
        data: {},
        url: "" + $base + "index.php/Trx_compras/ver_detalle",
        type: 'post',
        beforeSend: function () {
            //Lo que se haceestan  antes de enviar el formulario
            //$("#razon_social").html("Cargando...");
        },
        success: function (respuesta) {
            //lo que se si el destino devuelve algo
            var box = bootbox.dialog({
                title: "Detalle compra",
                message: respuesta.respuesta,
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
}

function TerminarCompra(op) {

    if (op == 1) {
        bootbox.alert("Pirmero debe completar sus datos personales");
    } else {
        bootbox.confirm("¿Desea terminar la compra?", function (result) {
            if (result) {
                trx_compra();
            }
        });
    }
}

function trx_compra() {
    $base = $("#base").val();
    $id_direccion = $("#direccion").val();
    var now = Date.now();
    
 
    $.ajax({
        dataType: "json",
        data: {
            "numero_orden": now,
            "id_direccion": $id_direccion
        },
        url: "" + $base + "index.php/Trx_compras/terminar_compra",
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