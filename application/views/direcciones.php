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
                                <input name="nombre" id="nombre" placeholder="Ingrese nombre para direccion ej: Casa" required class="form-control" type="text">
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
                                 <?php echo $provincias; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione comuna</label>
                            <div class="col-md-9">
                                 <?php echo $comunas; ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSave" onclick="confirmar_2()" class="btn btn-primary">Actualizar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="InsertarModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nueva dirección</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" name="base" id="base" value="<?php echo base_url(); ?>">
                    <input type="hidden" name="id_cliente" id="id_cliente" value="">

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombre direccion</label>
                            <div class="col-md-9">
                                <input name="nombre" id="nom" placeholder="Ingrese nombre para direccion ej: Casa" required class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Direccion</label>
                            <div class="col-md-9">
                                <input type="text" name="dir" id="direccion" class="form-control"  required placeholder="Ingrese direccion"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione región</label>
                            <div class="col-md-9">
                                <select id="regiones_insert" name="region">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione Provincia</label>
                            <div class="col-md-9">
                                <select id="provincias_insert" name="provincia">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Seleccione comuna</label>
                            <div class="col-md-9">
                                 <select id="comunas_insert" name="comuna">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSave" onclick="ConfirmarInsertar()" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
