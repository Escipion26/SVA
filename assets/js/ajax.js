function ObtieneDireccion(id_direccion) {
    $base = $("#base").val();
    $id_direccion = id_direccion;
    $(document).ready(function () {
        $.ajax({
            dataType: "json",
            data: {"id_direccion": $id_direccion},
            url: "" + $base + "index.php/Account/traer_direccion",
            type: 'post',
            beforeSend: function () {
                //Lo que se haceestan  antes de enviar el formulario
                //$("#razon_social").html("Cargando...");
            },
            success: function (respuesta) {
                //lo que se si el destino devuelve algo
                $("#nombre").val(respuesta.nombre);
                $("#direccion").val(respuesta.direccion);
                $("#id_direccion").val(respuesta.id_direccion)
            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
            }
        });
    });

}

function ActualizaDatos() {
    $base = $("#base").val();
    $id_cliente = $("#id_cliente").val();
    $rut = $("#rut").val();
    $nombre = $("#nombre").val();
    $apellido = $("#apellido").val();
    $contacto1 = $("#contacto1").val();
    $contacto2 = $("#contacto2").val();
    $(document).ready(function () {
        $.ajax({
            dataType: "json",
            data: {"id_cliente": $id_cliente,
                "rut": $rut,
                "nombre": $nombre,
                "apellido": $apellido,
                "contacto1": $contacto1,
                "contacto2": $contacto2
            },
            url: "" + $base + "index.php/Account/ActualizaDatos",
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
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
            }
        });
    });

}

function insertdireccion() {
    $base = $("#base").val();
    $(document).ready(function () {
        $.ajax({
            dataType: 'JSON',
            data: {},
            url: "" + $base + "index.php/Account/regiones_insert",
            type: 'POST',
            beforeSend: function () {
                //Lo que se hace antes de enviar el formulario
                //$("#razon_social").html("Cargando...");
            },
            success: function (respuesta) {
                //lo que se si el destino devuelve algo
                $("#regiones_insert").html(respuesta.regiones);
            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
            }
        });
    });
}

function InsertarDireccion() {

    $base = $('#base').val();
    $nombre_direccion = $('#nom').val();
    $direccion = $('#dir').val();
    $region = $('#regiones_insert').val();
    $provincia = $('#provincias_insert').val();
    $comuna = $('#comunas_insert').val();
    $.ajax({
        dataType: "json",
        data: {"nombre_direccion": $nombre_direccion,
            "direccion": $direccion,
            "region": $region,
            "provincia": $provincia,
            "comuna": $comuna
        },
        url: "" + $base + "index.php/Account/InsertarDireccion",
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
            alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
        }
    });
}

function ActualizarDireccion() {
    $base = $('#base').val();
    $id_direccion = $('#id_direccion').val();
    $nombre_direccion = $('#nombre').val();
    $direccion = $('#direccion').val();
    $region = $('#regiones').val();
    $provincia = $('#provincia').val();
    $comuna = $('#comuna').val();
    $.ajax({
        dataType: "json",
        data: {
            "id_direccion": $id_direccion,
            "nombre_direccion": $nombre_direccion,
            "direccion": $direccion,
            "region": $region,
            "provincia": $provincia,
            "comuna": $comuna
        },
        url: "" + $base + "index.php/Account/ActualizarDireccion",
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
            alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
        }
    });
}

function ActualizarEmail() {
    $base = $('#base').val();
    $pass = $('#password').val();
    $email = $('#email').val();
    $.ajax({
        dataType: "json",
        data: {
            "pass": $pass,
            "email": $email
        },
        url: "" + $base + "index.php/Account/ActualizarCorreo",
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

function ActualizarContraseña() {
    $base = $('#base').val();
    $pass1 = $('#pass1').val();
    $pass2 = $('#pass2').val();
    $pass3 = $('#pass3').val();
    $.ajax({
        dataType: "json",
        data: {
            "pass1": $pass1,
            "pass2": $pass2,
            "pass3": $pass3
        },
        url: "" + $base + "index.php/Account/ActualizarContra",
        type: 'post',
        beforeSend: function () {
            //Lo que se haceestan  antes de enviar el formulario
            //$("#razon_social").html("Cargando...");
        },
        success: function (respuesta) {
            //lo que se si el destino devuelve algo
            if (!respuesta.resp) {
                bootbox.alert(respuesta.mensaje);
                $('#pass1').val("");
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

function EliminaDireccion(IdDireccion) {
    $idd = IdDireccion;
    $base = $('#base').val();

    $.ajax({
        dataType: "json",
        data: {
            "idd": $idd
        },
        url: "" + $base + "index.php/Account/EliminarDireccion",
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

function EliminarDireccion(IdDireccion) {
    bootbox.confirm("¿Esta Seguro que desea eliminar esta dirección?", function (result) {
        if (result) {
            EliminaDireccion(IdDireccion);
            true;
        }
    });
}

function confirmar_2() {
    bootbox.confirm("¿Esta Seguro de actualizar esta direccion?", function (result) {
        if (result) {
            ActualizarDireccion();
            true;
        }
    });
}

function ActualizarContra() {
    bootbox.confirm("¿Esta Seguro de actualizar su contraseña?", function (result) {
        if (result) {
            ActualizarContraseña();
            true;
        }
    });
}

function ActualizarCorreo() {
    bootbox.confirm("¿Esta Seguro de actualizar su correo?", function (result) {
        if (result) {
            ActualizarEmail();
            true;
        }
    });
}

function ConfirmaDatos() {
    bootbox.confirm("¿Esta Seguro de actualizar los datos?", function (result) {
        if (result) {
            ActualizaDatos();
            true;
        }
    });
}

function ConfirmarInsertar() {
    bootbox.confirm("¿Esta Seguro de guardar esta dirección?", function (result) {
        if (result) {
            $('#InsertarModal').hide();
            InsertarDireccion();
            true;
        }
    });
}

function ValidNum(event) {

    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
    }
}

function mostrar_login() {

    $('#login').show("slow");
}

