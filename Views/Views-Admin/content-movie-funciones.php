<?php
   require_once("nav.php");
?>

<div class="container content">
    <div class="text-left mb-2">
        <button class="btn btn-secondary"><a class="boton-atras" href="<?=$_SERVER["HTTP_REFERER"]?>/">&larr; Atras</a></button>
    </div>

    <table class="table text-white" style="font-weight: bold;">
        <thead>
            <th colspan = 3 class="text-center">Movie</th>
        </thead>
        <tbody>     
            <tr>
                <td rowspan=6><img src="<?php echo $movie->getImage()?>" alt=""></td>
                <td class="text-uppercase">Title</td>
                <td><?php echo $movie->getTitle()?></td>
            </tr>
            <tr>
                <td class="text-uppercase">Popularity</td>
                <td><?php echo $movie->getPopularity()?></td>
            </tr>
            <tr>
                <td class="text-uppercase">Vote average</td>
                <td><?php echo $movie->getVote_average()?></td>
            </tr>
            <tr>
                <td class="text-uppercase">Original language</td>
                <td><?php echo $movie->getOriginal_language()?></td>
            </tr>
            <tr>
                <td class="text-uppercase">Overview</td>
                <td><?php echo $movie->getOverview()?></td>
            </tr>
            <tr>
                <td class="text-uppercase">Runtime</td>
                <td><?php echo $movie->getRuntime()?></td>
            </tr>
        </tbody>            
    </table> 
    
    <div class="espaciado-sup">
        <button type="button" class="btn btn-outline-primary my-2 my-sm-0 push-rigth" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th class="text-center">Cantidad de Asistentes</th>
                    <th class="text-center">Fecha y Hora</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <!-- <?php foreach($listaCine as $cine) { ?>
                    <tr>
                        <td><?php ?></td>
                        <td><?php ?></td>
                        <td class="text-center"><?php echo $cine->getHor_apertura()?></td>
                        <td class="text-center"><?php echo $cine->getHor_cierre()?></td>
                        <form action="<?php echo FRONT_ROOT."Funcion/Remove"?>" method="post">
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$cine->getId()?>">Editar</button>
                                <button type="submit" class="btn btn-outline-danger" name="id" value="<?php echo $cine->getId()?>">Borrar</button>
                            </td>
                        </form> 
                    </tr>
                <?php } ?> -->
            </tbody>
        </table>
    </div>

    <!-- <?php foreach($listaCine as $cine) { ?>
        <div class="modal fade" id="<?php echo "modal".$cine->getId()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo FRONT_ROOT."/"?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edición de Funcion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-3 pr-3">
                            <input type="numbre" name="id" class="hide" value="<?php ?>"/>
                            <input type="numbre" name="id_pelicula" class="hide" value="<?php ?>"/>
                            <div class="row form-group pr-3">
                                <label class="col-6">Cine</label>
                                <select>
                                    <?php foreach($listMovieGender as $movieGender) { ?>
                                        <option value="<?php  ?>"><?php  ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="row form-group pr-3">
                                <label class="col-6">Sala</label>
                                <select name="id_sala">
                                    <?php foreach($listMovieGender as $movieGender) { ?>
                                        <option value="<?php  ?>"><?php  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="row form-group pr-3">
                                <label class="col-6">Fecha y Hora:</label>
                                <input type="datetime-local" name="fecha-hora" class="col-6" value="<?php ?>" required/>
                            </div>

                            <div class="row pr-3">
                                <label class="col-12">Cantidad de asisitentes: <?php ?> personas.</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?> -->

    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo FRONT_ROOT.""?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar una Funcion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-3 pr-3">
                        <input type="numbre" name="id_pelicula" class="hide" value="<?php ?>"/>
                        <div class="row form-group pr-3">
                            <label class="col-6">Cine</label>
                            <select>
                                <!-- <?php foreach($listMovieGender as $movieGender) { ?>
                                    <option value="<?php  ?>"><?php  ?></option>
                                <?php } ?> -->
                            </select>
                        </div>
                        <div class="row form-group pr-3">
                            <label class="col-6">Sala</label>
                            <select name="id_sala">
                                <!-- <?php foreach($listMovieGender as $movieGender) { ?>
                                    <option value="<?php  ?>"><?php  ?></option>
                                <?php } ?> -->
                            </select>
                        </div>
                        <div class="row form-group pr-3">
                            <label class="col-6">Fecha y Hora:</label>
                            <input type="datetime-local" name="fecha-hora" class="col-6" value="<?php ?>" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>