<?php
   require_once("nav.php");
?>

<div class="container content espaciado-sup">
    <div class="text-left mb-2">
        <?php if(isset($_SESSION["busquedaTitleCartelera"])) { ?>
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByTituloAdminCartelera"?>">&larr; Atras</a></button>
        <?php } elseif(isset($_SESSION["busquedaGenderCartelera"])) { ?>
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByGenderAdminCartelera"?>">&larr; Atras</a></button>
        <?php } elseif(isset($_SESSION["busquedaDateCartelera"])) { ?>
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByDateAdminCartelera"?>">&larr; Atras</a></button>
        <?php } elseif(isset($_SESSION["busquedaTitleOutCartelera"])) { ?>
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByTitleAdminOutCartelera"?>">&larr; Atras</a></button>
        <?php } elseif(isset($_SESSION["busquedaGenderOutCartelera"])) { ?>
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByGenderAdminOutCartelera"?>">&larr; Atras</a></button>
        <?php } elseif(isset($_SESSION["busquedaDateOutCartelera"])) { ?>
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByDateAdminOutCartelera"?>">&larr; Atras</a></button>
        <?php } ?>
    </div>

    <table class="table text-white" style="font-weight: bold;">
            <thead class="thead-dark">
                <th colspan = 3 class="text-center">MOVIE</th>
            </thead>
            <tbody>     
                            <tr>
                                <td  class="text-center bg-dark" rowspan=6><img src="<?php echo $movie->getImage()?>" alt="" width=70% height=70%> </td>
                                <td class="text-uppercase bg-bordo">Title</td>
                                <td class="bg-bordo"><?php echo $movie->getTitle()?></td>
                            </tr>
                            
                            <tr  class="bg-bordo">
                                <td class="text-uppercase">Popularity</td>
                                <td><?php echo $movie->getPopularity()?></td>
                            </tr >
                            
                            <tr  class="bg-bordo">
                                <td class="text-uppercase">Vote average</td>
                                <td>
                                    <div>
                                        <input class="range" disabled value="<?php echo $movie->getVote_average()?>" type="range" min="0" max="10" step="0.01">
                                    </div>
                                </td>
                                
                            </tr>
                            <tr  class="bg-bordo">
                                <td class="text-uppercase">Overview</td>
                                <td><?php echo $movie->getOverview()?></td>
                            </tr>

                            <tr  style="background-color: #6F1E1E;">
                                <td class="text-uppercase">Runtime</td>
                                <td><?php echo $movie->getRuntime()?></td>
                            </tr>
                    </tbody>            
        </table> 

    <div class="espaciado-sup">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <tr>
                        <th colspan=5 > LISTADO DE FUNCIONES </th>
                        <th colspan=1 class="text-center"><button type="button" class="btn btn-outline-primary my-2 my-sm-0 push-rigth" data-toggle="modal" data-target="#modalAgregar">Agregar</button></th>
                    </tr>
                    <tr>
                        <th class="text-center">Nombre Del Cine</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Numero Sala</th>
                        <th class="text-center">Butacas Disponibles</th>
                        <th class="text-center">Fecha y</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach($infoFunciones as $funcion) { ?>
                    <tr>
                        <td class="text-center"><?php echo $funcion["nombre_cine"];?></td>
                        <td class="text-center"><?php echo $funcion["calle"]." ".$funcion["numero"];?></td>
                        <td class="text-center"><?php echo $funcion["numero_sala"];?></td>
                        <td class="text-center"><?php echo $funcion["butacas_disp"];?></td>
                        <td class="text-center"><?php echo $funcion["fecha_hora"];?></td>
                        <td class="text-center">
                            <form action="<?php echo FRONT_ROOT."Funcion/Remove"?>" method="post">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$funcion["id_funcion"];?>">Editar</button>
                                <button type="submit" class="btn btn-outline-danger" name="id" value="<?php echo $funcion["id_funcion"];?>">Borrar</button>
                                <input type="number" name="id_movie" value="<?php echo $funcion["id_pelicula"];?>" class="hide">
                            </form> 
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php foreach($infoFunciones as $funcion) { ?>
        <div class="modal fade" id="<?php echo "modal".$funcion["id_funcion"]?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
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
                            <input type="number" name="id_funcion" class="hide" value="<?php echo $funcion["id_funcion"]?>"/>
                            <input type="number" name="id_pelicula" class="hide" value="<?php echo $funcion["id_pelicula"]?>"/>
                            <div class="row form-group pr-3">
                                <label class="col-6">Sala</label>
                                <select name="id_sala">
                                    <?php foreach($listCines as $cine) { ?>
                                        <optgroup label="<?php echo $cine->getNombre()?>"> 
                                            <?php $listSala = $salaDao->GetAllByCine($cine->getId());
                                            foreach($listSala as $sala) { ?>
                                                <option value="<?php echo $sala->getId_sala()?>"><?php  echo  "Sala N°".$sala->getNumero_sala();?></option>
                                            <?php } ?>
                                        </optgroup> 
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="number" name="cant_asistentes" class="hide" value="0"/>
                            <div class="row form-group pr-3">
                                <label class="col-6">Fecha y Hora:</label>
                                <input type="datetime-local" name="fecha_hora" class="col-6" value="<?php echo $funcion["fecha_hora"];?>" required/>
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
                        <input type="numbre" name="id_pelicula" class="hide" value="<?php echo $movie->getId()?>"/>
                        <div class="row form-group pr-3">
                            <label class="col-6">Sala</label>
                            <select name="id_sala">
                                <?php foreach($listCines as $cine) { ?>
                                    <optgroup label="<?php echo $cine->getNombre();?>"> 
                                        <?php $listSala = $salaDao->GetAllByCine($cine->getId());
                                        foreach($listSala as $sala) { ?>
                                            <option value="<?php echo $sala->getId_sala();?>"><?php echo "Sala N°".$sala->getNumero_sala();?></option>
                                        <?php } ?>
                                    </optgroup> 
                                <?php } ?>
                            </select>
                        </div>
                        <input type="numbre" name="cant_asistentes" class="hide" value="0"/>
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