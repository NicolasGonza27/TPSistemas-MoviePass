<?php
require_once("nav.php");
if ($error) {
    echo "<script> alert('The card number you have enterd is not from Visa, nor Mastercard, try again.'); </script>";
}


if ($porcentaje) { ?>
    <div class="col_57 espaciado-sup">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Today you have a discount!</h4>
            <p> You discount is <?= $porcentaje ?> percent of your total purchase.</p>
        </div>
    </div>
<?php } ?>

<div class="container <?= $porcentaje ? "" : "espaciado-sup" ?>">
    <table class="table text-white" style="font-weight: bold;">
        <thead class="thead-dark">
            <tr>
                <th colspan="3" class="text-center h3">Buying Tikets</th>
            </tr>
        </thead>
    </table>
    <div class="white-box">
        <h4 class="mb-3">Movie Summary</h4>
        <div class="row">
            <div class="col-3 text-center">
                <img src="<?php echo $movie->getImage() ?>" alt="" width=70% height=100%>
            </div>
            <div class="col-9">
                <h5>Title: <?= $movie->getTitle() ?></h5>
                <h5>Runtime: <?= $movie->getRuntime() ?> minutes</h5>
                <h5>Overview: <?= $movie->getOverview() ?></h5>
            </div>
        </div>

        <hr>

        <h4 class="mt-3 mb-3">Function Summary</h4>
        <div class="d-flex">
            <div class="flex-fill">
                <span class="row col-12 h5">Cinema: <?= $infoUnaFuncion["nombre_cine"] ?></span>
                <span class="row col-12 h5">Room Number: <?= $infoUnaFuncion["numero_sala"] ?></span>
                <span class="row col-12 h5">Address: <?= $infoUnaFuncion["calle"] . " " . $infoUnaFuncion["numero"] ?></span>
            </div>
            <div class="flex-fill">
                <span class="row col-12 h5">Date: <?php $date = explode(" ", $funcion->getFecha_hora());
                                                    echo $date[0] ?></span>
                <span class="row col-12 h5">Show Time: <?php $time = explode(" ", $funcion->getFecha_hora());
                                                        echo $time[1] ?></span>
                <span class="row col-12 h5">Seats Available: <?= $infoUnaFuncion["butacas_disp"] ?></span>
            </div>
        </div>

        <hr>

        <h4 class="mt-3 mb-3">Enter the number of tickets you want to buy:</h4>
        <input id="valor_entrada" class="hide" value="<?= $cine->getValor_entrada() ?>">
        <div class="d-flex">
            <div class="flex-fill">
                <span>Tikets:</span>
                <input id="cant_tiket" class="number text-right" min="1" value="<?= $quantity ?>" onkeyup="number = $(this).val().replace('-', '');
                            $(this).val(number);
                            if(($(this).val() < 1) || ($(this).val() > <?= $infoUnaFuncion['butacas_disp'] ?>))
                            {$(this).val(1);}
                            $('#subtotal_precio').text($(this).val() * $('#valor_entrada').val());
                            reduc = 0;
                            if (<?= $porcentaje ?>){
                            reduc = ($(this).val() * $('#valor_entrada').val()) * (<?= $porcentaje ?>/100);
                            }
                            $('#total_precio').text(($(this).val() * $('#valor_entrada').val()) - reduc);
                            $('#monto_compra').val(($(this).val() * $('#valor_entrada').val()) - reduc);
                            $('#cant_entradas').val($(this).val());">
            </div>
            <div class="flex-fill">
                Subtotal: $<span id="subtotal_precio" class="text-right"><?= $cine->getValor_entrada() ?></span>
            </div>
            <div class="flex-fill">
                Total price: $<span id="total_precio" class="text-right"><?= $porcentaje ? $cine->getValor_entrada() - ($cine->getValor_entrada() * ($porcentaje / 100)) : $cine->getValor_entrada() ?></span>
            </div>
            <div class="flex-fill text-right">
                <a type="button" id="activar_mercado_pago" onclick=" alert('This method is a work in progress and wont be available on this web at the moment'); " href="<?php echo $preference->init_point; ?>"><button class="btn btn-primary">Purchase by MercadoPago</button></a>
            </div>
            <form action="<?php echo FRONT_ROOT . "Entrada/ShowPagoDeTarjetaViews" ?>" method="post">
                <div class="flex-fill text-right" style="margin-left: 4px;">

                    <input class="hide" name="cant_entradas" id="cant_entradas" value="1" />
                    <input class="hide" name="monto_compra" id="monto_compra" value="<?= $porcentaje ? $cine->getValor_entrada() - ($cine->getValor_entrada() * ($porcentaje / 100)) : $cine->getValor_entrada() ?>" />
                    <input class="hide" name="id_funcion" value="<?= $funcion->getId_funcion() ?>" />
                    <input class="hide" name="politica_descuento" value="<?= $politica_descuento_id ?>" />
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalPagar">Purchase</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPagar" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLabel">
    <div class="signup-form">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo FRONT_ROOT . "Entrada/comprarEntradas" ?>" method="post">
                    <!--Compra : id_usuario, id_politica_descuento, ->cant_entradas, ->monto
                    Entradas: $id_compra, ->$id_funcion, $nro_entrada-->
                    <input class="hide" name="cant_entradas" id="cant_entradas" value="1" />
                    <input class="hide" name="monto_compra" id="monto_compra" value="<?= $porcentaje ? $cine->getValor_entrada() - ($cine->getValor_entrada() * ($porcentaje / 100)) : $cine->getValor_entrada() ?>" />
                    <input class="hide" name="id_funcion" value="<?= $funcion->getId_funcion() ?>" />
                    <input class="hide" name="politica_descuento" value="<?= $politica_descuento_id ?>" />

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Pay with credit card</h2>
                    <p>You can use Visa or Mastercard to complete you purchase</p>
                    <hr>

                    <div class="form-group">
                        <input type="number" class="form-control" name="numero_tarjeta" placeholder="Card number" min="1000000000000000" max="9999999999999999" required />
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col"><input type="month" class="form-control" min="<?php echo (date("Y")) . '-' . date("m") ?>" max="<?php echo (date("Y") + 50) . '-' . date("m") ?>" placeholder="MM/AA" required /></div>
                            <div class="col"><input type="number" class="form-control" placeholder="Security number" min="111" max="999" required /></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your complete name" maxlength="30" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Finish purchase</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("input[type=text]").keyup(function() {
        leters = $(this).val().replace("  ", "");
        $(this).val(leters);
    });
</script>