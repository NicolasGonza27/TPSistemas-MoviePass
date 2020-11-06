<?php
   require_once("nav.php");
?>

<div class="container espaciado-sup">
    <table class="table text-white" style="font-weight: bold;">
        <thead class="thead-dark">
            <tr><th colspan="3" class="text-center h3">Buying Tikets</th>
        </tr></thead>
    </table>
    <div class="white-box">
        <h4 class="mb-3">Movie Summary</h4>
        <div class="row">
            <div class="col-3 text-center">
                <img src="<?php echo $movie->getImage()?>" alt="" width=70% height=100%> 
            </div>
            <div class="col-9">
                <h5>Title: <?=$movie->getTitle()?></h5>
                <h5>Runtime: <?=$movie->getRuntime()?> minutes</h5>
                <h5>Overview: <?=$movie->getOverview()?></h5>
            </div>
        </div>
        <h4 class="mt-3 mb-3">Function Summary</h4>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-5">
                <h5>Cinema: <?=$infoUnaFuncion["nombre_cine"]?></h5>
                <h5>Room Number: <?=$infoUnaFuncion["numero_sala"]?></h5>
                <h5>Address: <?=$infoUnaFuncion["calle"]." ".$infoUnaFuncion["numero"]?></h5>
            </div>
            <div class="col-5">
                <h5>Date: <?php $date = explode(" ", $funcion->getFecha_hora()); echo $date[0]?></h5>
                <h5>Show Time: <?php $time = explode(" ", $funcion->getFecha_hora()); echo $time[1]?></h5>
                <h5>Seats Available: <?=$infoUnaFuncion["butacas_disp"]?></h5>
            </div>
            <div class="col-1"></div>
        </div>
        <h4 class="mt-3 mb-3">Enter the number of tickets you want to buy:</h4>
        <input id="valor_entrada" class="hide" value="<?= $valorTotal != 0 ? $valorTotal : $cine->getValor_entrada()?>"> 
        <div class="d-flex">
            <div class="flex-fill">
                <input id="cant_ticket" class="number text-right" min="1" value="<?= $tiketsCant != 0 ? $tiketsCant : 1?>" 
                    onkeyup="$('#total_precio').text($(this).val() * $('#valor_entrada').val());"  
                    onblur=" window.location.href = window.location.href.split('?')[0] + '?id_funcion='+<?=$funcion->getId_funcion()?>+'&quantity=' + $('#cant_ticket').val();">
            </div>
            <div class="flex-fill">
                Total price: $<span id="total_precio" class="text-right"><?= $valorTotal != 0 ? $valorTotal : $cine->getValor_entrada()?></span>
            </div>
            <div class="flex-fill text-right">
                <a type="button" id="activar_mercado_pago" href="<?php echo $preference->init_point; ?>"><button class="btn btn-primary">Purchace</button></a>
            </div>
        </div>
    </div>
</div>