<footer id="footer"><!--Footer-->
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>  
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>Acerca de</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    LOGO
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2016 Carshop Todos los derechos reservados.</p>
                <p class="pull-right">Dideñado por <span><a target="_blank" href="http://www.dwchile.cl">DWCHILE</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->
<script>
    $(document).ready(function () {
        if ($("div#mensaje")) {
            setTimeout(function () {
                $("div#mensaje").hide("slow");
            }, 4000);
        }
    });
</script>
<script>
    $(document).ready(function () {
        $("select#regiones").change(function () {
            var idregion = $("#regiones").val();
            $("#comuna").val(0);
            $.ajax({
                dataType: 'JSON',
                data: {idregion: idregion},
                url: "<?php echo base_url() ?>" + "index.php/Account/llenar_provincias",
                type: 'POST',
                beforeSend: function () {
                    //Lo que se hace antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#provincia").html(respuesta.respuesta);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function () {
        $("select#provincia").change(function () {
            var idpro = $("#provincia").val();
            $.ajax({
                dataType: 'JSON',
                data: {idpro: idpro},
                url: "<?php echo base_url() ?>" + "index.php/Account/llenar_comunas",
                type: 'POST',
                beforeSend: function () {
                    //Lo que se hace antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#comuna").html(respuesta.respuesta);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("select#reg").change(function () {
            var idregion = $("#reg").val();
            $("#com").val(0);
            $.ajax({
                dataType: 'JSON',
                data: {idregion: idregion},
                url: "<?php echo base_url() ?>" + "index.php/login/llenar_provincias",
                type: 'POST',
                beforeSend: function () {
                    //Lo que se hace antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#pro").html(respuesta.respuesta);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function () {
        $("select#pro").change(function () {
            var idpro = $("#pro").val();
            $.ajax({
                dataType: 'JSON',
                data: {idpro: idpro},
                url: "<?php echo base_url() ?>" + "index.php/login/llenar_comunas",
                type: 'POST',
                beforeSend: function () {
                    //Lo que se hace antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#com").html(respuesta.respuesta);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    function ObtieneDatos(id_cliente) {
        $id_cliente = id_cliente;

        $(document).ready(function () {
            $.ajax({
                dataType: "json",
                data: {"id_cliente": $id_cliente},
                url: "<?php echo base_url() ?>" + "index.php/Account/traer_datos",
                type: 'post',
                beforeSend: function () {
                    //Lo que se haceestan  antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#rut").val(respuesta.rut);
                    $("#nombre").val(respuesta.nombre);
                    $("#apellido").val(respuesta.apellido);
                    $("#contacto1").val(respuesta.fono1);
                    $("#contacto2").val(respuesta.fono2);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });

    }




</script>
<script>
    $(document).ready(function () {
        $("select#regiones_insert").change(function () {
            var idregion = $("#regiones_insert").val();
            $("#comunas_insert").val(0);
            $.ajax({
                dataType: 'JSON',
                data: {idregion: idregion},
                url: "<?php echo base_url() ?>" + "index.php/Account/llenar_provincias",
                type: 'POST',
                beforeSend: function () {
                    //Lo que se hace antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#provincias_insert").html(respuesta.respuesta);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function () {
        $("select#provincias_insert").change(function () {
            var idpro = $("#provincias_insert").val();
            $.ajax({
                dataType: 'JSON',
                data: {idpro: idpro},
                url: "<?php echo base_url() ?>" + "index.php/Account/llenar_comunas",
                type: 'POST',
                beforeSend: function () {
                    //Lo que se hace antes de enviar el formulario
                    //$("#razon_social").html("Cargando...");
                },
                success: function (respuesta) {
                    //lo que se si el destino devuelve algo
                    $("#comunas_insert").html(respuesta.respuesta);
                },
                error: function (xhr, err) {
                    alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\n \n responseText: " + xhr.responseText);
                }
            });
        });
    });
</script>


</body>
</html>