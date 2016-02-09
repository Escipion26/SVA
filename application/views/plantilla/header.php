<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Carshop</title>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/price-range.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/images/ico/apple-touch-icon-57-precomposed.png">
        
        <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url();?>assets/js/Rut.js"></script>
        <script src="<?php echo base_url();?>assets/js/neg.js"></script>
        <script src="<?php echo base_url();?>assets/js/ajax.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.scrollUp.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/price-range.js"></script>
        <script src="<?php echo base_url();?>assets/js/main.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
    </head><!--/head-->
    <body>
        <header id="header"><!--header-->
            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Inicio</a></li>
                                    <?php if ($this->session->userdata('logueado') == true) { ?>
                                    <li><a href="<?php echo base_url()?>index.php/panel-usuario"><i class="fa fa-user"></i> Bienvenido <?php echo $this->session->userdata('nombre') ?>/ver cuenta</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>index.php/login"><i class="fa fa-user"></i> Cuenta</a></li>
                                    <?php } ?>
<!--                                    <li><a href="#"><i class="fa fa-star"></i> Favoritos</a></li>-->
                                    <li><a href="#"><i class="fa fa-crosshairs"></i> Chequear</a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i> Carrito</a></li>
                                    <?php if (!$this->session->userdata('logueado') == true) { ?>
                                        <li><a href="<?php echo base_url(); ?>index.php/login"><i class="fa fa-lock"></i> Registrate/Inicio sesion</a></li>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('logueado') == true) { ?>
                                        <li><a href="<?php echo base_url(); ?>index.php/login/cerrar_sesion"><i class="fa fa-lock"></i>  Cerrar sesion</a></li>
                                    <?php } ?>    
                                        
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->
        </header><!--/header-->