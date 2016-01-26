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
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
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
</body>
</html>