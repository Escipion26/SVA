function sub(idcat,idsub){
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