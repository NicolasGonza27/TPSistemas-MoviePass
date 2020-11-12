<?php
require_once(VIEWS_PATH . "header.php");
require_once("nav.php");
?>

<div class="container content espaciado-sup">

    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Quantities tickets sold and remnants</h4>
        <p> Here you can check the quantities tickets sold and remnants</p>
        <hr>
        <p class="mb-0">You can filter for movie, cinema and functions for the check.</p>
    </div>

    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Select a filter to see the total amount in pesos sold</h4>
        <hr>
    </div>

    <div class="content">
        <div valign="middle" class="text-center col_58">

            <div class="btn-group btn-group-toggle list-group" id="myList" role="tablist" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input class="list-group-item" type="radio" name="options" id="option1" checked data-toggle="list" href="#movie" role="tab">
                    <div class="h5">Filter for movie</div>
                </label>
                <label class="btn btn-secondary">
                    <input class="list-group-item" type="radio" name="options" id="option2" data-toggle="list" href="#cinema" role="tab">
                    <div class="h5">Filter for cinema</div>
                </label>
                <label class="btn btn-secondary">
                    <input class="list-group-item" type="radio" name="options" id="option3" data-toggle="list" href="#functions" role="tab">
                    <div class="h5">Filter for functions</div>
                </label>
            </div>
            <!-- <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#genre" role="tab">Filter for gender</a>
        <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#date" role="tab">Filter for date</a> -->
        </div>
        <br>

        <div class="tab-content">

            <div class="tab-pane active" id="movie" role="tabpanel">

                <div class="">
                    <div class="cart-fondo">
                        <?php
                        if (!empty($listMovie)) {
                            foreach ($listMovie as $movie) { ?>
                                <div class="col-3" style="display:block; margin:auto;">
                                    <?php if ($movie->getPoster_path()) { ?>
                                        <input type="image" name="id_movie" class="img-movies" data-toggle="modal" data-target="<?php echo "#modalMovie" . $movie->getId() ?>" src="<?php echo $movie->getImage(); ?>" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle(); ?>">
                                    <?php } else { ?>
                                        <div>
                                            <input type="image" name="id_movie" class="img-movies img-without-movie" data-toggle="modal" data-target="<?php echo "#modalMovie" . $movie->getId(); ?>" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle(); ?>">
                                            <div class="centrado"><?php echo $movie->getTitle(); ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="cinema" role="tabpanel">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="h3" colspan="7">List of cinemas</th>
                        </tr>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Street</th>
                            <th class="text-center">Number</th>
                            <th class="text-center">Opening Hours</th>
                            <th class="text-center">Closing hours</th>
                            <th class="text-center">Cinema ticket price</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if ($listaCine) {
                            foreach ($listaCine as $cine) { ?>

                                <tr>
                                    <td class="text-center table-secondary"><?php echo $cine->getNombre() ?></td>
                                    <td class="text-center table-secondary"><?php echo $cine->getCalle() ?></td>
                                    <td class="text-center table-secondary"><?php echo $cine->getNumero() ?></td>
                                    <td class="text-center table-secondary"><?php $ape = explode(":", $cine->getHor_apertura());
                                                                            echo $ape[0] . ":" . $ape[1]; ?> </td>
                                    <td class="text-center table-secondary"><?php $close = explode(":", $cine->getHor_cierre());
                                                                            echo $close[0] . ":" . $close[1]; ?> </td>
                                    <td class="text-center table-secondary"><?php echo $cine->getValor_entrada() ?></td>
                                    <td class="text-center table-secondary">
                                        <button type="button" name="id_cine" class="btn btn-primary btn-lg" data-toggle="modal" data-target="<?php echo "#modal" . $cine->getId(); ?>">Select</button></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <td colspan=7 class="text-center"> <strong>NO CINEMA SAVED IN FILES</strong></td>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="functions" role="tabpanel">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="h3" colspan="7">List of functions</th>
                        </tr>
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Number room</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Adress</th>
                            <th class="text-center">Seats available</th>
                            <th class="text-center">Date and Time</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if ($listFunciones) {
                            foreach ($listFunciones as $funcion) { ?>
                                <tr>
                                    <td class="text-center table-secondary"><?php echo $funcion["title"] ?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["numero_sala"]; ?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["nombre_cine"]; ?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["calle"] . " " . $funcion["numero"]; ?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["butacas_disp"] - $funcion['entradas']; ?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["fecha_hora"]; ?></td>
                                    <td class="text-center table-secondary">
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modalFuncion" . $funcion['id_funcion'] ?>">Select</button></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <td colspan=7 class="text-center"> <strong>NO FUNCTIONS SAVED IN FILES</strong></td>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>

        </div>_

    </div>
</div>

<!--Modal Cines x Entradas -->
<?php
foreach ($listaCine as $cine) {
    foreach ($entradasVendidasXcine as $entradas) {
        if ($cine->getId() == $entradas['id_cine']) {
?>
            <div class="modal fade" id="<?php echo "modal" . $entradas['id_cine'] ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail of sales</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-3 pr-3">
                            <div class="row form-group pr-3">
                                <label class="col-6">Quantity of tickets</label>
                                <input type="text" name="nombre" class="col-6" disabled value="<?php echo $entradas['cantidad'] ?>" />
                            </div>
                            <div class="row form-group pr-3">
                                <label class="col-6">Quantity without sales </label>
                                <input type="text" name="nombre" class="col-6" disabled value="<?php echo $cine->getCapacidad() - $entradas['cantidad'] ?>" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Back</button>

                        </div>
                    </div>
                </div>
            </div>
<?php }
    }
} ?>

<!-- Modal funcion x entrada -->
<?php
foreach ($listFunciones as $funcion) {
    foreach ($entradasVendidasXfuncion as $entradasFuncion) {
        if ($funcion['id_funcion'] == $entradasFuncion['id_funcion']) {
?>

            <div class="modal fade" id="<?php echo "modalFuncion" . $entradasFuncion['id_funcion'] ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail of tickets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-3 pr-3">

                            <div class="row form-group pr-3">
                                <label class="col-6">Quantity of tickets:</label>
                                <input type="text" name="nombre" class="col-6" disabled value="<?php echo $entradasFuncion['entradas'] ?>" required />
                            </div>
                        </div>

                        <div class="modal-body pl-3 pr-3">

                            <div class="row form-group pr-3">
                                <label class="col-6">Quantity of tickets without sales:</label>
                                <input type="text" name="nombre" class="col-6" disabled value="<?php echo $entradasFuncion['disponible'] ?>" required />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Back</button>
                        </div>
                    </div>
                </div>
            </div>
<?php }
    }
}
?>

<!-- Modal funcion x pelicula -->
<?php
foreach ($listMovie as $movie) {
    foreach ($entradasVendidasXpeliculas as $entradasPelicula) {
?>

            <div class="modal fade" id="<?php echo "modalMovie" . $entradasPelicula['id_pelicula'] ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail of tickets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-3 pr-3">

                            <div class="row form-group pr-3">
                                <label class="col-6">Quantity of tickets:</label>
                                <input type="text" name="nombre" class="col-6" disabled value="<?php echo $entradasPelicula['entradas'] ?>" />
                            </div>
                        </div>

                        <div class="modal-body pl-3 pr-3">

                            <div class="row form-group pr-3">
                                <label class="col-6">Quantity of tickets without sales:</label>
                                <input type="text" name="nombre" class="col-6" disabled value="<?php echo $entradasPelicula['cant_butacas'] - $entradasPelicula['entradas'] ?>" />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Back</button>
                        </div>
                    </div>
                </div>
            </div>
<?php }
}
?>


<?php require_once(VIEWS_PATH . "footer.php"); ?>