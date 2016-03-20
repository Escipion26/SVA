<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo $menu; ?>
        </div>
    </div>
    <?php if ($this->cart->total_items() > 0) { ?>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3" style="margin-bottom: 100px">

            <table class="table table-striped table-responsive text-center">
                <thead>
                    <?php if(!empty($confirmacion)){ ?>
                    <?php echo $confirmacion?>
                    <?php } ?>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: 100px">
            <table class="table table-striped table-responsive">
                <tr>
                    <td class="active">Número orden</td>
                    <td class="active">Fecha compra</td>
                    <td class="active">Total compra</td>
                    <td class="active">Estado compra</td>
                </tr>
                <tr>
                    <td colspan="4">No ha relizado compras aún.</td>
                </tr>
            </table>
        </div>
    </div>
</div>