<section id="form"><!--form-->
    <div class="container">
        <?php if($this->session->flashdata('login')){ ?>
                <div id="mensaje" class="<?php echo $class;?>" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>!Atencion!</strong><?php echo  $this->session->flashdata('login');?>
                </div>
                <?php }?>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Inicia sesion</h2>
                    <form action="<?php echo base_url()?>index.php/login/inicio_sesion" method="post">
                        <input type="text" name="email" value="<?php echo set_value("email")?>" placeholder="Email" />
                        <input type="password" name="password" placeholder="Contraseña" />
                        <button type="submit" class="btn btn-default">Inicio sesion</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="signup-form"><!--sign up form-->
                    <h2>¡Registrate!</h2>
                    <form action="<?php echo base_url()?>index.php/login/registro" method="post">
                        <input type="text" name="nombre" placeholder="Nombre"/>
                        <input type="email" name="email" placeholder="Email"/>
                        <input type="password" name="password" placeholder="Constraseña"/>
                        <button type="submit" class="btn btn-default">Registrate</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

