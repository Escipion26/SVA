<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo $menu; ?>
        </div>
        <div class='col-lg-6 col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3  col-lg-offset-3' style='margin-bottom: 100px;'>
            <div class='panel panel-default'>
                <div class='panel-heading'>DATOS PERSONALES</div>
                <div class="panel-body">
                    <div class="text-center alert alert-warning alert-dismissable pull-left col-lg-12">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        ¡No olvides completar tus datos!
                    </div>
                </div>
                <div class='panel-body'>
                    <?php echo $datos_personales; ?>
                </div>                
            </div>
        </div>
    </div> <!--row-->
</div> <!--container -->
<div class="modal fade" id="DatosModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Actualizar datos personales</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" id="base" value="<?php echo base_url();?>" >
                    <input type="hidden" id="id_cliente" value="<?php echo $this->session->userdata('id_cliente');?>" >
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Rut</label>
                            <div class="col-md-9">
                                <input name="rut" id="rut" placeholder="Ingrese su rut" required class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombre</label>
                            <div class="col-md-9">
                                <input name="nombre" id="nombre" placeholder="Ingrese su nombre" required class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Apellido</label>
                            <div class="col-md-9">
                                <input type="text" name="apellido" id="apellido" class="form-control"  required placeholder="Ingrese su apellido"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Telefono contacto 1</label>
                            <div class="col-md-9">
                                <input type="text" name="contacto1" id="contacto1" class="form-control"  required placeholder="Ingrese telefono"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Telefono contacto 2</label>
                            <div class="col-md-9">
                                <input type="text" name="contacto2" id="contacto2" class="form-control"  required placeholder="Ingrese telefono"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSave" onclick="ConfirmaDatos()" class="btn btn-primary">Actualizar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
