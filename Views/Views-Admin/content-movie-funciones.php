<?php
    require_once("nav.php");
    if ($error == 1) {
        echo "<script>alert('The date and time of the room you have indicated are not available to program this function, check the hours and try again');</script>";
    }
?>
<div class="container content espaciado-sup">

    <div class="mb-2 d-flex">
        <div class="text-left">
            <?php if(isset($_SESSION["backbutton"])) { ?>
                <?php $backButton = $_SESSION["backbutton"];?>
                <?php if($backButton == "busquedaTitleCartelera") { ?>
                    <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByTituloAdminCartelera"?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
                <?php } elseif($backButton == "busquedaGenderCartelera") { ?>
                    <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByGenderAdminCartelera"?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
                <?php } elseif($backButton == "busquedaDateCartelera") { ?>
                    <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByDateAdminCartelera"?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
                <?php } elseif($backButton == "cartelera") { ?>
                    <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/GetCartelera"?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
                <?php } elseif($backButton == "filterCartelera") {  ?>
                    <a class="boton-atras" href="<?php echo FRONT_ROOT."Home/ShowFiltersViewsAdminCartelera"?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
            <?php } }?>        
        </div>
        <div class="ml-auto">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modalEliminarMovie">Remove of billboard</button>
        </div>
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
                        <input class="range form-control-range" disabled value="<?php echo $movie->getVote_average()?>" type="range" step="0.1" min="0" max="10" step="0.01">
                    </div>
                </td>
            </tr>
            <tr  class="bg-bordo">
                <td class="text-uppercase">Overview</td>
                <td><?php echo $movie->getOverview()?></td>
            </tr>

            <tr  class="bg-bordo">
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
                        <th colspan=5 > FUNCTION LIST </th>
                        <th colspan=1 class="text-center"><button type="button" class="btn btn-outline-primary my-2 my-sm-0 push-rigth" data-toggle="modal" data-target="#modalAgregar">Add</button></th>
                    </tr>
                    <tr>
                        <th class="text-center">Name by cinema</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Number room</th>
                        <th class="text-center">Seats available</th>
                        <th class="text-center">Date and Time</th>
                        <th class="text-center">Options</th>
                    </tr>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php 
                    if($infoFunciones) { foreach($infoFunciones as $funcion) { ?>
                    <tr>
                        <td class="text-center"><?php echo $funcion["nombre_cine"];?></td>
                        <td class="text-center"><?php echo $funcion["calle"]." ".$funcion["numero"];?></td>
                        <td class="text-center"><?php echo $funcion["numero_sala"];?></td>
                        <td class="text-center"><?php echo $funcion["butacas_disp"];?></td>
                        <td class="text-center"><?php echo $funcion["fecha_hora"];?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$funcion["id_funcion"];?>">Edit</button>
                            <button type="button" class="btn btn-outline-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="<?php echo "#modalEliminar" .$funcion["id_funcion"];?>">Remove</button>
                        </td>
                    </tr>
                <?php } } else { ?>
                    <td colspan = 6 class="text-center"> <strong>THIS MOVIE HAS NO FUNCTION AVAILABLE</strong></td>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>

<?php foreach($infoFunciones as $funcion) { ?>
    <div class="modal fade" id="<?php echo "modal".$funcion["id_funcion"]?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="signup-form">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo FRONT_ROOT."Funcion/ModifyModal"?>" method="post">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2>Function Edit</h2>
                        <p>You can edit the function, change the text fields that you want modify</p>
                        <hr>

                        <input type="number" name="id_funcion" class="hide" value="<?php echo $funcion["id_funcion"]?>"/>
                        <input type="number" name="id_pelicula" class="hide" value="<?php echo $funcion["id_pelicula"]?>"/>

                        <div class="row form-group pr-3">
                            <label class="col-6">Room</label>
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
                            <label class="col-6">Date and time:</label>
                            <input type="datetime-local" min="<?php echo date("Y").'-'.date("m").'-'.date("d").'T00:00:00';?>" name="fecha_hora" class="col-6" value="<?php echo $funcion["fecha_hora"];?>" required/>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="signup-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo FRONT_ROOT."Funcion/Add"?>" method="post">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Add a function</h2>
                    <p>You can add functions, complete the following textfilds</p>
                    <hr>

                    <input type="numbre" name="id_pelicula" class="hide" value="<?php echo $movie->getId()?>"/>

                    <div class="form-group">
                        <label>Room</label>
                        <select name="id_sala" class="form-control">
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

                    <div class="form-group">
                        <label>Date and time</label>
                        <input type="datetime-local" min="<?php echo date("Y").'-'.date("m").'-'.date("d").'T00:00:00';?>" name="fecha-hora" class="form-control" value="" required/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Remove de Cartelera-->
<?php foreach($infoFunciones as $funcion) { ?>
    <div class="modal fade" id="<?php echo "modalEliminar".$funcion["id_funcion"]; ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo FRONT_ROOT.'Funcion/Remove'?>" method="post">
                    <div class="modal-header">
                        <div class="modal-title" id="exampleModalLabel">¿Do you want to remove this function? </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <input type="number" name="id" value="<?php echo $funcion["id_funcion"]; ?>" class="hide">
                    <input type="number" name="id_movie" value="<?php echo $movie->getId(); ?>" class="hide">

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';" >Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="modalEliminarMovie" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo FRONT_ROOT.'Movie/RemoveMovieCartelera'?>" method="post">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">¿Do you want to remove <strong><?=$movie->getTitle()?></strong> from the Billboard? </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <input type="number" name="id" value="<?php echo $movie->getId(); ?>" class="hide">

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';" >Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>