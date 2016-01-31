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

function ActualizaDatos(){
    $base = $("#base").val();
    $id_cliente = $("#id_cliente").val();
    $rut = $("#rut").val();
    $nombre = $("#nombre").val();
    $apellido = $("#apellido").val();
    $contacto1 = $("#contacto1").val();
    $contacto2 = $("#contacto2").val();
    $(document).ready(function(){
            $.ajax({
                    dataType:   "json",
                    data    :   {   "id_cliente"  : $id_cliente,
                                    "rut"     : $rut,
                                    "nombre"     : $nombre,
                                    "apellido" : $apellido,
                                    "contacto1" : $contacto1,
                                    "contacto2" : $contacto2
                                },
                    url     :   ""+$base+"index.php/Account/ActualizaDatos",
                    type    :   'post',
                    beforeSend: function(){
                            //Lo que se haceestan  antes de enviar el formulario
                            //$("#razon_social").html("Cargando...");
                    },
                    success: function(respuesta){
                            //lo que se si el destino devuelve algo
                            if(!respuesta.resp){
                                bootbox.alert(respuesta.mensaje);
                            }else{
                              
                                bootbox.alert(respuesta.mensaje, function() {
                                    window.location.reload(true);
                                });
                            }
                            //window.location.reload(true);
                    },
                    error: function(xhr,err){ 
                            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    }
            });
    });
    
}

function insertdireccion(){
    $base = $("#base").val();
    $(document).ready(function () {
            $.ajax({
                dataType: 'JSON',
                data: {},
                url: ""+$base+"index.php/Account/regiones_insert",
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


