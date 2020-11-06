<?php require_once(VIEWS_PATH . "Views-Cliente/nav.php"); ?>


<div class="container espaciado-sup">
    <div class="content">
        <div class="scrollable">
            <h3 class="text-white mt-3 mb-3">

            </h3>
            <table class="table" style="font-size: 20px;">
                <thead class="thead-dark">
                    <tr>
                        <th colspan=5 class="text-center"> List of my purcheses </th>
                    </tr>
                    <tr>
                        <th class="text-center">Number of tickets</th>
                        <th class="text-center">Discount obtained</th>
                        <th class="text-center">Total amount</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <form action="<?php echo FRONT_ROOT."Entrada/ShowContentsCompraViews"?>" method="post">
                        <?php

                        if (!empty($listCompras)) {

                            foreach ($listCompras as $compra) {
                        ?>
                                <tr>
                                    <td class="text-center table-secondary"><?php echo $compra["cant_entradas"]; ?></td>
                                    <td class="text-center table-secondary"><?php echo $compra["porcentaje_descuento"]; ?></td>
                                    <td class="text-center table-secondary"><?php echo $compra["monto"]; ?></td>
                                    <td class="text-center table-secondary"><button type="submit" name="id_compra" class="btn btn-success btn-lg" value="<?php echo $compra["id_compra"];?>">Tickets</button></td>
                                </tr>

                            <?php }
                            } else {
                            ?>
                            <td colspan=5 class="text-center"> <strong>YOU DON'T HAVE ANY PURCHESE</strong></td>
                        <?php } ?>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>