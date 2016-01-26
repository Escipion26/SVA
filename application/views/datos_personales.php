<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo $menu; ?>
        </div>
        <div class='col-lg-6 col-lg-offset-3' style='margin-bottom: 100px;'>
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
                    <button class='btn btn-primary pull-right'>Modificar</button>
                </div>                
            </div>
        </div>
    </div> <!--row-->
</div> <!--container -->

