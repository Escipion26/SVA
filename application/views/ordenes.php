<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo $menu; ?>
        </div>
    </div>
    <?php if ($this->cart->total_items() > 0) { ?>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3" style="margin-bottom: 50px">

                <table class="table table-striped table-responsive text-center">
                    <thead>
                        <?php if (!empty($confirmacion)) { ?>
                            <?php echo $confirmacion ?>
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
           <h2>Transacciones</h2>
            <table class="table table-bordered table-responsive text-center">
                <tr>
                    <td class="active">Número orden</td>
                    <td class="active">Fecha compra</td>
                    <td class="active">Total compra</td>
                    <td class="active">Estado compra</td>
                    <td class="active">Opción</td>
                </tr>

                <?php if (!empty($transacciones)) { ?>
                    <?php echo $transacciones ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">No ha relizado compras aún.</td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</div>