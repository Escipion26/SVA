<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <?php echo $slide; ?>
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sx-12">
                <div class="left-sidebar">
                    <h2>Categorias</h2>
                    <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <?php echo $categorias; ?>
                    </div><!--/category-products-->
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--recommended_items-->
                    <div  id="recomendado">
                        <h2 class="title text-center">Recomendados</h2>
                    </div>

                    <div id="resultado">
                        <?php echo $recomendado ?>
                    </div>   
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

<!--<div class="modal fade" id="detalle" role="dialog">
    <div class="modal-dialog">
    
       Modal content
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Detalle Producto</h4>
        </div>
          <div class="modal-body" id="detalle_producto">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
 </div>-->