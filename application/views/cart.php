<div class="container"  style="padding-top: 100px">
    <section id="cart_items">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Articulo</td>
                        <td class="description">Descripción</td>
                        <td class="price">Precio</td>
                        <td class="quantity">Cantidad</td>
                        <td class="total">Total</td>
                        <td colspan="2">Opciones</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <div id="carro">
                    <?php if (!empty($detalle)) { ?>
                        <?php echo $detalle ?>
                    <?php } ?>
                </div>
                </tbody>
            </table>
        </div>
    </section> <!--/#cart_items-->
    <?php if ($this->cart->total_items() > 0) { ?>
    <div class="col-lg-3 col-lg-offset-9 col-md-2 col-md-offset-9 col-sm-2 col-sm-offset-8 col-xs-3 col-xs-offset-7">
        <table class="responsive table">
            <tr>
                <td><h3><p style="color: #FE980F" class="text-warning">TOTAL: </p></h3></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><h3><p style="color: #FE980F" class="text-warning">$ <?php echo $this->cart->total(); ?></p></h3></td>
            </tr>
        </table>
    </div>
    <?php } ?>
</div>
<?php if ($this->cart->total_items() > 0) { ?>
    <div class="container">


        <div class="text-center" style="padding-bottom:  30px">
            <a type="button" href="<?php echo base_url(); ?>" class="btn btn-success">SEGUIR COMPRANDO</a>
            <?php if ($this->session->userdata('logueado') == true && $this->cart->total_items() > 0) { ?>
            <button type="button" class="btn btn-primary">TERMINAR LA VENTA</button>
            <?php } else { ?>
                <button type="button"  onclick="inicio_sesion()" class="btn btn-primary">TERMINAR LA VENTA</button>
            <?php } ?>
        </div>
    </div>
<?php
}?>