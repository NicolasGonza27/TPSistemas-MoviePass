<?php
   require_once("nav.php");
?>

<div class="container content espaciado-sup">
    <div class="text-left mb-2">
        <button class="btn btn-secondary"><a class="boton-atras" href="<?=$_SERVER["HTTP_REFERER"]?>">&larr; Atras</a></button>
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
                <?php foreach($listFunciones as $funcion) { ?>
                    <tr>
                        <td><?php ?></td>
                        <td><?php echo $funcion->getId_sala()?></td>
                        <td class="text-center"><?php echo $funcion->getCant_asistentes()?></td>
                        <td class="text-center"><?php echo $funcion->getFecha_hora()?></td>
                        <form action="<?php echo FRONT_ROOT."Funcion/Remove"?>" method="post">
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$funcion->getId_funcion()?>">Editar</button>
                                <button type="submit" class="btn btn-outline-danger" name="id" value="<?php echo $funcion->getId_funcion()?>">Borrar</button>
                            </td>
                        </form> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php foreach($listFunciones as $funcion) { ?>
        <div class="modal fade" id="<?php echo "modal".$funcion->getId_funcion()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo FRONT_ROOT."Funcion/ModifyModal"?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edición de Funcion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pl-3 pr-3">
                            <input type="numbre" name="id_funcion" class="hide" value="<?php echo $funcion->getId_funcion()?>"/>
                            <input type="numbre" name="id_pelicula" class="hide" value="<?php echo $funcion->getId_pelicula()?>"/>
                            <div class="row form-group pr-3">
                                <label class="col-6">Cine</label>
                                <select >
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
                                <input type="datetime-local" name="fecha_hora" class="col-6" value="<?php echo $funcion->getFecha_hora()?>" required/>
                            </div>

                            <div class="row pr-3">
                                <label class="col-12">Cantidad de asisitentes: <?php echo $funcion->getCant_asistentes()?> personas.</label>
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
    <?php } ?>

    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo FRONT_ROOT."Funcion/Add"?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar una Funcion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-3 pr-3">
                        <input type="numbre" name="id_funcion" class="hide" value="0"/>
                        <input type="numbre" name="id_pelicula" class="hide" value="<?php echo $movie->getId()?>"/>
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
                            <input type="numbre" name="id_sala" class="hide" value="3"/>
                            <select name="id_sala">
                                <!-- <?php foreach($listMovieGender as $movieGender) { ?>
                                    <option value="<?php  ?>"><?php  ?></option>
                                <?php } ?> -->
                            </select>
                        </div>
                        <div class="row form-group pr-3">
                            <label class="col-6">Fecha y Hora:</label>
                            <input type="datetime-local" name="fecha-hora" class="col-6" value="" required/>
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