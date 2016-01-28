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

function ValidaNum() {
    //alert(event.keyCode);
    if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 65) || (event.keyCode > 90 && event.keyCode < 97) || event.keyCode > 122 ) {
        event.returnValue = false;
    }
}

function ValidaLetras(){

    alert('aoakoa');
    letras_latinas = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/;

    if(!$(":text#nombre").attr("value").match(letras_latinas)){
         bootbox.alert("Debe ingresar solo letras");
         document.getElementById('nombre')focus('); 
    }

}

