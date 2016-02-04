<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo $menu; ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-bottom: 100px">
            <div class="panel panel-primary">
                <div class="panel-heading">Cambiar correo para inicio de sesión</div>
                <div class="panel-body">
                    <div class="form-body">
                        <input type="hidden" id="base" value="<?php echo base_url();?>">
                        <div class="form-group">
                            <input type="text" class="form-control" disabled="true" value="<?php echo $this->session->userdata('correo');?>">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Ingrese nuevo correo" name="email" id="email" class="form-control" >
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Ingrese su contraseña actual" name="password" id="password" class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary pull-left" onclick="ActualizarCorreo()">Actualizar</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Cambiar contraseña</div>
                <div class="panel-body">
                   <div class="form-body">
                        <input type="hidden" id="base" value="<?php echo base_url();?>">
                        <div class="form-group">
                            <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Contraseña actual">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Nueva contraseña" name="pass2" id="pass2" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Reingrese nueva contraseña" name="pass3" id="pass3" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary pull-left" onclick="ActualizarContra()">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--row-->
</div> <!--container -->