<section>
    <div class="container" style="padding-top: 20px">
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
