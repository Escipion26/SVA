<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo $menu; ?>
        </div>
        <div class="col-lg-12" style="margin-bottom: 100px">
            <?php echo $direcciones; ?>
        </div>
    </div> <!--row-->
</div> <!--container -->



<div class="modal fade" id="EditarModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Editar Dirección</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" name="base" id="base" value="<?php echo base_url(); ?>">
                    <input type="hidden" name="id_direccion" id="id_direccion" value="">

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombre direccion</label>
                            <div class="col-md-9">
                                <input name="nombre" id="nombre" placeholder="Ingrese nombre para direccion" required class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Direccion</label>
                            <div class="col-md-9">
                                <input type="text" name="direccion" id="direccion" class="form-control"  required placeholder="Ingrese direccion"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione región</label>
                            <div class="col-md-9">
                                <?php echo $regiones; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione Provincia</label>
                            <div class="col-md-9">
                                <select class="form-control" name="provincia" id="provincia" required>
                                    <option value="">Selecciona tu provincia</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione comuna</label>
                            <div class="col-md-9">
                                <select class="form-control" name="comuna" id="comuna" required>
                                    <option value="">Selecciona tu comuna</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSave" onclick="confirmar_2()" class="btn btn-default">Actualizar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">
    $(document).on('ready', function () {
        cargaProvincias();
        $('#region').change(cargaProvincias);
    });

    function cargaProvincias() {
        var idRegion = $('#region').val();
        $.getJson('Account/llenar_provincias', {id: idRegion}, function (resp) {
            $('#provincia').empty();

            $.each(resp, function (indice, valor) {
                option = $('<option></option>', {
                    value: indice,
                    text: valor
                });

                $('#provincia').append(option);
            });
        });
    }

    $("#regiones").on("change", function ()
    {
        //obtenemos la id de la provincia seleccionada
        var region = $("#regiones option:selected").attr("value");
        //hacemos la petición via get contra home/getAjaxPoblacion pasando la provincia
        $.get("<?php echo base_url('Account/llenar_provincias') ?>", {"region": region}, function (data)
        {
            $('#provincia').empty();

            $.each(resp, function (indice, valor) {
                option = $('<option></option>', {
                    value: indice,
                    text: valor
                });

                $('#provincia').append(option);
            });

        });
    });

</script>